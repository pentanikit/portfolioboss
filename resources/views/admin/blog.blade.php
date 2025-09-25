@extends('admin.layout')
@section('content')
    <div>
        <style>
            :root {
                --bg: #0b0f15;
                --card: #111827;
                --muted: #9aa3af;
                --text: #e5e7eb;
                --accent: #22c55e;
                --danger: #ef4444;
                --border: #1f2937;
            }

            * {
                box-sizing: border-box
            }

            html,
            body {
                height: 100%
            }

            body {
                margin: 0;
                font: 16px/1.5 system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
                background: var(--bg);
                color: var(--text);
            }

            .container {
                max-width: 980px;
                margin: auto;
                padding: 24px;
            }

            .page-head h1 {
                margin: 0 0 6px
            }

            .muted {
                color: var(--muted)
            }

            .tiny {
                font-size: 12px
            }

            .card {
                background: var(--card);
                border: 1px solid var(--border);
                border-radius: 14px;
                padding: 18px;
                margin: 16px 0;
            }

            .card-title {
                margin: 0 0 12px;
                font-size: 18px;
                font-weight: 700;
            }

            .grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            @media (max-width: 720px) {
                .grid {
                    grid-template-columns: 1fr
                }
            }

            .field {
                display: flex;
                flex-direction: column;
                gap: 6px
            }

            label {
                font-weight: 600
            }

            .req {
                color: var(--danger)
            }

            input[type="text"],
            input[type="url"],
            input[type="number"],
            input[type="datetime-local"],
            textarea,
            select {
                background: #0a0f17;
                color: var(--text);
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 10px 12px;
                outline: none;
            }

            input:focus,
            textarea:focus,
            select:focus {
                border-color: #334155;
                box-shadow: 0 0 0 3px rgba(51, 65, 85, .3);
            }

            .hint {
                color: var(--muted);
                font-size: 12px
            }

            .counter {
                color: var(--muted);
                font-size: 12px;
                text-align: right;
                margin-top: 4px
            }

            .image-preview {
                margin-top: 12px;
                border: 1px dashed #334155;
                border-radius: 12px;
                padding: 10px;
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .image-preview img {
                max-width: 100%;
                height: auto;
                display: block;
                border-radius: 10px;
            }

            .hidden {
                display: none
            }

            .actions {
                margin: 24px 0;
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .btn {
                appearance: none;
                border: 1px solid var(--border);
                background: #0a0f17;
                color: var(--text);
                padding: 10px 14px;
                border-radius: 10px;
                cursor: pointer;
                font-weight: 600;
            }

            .btn:hover {
                filter: brightness(1.1)
            }

            .btn.primary {
                background: var(--accent);
                border-color: transparent;
                color: #08130c;
            }

            .btn.ghost {
                background: transparent;
            }

            .result {
                background: #0a0f17;
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 12px;
                white-space: pre-wrap;
                color: #cbd5e1;
                max-height: 260px;
                overflow: auto;
            }
        </style>
        <header class="page-head">
            <h1>Create New Blog</h1>
           
        </header>

        <!-- If you use Blade, replace the FORM wrapper with:
                             {{-- <form method="POST" action="{{ route('admin.blogs.store') }}" id="blogForm"> --}}
                               {{-- @csrf --}}
                            and remove the fetch() in app.js (or keep name attributes and let normal POST happen). -->
        <form id="blogForm" method="POST" action="{{ route('createBlogpost') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <!-- Core content -->
            <section class="card">
              

                <div class="grid">
                    <div class="field">
                        <label for="title">Title <span class="req">*</span></label>
                        <input type="text" id="title" name="title" required maxlength="255"
                            placeholder="e.g., How To Calibrate Your TV" />
                        <small class="hint">Max 255 characters.</small>
                    </div>

                    <div class="field">
                        <label for="slug">Slug </label>
                        <input type="text" id="slug" name="slug"  pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$"
                            placeholder="auto-generated-from-title" />
                        <small class="hint">Lowercase letters, numbers, and hyphens only.</small>
                    </div>
                </div>

                <div class="field">
                    <label for="excerpt">Excerpt (max 500)</label>
                    <textarea id="excerpt" name="excerpt" rows="3" maxlength="500" placeholder="Short summary shown on listings."></textarea>
                    <div class="counter"><span id="excerptCount">0</span>/500</div>
                </div>

                <div class="field">
                    <label for="body">Body (HTML/Markdown) <span class="req">*</span></label>
                    <textarea id="body" name="body" rows="10" required placeholder="<p>Your blog content...</p>"></textarea>
                </div>
            </section>

            <!-- Image (stored as string) -->
            <section class="card">
                <h2 class="card-title">Post Cover Image</h2>
                <div class="grid">
                    <div class="field">
                        <label for="image">Image Upload</label>
                        <input type="file" class="p-2 m-2 border-radius" id="image" name="image"
                            placeholder="uploads/blogs/cover.jpg or https://..." />
                        {{-- <small class="hint">This is saved as a string (not a file upload).</small> --}}
                    </div>

                    <div class="field">
                        <label>&nbsp;</label>
                        <button type="button" id="previewBtn" class="btn">Preview Image</button>
                    </div>
                </div>

                <div id="imagePreview" class="image-preview hidden">
                    <img id="previewImg" style="width: auto; height: 400px;" alt="Image preview" />
                    <div class="muted tiny">Preview based on the URL above.</div>
                </div>
            </section>

            <!-- Metadata -->
            <section class="card">
                <h2 class="card-title">Meta & Publishing</h2>

                <div class="grid">
                    {{-- <div class="field">
                        <label for="author_id">Author ID</label>
                        <input type="number" id="author_id" name="author_id" min="1" placeholder="e.g., 1" />
                        <small class="hint">References <code>users.id</code>. Optional (nullable).</small>
                    </div> --}}

                    <div class="field">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="draft" selected>draft</option>
                            <option value="published">published</option>
                            <option value="archived">archived</option>
                        </select>
                    </div>

                    <div class="field" id="publishedAtWrap">
                        <label for="published_at">Published At</label>
                        <input type="datetime-local" id="published_at" name="published_at" />
                        <small class="hint">Shown when status is <code>published</code>. Optional.</small>
                    </div>
                </div>
            </section>

            <!-- Optional SEO -->
            <section class="card">
                <h2 class="card-title">SEO (Optional)</h2>

                <div class="grid">
                    <div class="field">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" id="meta_title" name="meta_title" maxlength="255"
                            placeholder="Custom title for SERP" />
                        <small class="hint">Max 255 characters.</small>
                    </div>

                    <div class="field">
                        <label for="meta_description">Meta Description (max 500)</label>
                        <textarea id="meta_description" name="meta_description" rows="3" maxlength="500"
                            placeholder="One-sentence summary for SEO."></textarea>
                        <div class="counter"><span id="metaCount">0</span>/500</div>
                    </div>
                </div>
            </section>

            <!-- Actions -->
           
               <div class="actions">
                    <button type="submit" class="btn primary">Save Blog</button>
                    <button type="reset" class="btn ghost">Reset</button>
               </div>

          

            <!-- Submit result (for demo / JSON preview) -->
           <a class="btn primary" href="{{ route('dashboard') }}">Back to home</a>
        </form>

        <script>
            // Helpers
            const $ = (s, scope = document) => scope.querySelector(s);
            const toSlug = (val) =>
                val
                .toLowerCase()
                .replace(/&/g, ' and ')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            const titleEl = $('#title');
            const slugEl = $('#slug');
            const excerptEl = $('#excerpt');
            const metaDescEl = $('#meta_description');
            const excerptCount = $('#excerptCount');
            const metaCount = $('#metaCount');
            const statusEl = $('#status');
            const publishedAtWrap = $('#publishedAtWrap');
            const publishedAtEl = $('#published_at');
            const imageEl = $('#image');
            const previewBtn = $('#previewBtn');
            const imagePreview = $('#imagePreview');
            const previewImg = $('#previewImg');
            const form = $('#blogForm');
            const result = $('#result');

            // Auto-generate slug from title (only if user hasn't touched slug manually)
            let slugTouched = false;
            slugEl.addEventListener('input', () => (slugTouched = true));
            titleEl.addEventListener('input', () => {
                if (!slugTouched) slugEl.value = toSlug(titleEl.value);
            });

            // Live counters
            const updateCounters = () => {
                excerptCount.textContent = (excerptEl.value || '').length;
                metaCount.textContent = (metaDescEl.value || '').length;
            };
            excerptEl.addEventListener('input', updateCounters);
            metaDescEl.addEventListener('input', updateCounters);
            updateCounters();

            // Show/Hide published_at based on status
            const updatePublishedAtVisibility = () => {
                const isPublished = statusEl.value === 'published';
                publishedAtWrap.style.display = isPublished ? '' : 'none';
                if (!isPublished) publishedAtEl.value = '';
            };
            statusEl.addEventListener('change', updatePublishedAtVisibility);
            updatePublishedAtVisibility();

            // // Image preview from URL
            // previewBtn.addEventListener('click', () => {
            //     const src = (imageEl.value || '').trim();
            //     if (!src) {
            //         imagePreview.classList.add('hidden');
            //         previewImg.removeAttribute('src');
            //         return;
            //     }
            //     previewImg.onerror = () => {
            //         imagePreview.classList.remove('hidden');
            //         previewImg.removeAttribute('src');
            //         result.textContent = '⚠️ Could not load the image. Check the URL/path.';
            //     };
            //     previewImg.onload = () => {
            //         result.textContent = '';
            //     };
            //     previewImg.src = src;
            //     imagePreview.classList.remove('hidden');
            // });

            // Basic client-side validation mirroring your schema
            // const validate = () => {
            //     const errors = [];

            //     if (!titleEl.value.trim()) errors.push('Title is required.');
            //     if (!slugEl.value.trim()) errors.push('Slug is required.');
            //     if (slugEl.value && !/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(slugEl.value))
            //         errors.push('Slug must be lowercase letters, numbers, and hyphens only.');
            //     if (!$('#body').value.trim()) errors.push('Body is required.');

            //     if (excerptEl.value.length > 500) errors.push('Excerpt must be ≤ 500 chars.');
            //     if (metaDescEl.value.length > 500) errors.push('Meta description must be ≤ 500 chars.');

            //     if (statusEl.value === 'published' && !publishedAtEl.value)
            //         errors.push('Published At is recommended when status is "published".');

            //     return errors;
            // };

            //preview of uploaded image
            const fileInput = document.getElementById("image");
            const previewContainer = document.getElementById("imagePreview");
            // const previewImg = document.getElementById("previewImg");

            fileInput.addEventListener("change", function() {
                const file = this.files[0];

                if (file) {
                    // If it's a file, show preview using FileReader
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                } else if (this.value.trim() !== "") {
                    // If a URL is typed instead
                    previewImg.src = this.value.trim();
                    previewContainer.classList.remove("hidden");
                } else {
                    // No file or URL → hide preview
                    previewContainer.classList.add("hidden");
                    previewImg.src = "";
                }
            });
        </script>
    </div>
@endsection
