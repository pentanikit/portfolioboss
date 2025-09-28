<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\Response;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                // Adjust ordering as you like
        $images = Gallery::orderBy('created_at', 'desc')->get();

        return view('admin.imagegallery')->with('images', $images);
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
        // 1) Validate
        $validated = $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'image'     => ['required', 'file', 'image', 'mimes:jpeg,png,webp,gif', 'max:5120'], // 5MB
            'alt_text'  => ['nullable', 'string', 'max:255'],
            'caption'   => ['nullable', 'string', 'max:1000'],
        ]);

        // 2) Save file to /storage/app/public/galleries and get public URL
        $path = $request->file('image')->store('galleries', 'public');
        $url  = Storage::disk('public')->url($path); // ← this goes into `image_url`

        // 3) Create DB row
        $gallery = Gallery::create([
            'title'     => $validated['title'],
            'image_url' => $path,
            'alt_text'  => $validated['alt_text'] ?? null,
            'caption'   => $validated['caption'] ?? null,
        ]);

        // 4) Respond: JSON for fetch/AJAX, or redirect for normal POST
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Photo saved successfully.',
                'data'    => $gallery,
            ], 201);
        }

        return back()->with('success', 'Photo saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Gallery $gallery)
{
    try {
        // capture file path before DB delete
        $path = $gallery->image_url;

        // Hard delete row
        $usesSoftDeletes = in_array(SoftDeletes::class, class_uses_recursive($gallery));
        DB::transaction(function () use ($gallery, $usesSoftDeletes) {
            if ($usesSoftDeletes) {
                $gallery->forceDelete();     // permanent
            } else {
                $gallery->delete();          // permanent if no SoftDeletes on model
            }
        });

        // delete file (outside transaction)
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response()->json([
            'ok'  => true,
            'id'  => $gallery->getKey(),
            'msg' => 'Image hard-deleted.',
        ], Response::HTTP_OK);

    } catch (\Throwable $e) {
        return response()->json([
            'ok'  => false,
            'msg' => 'Failed to delete image.',
            'err' => config('app.debug') ? $e->getMessage() : null,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
}
