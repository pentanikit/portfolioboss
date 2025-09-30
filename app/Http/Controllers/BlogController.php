<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate (slug is nullable and points to the correct table)
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:blogs,slug',
            'excerpt'          => 'nullable|string|max:500',
            'body'             => 'string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'status'           => 'required|in:draft,published,archived',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Handle cover image upload (optional)
        if ($request->hasFile('image')) {
            // stores to storage/app/public/uploads/blogs
            $validated['image'] = $request->file('image')->store('uploads/blogs', 'public');
        }

        // Ensure slug exists; auto-generate from title if empty
        if (blank($validated['slug'] ?? null)) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Make slug unique by appending -1, -2, ...
        $base = $validated['slug'];
        $i = 1;
        while (Blog::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $base . '-' . $i++;
        }

        // If published with no published_at, set now
        if (($validated['status'] ?? null) === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::now();
        }

        // Create
        Blog::create($validated);

        return redirect()->back()->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blogPost = Blog::where('slug', $blog->slug)->get();
        return view('single-post')->with('blog', $blogPost[0]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }


        /**
     * Handle bulk actions for posts.
     *
     * Expects JSON: { action: "delete"|"unpublish", ids: [1,2,3] }
     */
    public function handle(Request $request)
    {
        $data = $request->validate([
            'action' => ['required', Rule::in(['delete', 'unpublish'])],
            'ids'    => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:blogs,id'],
        ]);

        $ids = $data['ids'];
        $action = $data['action'];

        // OPTIONAL: authorize user (Policies/Gates)
        // $this->authorize('bulkAction', Post::class);

        DB::beginTransaction();
        try {
            if ($action === 'delete') {
                // Prefer SoftDeletes on Post model
                $affected = Blog::whereIn('id', $ids)->delete();
                $msg = "{$affected} post(s) deleted.";
            } else { // unpublish
                $affected = Blog::whereIn('id', $ids)
                    ->update([
                        'status' => 'archived',
                        'published_at' => null,
                        'updated_at' => now(),
                    ]);
                $msg = "{$affected} post(s) unpublished.";
            }

            DB::commit();
            return response()->json([
                'ok' => true,
                'count' => $affected ?? 0,
                'message' => $msg,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return response()->json([
                'ok' => false,
                'message' => 'Bulk action failed.',
            ], 422);
        }
    }
}
