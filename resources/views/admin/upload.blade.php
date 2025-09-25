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
                --focus: #60a5fa;
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
                font: 16px/1.55 system-ui, -apple-system, "Segoe UI", Roboto, Ubuntu, Arial;
                background: var(--bg);
                color: var(--text);
            }

            .page {
                padding: 24px;
                display: grid;
                place-items: start center
            }

            .card {
                width: min(820px, 100%);
                background: var(--card);
                border: 1px solid var(--border);
                border-radius: 16px;
                padding: 24px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .25)
            }

            .card-title {
                margin: 0 0 6px;
                font-size: 1.5rem
            }

            .muted {
                color: var(--muted)
            }

            .req {
                color: #f59e0b
            }

            .field {
                margin: 16px 0
            }

            label {
                display: block;
                font-weight: 600;
                margin: 0 0 6px
            }

            input[type="text"],
            textarea {
                width: 100%;
                padding: 12px 14px;
                border: 1px solid var(--border);
                border-radius: 10px;
                background: #0e1620;
                color: var(--text);
                outline: none;
            }

            input[type="text"]:focus,
            textarea:focus {
                border-color: var(--focus);
                box-shadow: 0 0 0 3px rgba(96, 165, 250, .25)
            }

            .hint {
                display: block;
                margin-top: 6px;
                color: var(--muted);
                font-size: .9rem
            }

            .dropzone {
                position: relative;
                border: 2px dashed #334155;
                border-radius: 16px;
                padding: 22px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #0b1320;
                cursor: pointer;
                transition: border-color .2s, background .2s, transform .1s;
            }

            .dropzone:focus {
                outline: none;
                border-color: var(--focus);
                box-shadow: 0 0 0 3px rgba(96, 165, 250, .25)
            }

            .dropzone.dragover {
                border-color: var(--accent);
                background: #0d1a24
            }

            .file-input {
                position: absolute;
                inset: 0;
                opacity: 0;
                cursor: pointer
            }

            .dropzone-inner {
                text-align: center
            }

            .dz-icon {
                font-size: 2rem;
                margin-bottom: 8px
            }

            .dz-text strong {
                font-weight: 700
            }

            .preview {
                display: flex;
                gap: 12px;
                align-items: center;
                margin-top: 12px
            }

            .preview img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border-radius: 12px;
                border: 1px solid var(--border)
            }

            .hidden {
                display: none !important
            }

            .actions {
                display: flex;
                gap: 12px;
                margin-top: 20px
            }

            .btn {
                background: var(--accent);
                color: #00110a;
                border: none;
                padding: 12px 16px;
                border-radius: 10px;
                font-weight: 700;
                cursor: pointer;
                transition: transform .05s ease-in-out;
            }

            .btn:active {
                transform: translateY(1px)
            }

            .btn-light {
                background: #1f2937;
                color: var(--text);
                border: 1px solid var(--border);
            }

            .error {
                color: var(--danger);
                margin-top: 8px
            }

            .progress {
                width: 100%;
                height: 12px;
                margin-top: 10px;
                border-radius: 99px;
                overflow: hidden;
                appearance: none;
                background: #111a25;
                border: 1px solid var(--border)
            }

            progress::-webkit-progress-bar {
                background: #111a25
            }

            progress::-webkit-progress-value {
                background: var(--accent)
            }

            progress::-moz-progress-bar {
                background: var(--accent)
            }

            .form-message {
                margin-top: 16px
            }

            @media (max-width:520px) {
                .preview img {
                    width: 96px;
                    height: 96px
                }

            }
        </style>

        @if (session('success'))
            <script>toastr.success(@json(session('success')));</script>
        @endif

        @if ($errors->any())
            <script>
                toastr.error(@json(collect($errors->all())->join("\n")));
            </script>
        @endif


        <main class="page">
            <form id="galleryForm" class="card" enctype="multipart/form-data" method="post" action="{{ route('creategallery') }}" novalidate>
                <!-- For Laravel, uncomment and set the correct token -->
                {{-- <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --> --}}

                @csrf

                <h1 class="card-title">Add Photo to Gallery</h1>
                <p class="muted">Fields marked <span class="req">*</span> are required.</p>

                <!-- TITLE -->
                <div class="field">
                    <label for="title">Title <span class="req">*</span></label>
                    <input type="text" id="title" name="title" required maxlength="255"
                        placeholder="e.g., Sunset over Cox’s Bazar" />
                    <small class="hint">Max 255 characters.</small>
                </div>

                <!-- IMAGE (creates image_url on server) -->
                <div class="field">
                    <label for="image">Image <span class="req">*</span></label>

                    <div id="dropzone" class="dropzone" tabindex="0" role="button"
                        aria-label="Drop image here or click to browse">
                        <input id="image" name="image" type="file" accept="image/*" aria-label="Choose image"
                            class="file-input" required />
                        <div class="dropzone-inner">
                            <div class="dz-icon" aria-hidden="true">📷</div>
                            <div class="dz-text">
                                <strong>Click to choose</strong> or <strong>drag & drop</strong> a photo here
                                <div class="muted">JPG, PNG, WEBP, GIF • up to 5 MB</div>
                            </div>
                        </div>
                    </div>

                    <div id="previewWrap" class="preview hidden" aria-live="polite">
                        <img id="previewImg" alt="Selected image preview" />
                        <button type="button" id="clearImage" class="btn btn-light"
                            aria-label="Remove selected image">Remove</button>
                    </div>

                    <progress id="uploadProgress" class="progress hidden" value="0" max="100"></progress>
                    <p id="imageError" class="error" role="alert" hidden></p>
                </div>

                <!-- ALT TEXT -->
                <div class="field">
                    <label for="alt_text">Alt Text</label>
                    <input type="text" id="alt_text" name="alt_text" maxlength="255"
                        placeholder="Brief description for accessibility/SEO" />
                    <small class="hint">Describe the image for screen readers (optional).</small>
                </div>

                <!-- CAPTION -->
                <div class="field">
                    <label for="caption">Caption</label>
                    <textarea id="caption" name="caption" rows="3" maxlength="1000"
                        placeholder="Short description/caption (optional)"></textarea>
                    <div class="muted"><span id="captionCount">0</span>/1000</div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Save Photo</button>
                    <button type="reset" class="btn btn-light" id="resetFormBtn">Reset</button>
                    <a class="btn primary" href="{{ route('dashboard') }}">Back</a>
                    
                </div>

                <p id="formMessage" class="form-message" role="status" aria-live="polite"></p>
            </form>
        </main>


        <script>
            (function() {
                const form = document.getElementById('galleryForm');
                const title = document.getElementById('title');
                const altText = document.getElementById('alt_text');
                const caption = document.getElementById('caption');
                const captionCount = document.getElementById('captionCount');

                const dropzone = document.getElementById('dropzone');
                const fileInput = document.getElementById('image');
                const previewWrap = document.getElementById('previewWrap');
                const previewImg = document.getElementById('previewImg');
                const clearBtn = document.getElementById('clearImage');
                const progress = document.getElementById('uploadProgress');
                const imgErr = document.getElementById('imageError');
                const resetBtn = document.getElementById('resetFormBtn');
                const formMessage = document.getElementById('formMessage');

                const MAX_MB = 5;
                const ACCEPTED = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

                // Live caption counter
                caption.addEventListener('input', () => {
                    captionCount.textContent = caption.value.length.toString();
                });

                // Auto-suggest alt from title (if empty)
                title.addEventListener('blur', () => {
                    if (!altText.value.trim()) altText.value = title.value.trim();
                });

                // Drag & drop handlers
                ['dragenter', 'dragover'].forEach(evt =>
                    dropzone.addEventListener(evt, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        dropzone.classList.add('dragover');
                    })
                );
                ['dragleave', 'drop'].forEach(evt =>
                    dropzone.addEventListener(evt, (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        dropzone.classList.remove('dragover');
                    })
                );
                dropzone.addEventListener('drop', (e) => {
                    const file = e.dataTransfer.files?.[0];
                    if (file) setFile(file);
                });

                // Choose via click
                fileInput.addEventListener('change', () => {
                    const file = fileInput.files?.[0];
                    if (file) setFile(file);
                });

                // Remove selected image
                clearBtn.addEventListener('click', () => {
                    fileInput.value = '';
                    previewImg.removeAttribute('src');
                    previewWrap.classList.add('hidden');
                    progress.classList.add('hidden');
                    imgErr.hidden = true;
                });

                // Reset form
                resetBtn.addEventListener('click', () => {
                    setTimeout(() => {
                        captionCount.textContent = '0';
                        clearBtn.click();
                        formMessage.textContent = '';
                    }, 0);
                });

                function setFile(file) {
                    imgErr.hidden = true;
                    if (!ACCEPTED.includes(file.type)) {
                        showImageError('Only JPG, PNG, WEBP, or GIF allowed.');
                        fileInput.value = '';
                        return;
                    }
                    const sizeMB = file.size / (1024 * 1024);
                    if (sizeMB > MAX_MB) {
                        showImageError(`Image is too large (${sizeMB.toFixed(2)} MB). Max ${MAX_MB} MB.`);
                        fileInput.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = e => {
                        previewImg.src = e.target.result;
                        previewWrap.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }

                function showImageError(msg) {
                    imgErr.textContent = msg;
                    imgErr.hidden = false;
                }


            })();
        </script>
    </div>
@endsection
