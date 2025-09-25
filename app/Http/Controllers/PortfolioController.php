<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Gallery;

class PortfolioController extends Controller
{
    public function index(){
      $posts = Blog::orderBy('created_at', 'desc')->take(6)->get();
      $photos = Gallery::latest('id')
            ->take(6)
            ->get();
      return view('home')->with('posts', $posts)->with('photos', $photos);
    }


    public function loadMore(Request $request)
    {
        $take = (int) $request->input('take', 6);
        $take = max(1, min($take, 24)); // safety cap

        // Prefer cursor-based if `after_id` is provided (more efficient than skip)
        if ($request->filled('after_id')) {
            $afterId = (int) $request->after_id;

            $items = Gallery::select('id','title','image')
                ->where('id', '<', $afterId)
                ->latest('id')
                ->take($take)
                ->get();

            $nextAfterId = optional($items->last())->id;

            return response()->json([
                'items' => $items->map(fn ($g) => [
                    'id'    => $g->id,
                    'title' => $g->title,
                    'url'   => asset('storage/'.$g->image),
                    'alt'   => $g->title ?: 'Gallery image',
                ]),
                'next_after_id' => $nextAfterId,
                'has_more' => $items->count() === $take,
            ]);
        }

        // Fallback: offset-based using skip
        $skip = (int) $request->input('skip', 0);

        $items = Gallery::select('id','title','image')
            ->latest('id')
            ->skip($skip)
            ->take($take)
            ->get();

        return response()->json([
            'items' => $items->map(fn ($g) => [
                'id'    => $g->id,
                'title' => $g->title,
                'url'   => asset('storage/'.$g->image),
                'alt'   => $g->title ?: 'Gallery image',
            ]),
            'next_skip' => $skip + $items->count(),
            'has_more'  => $items->count() === $take,
        ]);
    }

}
