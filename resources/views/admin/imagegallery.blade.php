{{-- resources/views/gallery/index.blade.php --}}
@extends('admin.layout') {{-- or your layout --}}

@section('title', 'Image Gallery')

@section('content')
    {{-- Make sure your <head> has: <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <div class="container mx-auto px-4 py-6">
        @if (session('success'))
            <script>
                toastr.success(@json(session('success')));
            </script>
        @endif

        @if ($errors->any())
            <script>
                toastr.error(@json(collect($errors->all())->join("\n")));
            </script>
        @endif
        <h1 class="text-2xl font-semibold mb-6">Image Gallery</h1>

        @if ($images->isEmpty())
            <p class="text-gray-500">No images uploaded yet.</p>
        @else
            <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($images as $img)
            <figure id="image-card-{{ $img->id }}" class="rounded-xl overflow-hidden shadow border bg-white">
                {{-- Image wrapper (relative) so the button pins to the image corner --}}
                <div class="relative">
                {{-- Delete (×) button on top-right of the IMAGE --}}
                <button
                    type="button"
                    class="absolute right-2 top-2 z-10 inline-flex items-center justify-center h-8 w-8 rounded-full bg-black/60 text-white hover:bg-black"
                    aria-label="Delete image"
                    data-id="{{ $img->id }}"
                    data-url="{{ route('imagesdestroy', $img) }}"
                >
                    &times;
                </button>

                {{-- Image itself (full width, fixed aspect) --}}
                <img
                    src="{{ asset('storage') }}/{{ $img->image_url }}"
                    alt="{{ $img->title ?? 'Uploaded Image' }}"
                    class="w-full block object-cover"
                    style="aspect-ratio: 3 / 2;"
                    loading="lazy"
                >
                </div>

                {{-- Optional caption area --}}
                @if (!empty($img->title))
                <figcaption class="p-3 text-sm text-gray-700">
                    <div class="font-medium">{{ $img->title ?? '' }}</div>
                </figcaption>
                @endif
            </figure>
            @endforeach

            </div>
        @endif
    </div>

    {{-- Inline script: delete handler + event trigger --}}
    <script>
        (function() {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            function handleDeleteClick(e) {
                const btn = e.target.closest('button[data-id]');
                if (!btn) return;

                const id = btn.getAttribute('data-id');
                const url = btn.getAttribute('data-url');

                if (!url || !id) return;

                // Optional confirm
                if (!confirm('Delete this image?')) return;

                btn.disabled = true;

                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then(async (res) => {
                        const data = await res.json().catch(() => ({}));
                        if (!res.ok || !data.ok) {
                            throw new Error(data?.msg || 'Delete failed');
                        }

                        // Remove the card from the DOM
                        const card = document.getElementById('image-card-' + id);
                        if (card) card.remove();

                        // Dispatch a front-end event others can listen to
                        document.dispatchEvent(new CustomEvent('image:deleted', {
                            detail: {
                                id: Number(id)
                            }
                        }));
                    })
                    .catch((err) => {
                        alert(err?.message || 'Something went wrong while deleting.');
                        btn.disabled = false;
                    });
            }

            // Delegate clicks from the gallery container (handles dynamically added items too)
            document.addEventListener('click', function(e) {
                if (e.target.closest('button[data-id][data-url]')) {
                    handleDeleteClick(e);
                }
            });

            // Example of listening elsewhere:
            // document.addEventListener('image:deleted', (e) => {
            //     console.log('Deleted image id:', e.detail.id);
            // });
        })();
    </script>
@endsection
