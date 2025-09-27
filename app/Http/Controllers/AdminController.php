<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cookie;


class AdminController extends Controller
{
    public function blog(){
        return view('admin.blog');
    }

    public function gallery(){
        return view('admin.upload');
    }

    public function post_view(Request $request, Post $post){
            $viewsKey = "post:{$post->id}:views";
            $seenCookie = "seen_post_{$post->id}";

            // initialize if missing
            Cache::add($viewsKey, 0);

            // count unique-ish view per visitor per 6 hours
            if (!$request->cookies->has($seenCookie)) {
                Cache::increment($viewsKey); // works with file/redis/memcached
                Cookie::queue($seenCookie, '1', 60 * 6); // minutes
            }

            $views = Cache::get($viewsKey, 0);
            return view('posts.show', compact('post','views'));
    }


    public function dashboard(){
        $postCount = Blog::where('status', 'published')->get();
        $archiveCount = Blog::where('status', 'archived')->count();
        $draftCount = Blog::where('status', 'draft')->count();
        $photoCount = Gallery::all()->count();
        $pageVisit = Cache::get('site_visits_total', 0);

        return view('admin.dashboard')->with('allposts', $postCount)->with('unpublished', $archiveCount)->with('ideas',  $draftCount)->with('photos', $photoCount)->with('pageVisit', $pageVisit);
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'Logged out');
    }

    public function upsertAdmin(\Illuminate\Http\Request $request)
    {
        $existing = \App\Models\User::query()->first();

        // Validation rules: require password on create, optional on update
        $rules = [
            // 'name'  => ['required', 'string', 'max:255'],
            // 'phone' => ['required', 'string', 'max:32'],
            'email' => [
                'required', 'email',
                \Illuminate\Validation\Rule::unique('users', 'email')->ignore(optional($existing)->id),
            ],
            'password' => ['required', 'string']
            // ensure you have a 'role' column
        ];
        // $rules['password'] = $existing
        //     ? ['nullable', 'string', 'min:8', 'confirmed']
        //     : ['required', 'string', 'min:8', 'confirmed'];

        $data = $request->validate($rules);

        // Hash password only if provided (or on create)
        if (!empty($data['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($existing) {
            $existing->update($data);
            return back()->with('success', 'Admin user updated successfully.');
        }

        // On first-time create, mark as verified
        $data['email_verified_at'] = now();
        \App\Models\User::create($data);

        return back()->with('success', 'Admin user created successfully.');
    }

}
