<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReactionController extends Controller
{
    // GET counts + whether current fingerprint has reacted
    public function counts(Blog $blog, Request $request)
    {
        [$fp, $ip, $uaHash, $sid] = $this->fingerprint($request);

        $agg = Reaction::where('blog_id', $blog->id)
            ->selectRaw("SUM(reaction='like') as likes, SUM(reaction='dislike') as dislikes")
            ->first();

        $userReaction = Reaction::where('blog_id', $blog->id)
            ->where('fingerprint', $fp)
            ->value('reaction');

        return response()->json([
            'ok' => true,
            'likes' => (int)($agg->likes ?? 0),
            'dislikes' => (int)($agg->dislikes ?? 0),
            'user_reaction' => $userReaction, // null if none
        ]);
    }

    // POST like/dislike; toggles between like<->dislike but never allows duplicates
    public function react(Blog $blog, Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:like,dislike',
        ]);

        [$fp, $ip, $uaHash, $sid] = $this->fingerprint($request);

        try {
            DB::transaction(function () use ($blog, $data, $fp, $ip, $uaHash, $sid) {
                $existing = Reaction::where('blog_id', $blog->id)
                    ->where('fingerprint', $fp)
                    ->lockForUpdate()
                    ->first();

                if ($existing) {
                    // If same reaction, do nothing; if different, switch it.
                    if ($existing->reaction !== $data['type']) {
                        $existing->reaction = $data['type'];
                        $existing->save();
                    }
                } else {
                    Reaction::create([
                        'blog_id'    => $blog->id,
                        'reaction'   => $data['type'],
                        'fingerprint'=> $fp,
                        'ip'         => $ip,
                        'ua_hash'    => $uaHash,
                        'session_id' => $sid,
                    ]);
                }
            });
        } catch (\Throwable $e) {
            // fallthrough to send counts anyway
        }

        $agg = Reaction::where('blog_id', $blog->id)
            ->selectRaw("SUM(reaction='like') as likes, SUM(reaction='dislike') as dislikes")
            ->first();

        $userReaction = Reaction::where('blog_id', $blog->id)
            ->where('fingerprint', $fp)
            ->value('reaction');

        return response()->json([
            'ok' => (bool)$userReaction,
            'reason' => $userReaction ? null : 'already-reacted',
            'likes' => (int)($agg->likes ?? 0),
            'dislikes' => (int)($agg->dislikes ?? 0),
            'user_reaction' => $userReaction,
        ], 200);
    }

    private function fingerprint(Request $request): array
    {
        $ip  = $request->ip() ?? '0.0.0.0';
        $ua  = (string)($request->userAgent() ?? 'ua');
        $sid = $request->session()->getId() ?? 'sid';
        // Persist-friendly hash of IP + UA + Session (prevents repeated votes; session adds entropy per device)
        $fp  = substr(hash('sha256', $ip.'|'.$ua.'|'.$sid), 0, 100);
        $uaHash = hash('sha256', $ua);
        return [$fp, $ip, $uaHash, $sid];
    }
}
