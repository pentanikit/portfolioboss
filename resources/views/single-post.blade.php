<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raquibul Islam - Entrepreneur & Innovator</title>
    <meta name="description"
        content="Entrepreneur and business innovator specializing in digital transformation, SaaS development, and brand strategy. View my portfolio of successful ventures and achievements.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('raquibul-logo-favicon.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Dynamic Title (fallback সহ) -->
    <title>{{ $metaTitle ?? 'Raquibul Islam — Entrepreneur & Digital Transformation Leader' }}</title>

    <!-- Primary Description -->
    <meta name="description"
        content="{{ $metaDescription ?? 'Dhaka-based entrepreneur & digital transformation expert (15+ years). Strategy, branding, SaaS & web growth. View portfolio or book a call.' }}">

    <!-- Canonical -->
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}" />

    <!-- Indexing Controls -->
    <meta name="robots"
        content="{{ $robots ?? 'index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1' }}">
    <meta name="googlebot" content="{{ $googlebot ?? 'index,follow' }}">
    <meta name="bingbot" content="index,follow">

    <!-- Language / Hreflang (বাংলা প্রাইমারি, ইংরেজি অল্টারনেট) -->
    <link rel="alternate" href="{{ url()->current() }}" hreflang="bn-BD">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="en-US">
    <link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">

    <!-- Author / Publisher -->
    <meta name="author" content="Raquibul Islam">
    <meta name="publisher" content="Raquibul Islam">
    <!-- ===================== Open Graph (Facebook/LinkedIn) ===================== -->
    <meta property="og:site_name" content="Raquibul Islam">
    <meta property="og:locale" content="bn_BD">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:title"
        content="{{ $metaTitle ?? 'Raquibul Islam — Entrepreneur & Digital Transformation Leader' }}">
    <meta property="og:description"
        content="{{ $metaDescription ?? 'Dhaka-based entrepreneur & digital transformation expert (15+ years). Strategy, branding, SaaS & web growth.' }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:image" content="{{ $metaImage ?? asset('storage/og/home.jpg') }}">
    <meta property="og:image:secure_url" content="{{ $metaImage ?? asset('storage/og/home.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"
        content="{{ $ogImageAlt ?? 'Raquibul Islam — Entrepreneur & Digital Transformation Leader' }}">

    <!-- ===================== Twitter Card ===================== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="{{ $metaTitle ?? 'Raquibul Islam — Entrepreneur & Digital Transformation Leader' }}">
    <meta name="twitter:description"
        content="{{ $metaDescription ?? 'Strategy, branding, SaaS & web growth. View portfolio or book a call.' }}">
    <meta name="twitter:image" content="{{ $metaImage ?? asset('storage/og/home.jpg') }}">

    


    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WNR9X7TZ');
    </script>
    <!-- End Google Tag Manager -->




    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WNR9X7TZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    @php
        $jsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Person',
                    '@id' => url('/') . '#person',
                    'name' => 'Raquibul Islam',
                    'jobTitle' => 'Entrepreneur & Digital Transformation Expert',
                    'description' =>
                        'Entrepreneur, innovator, and digital transformation expert with 15+ years of experience building successful ventures and leading high-performance teams.',
                    'image' => asset('storage/og/profile.jpg'),
                    'email' => 'mailto:raquibul2030@gmail.com',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => '46, Shewrapara, Begum Rokeya Sarani',
                        'addressLocality' => 'Dhaka',
                        'addressCountry' => 'BD',
                    ],
                    'sameAs' => [
                        'https://www.facebook.com/raquibul2030',
                        'https://www.linkedin.com/in/raquibulislamrakib/',

                        'https://www.youtube.com/@raquibulislamrakib',
                    ],
                    'url' => url('/'),
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '#website',
                    'url' => url('/'),
                    'name' => 'Raquibul Islam',
                    'inLanguage' => 'bn-BD',
                    'publisher' => ['@id' => url('/') . '#person'],
                    'potentialAction' => [
                        '@type' => 'SearchAction',
                        'target' => url('/') . '?q={search_term_string}',
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ],
        ];
    @endphp

    <script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>



</head>

<body>


        {{-- Ensure this is in admin.layout <head>:  <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <div class="container mx-auto px-4 py-5">
        
           <!-- Navigation -->
    <nav class="navbar mb-4" id="navbar" style="position: sticky;">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="{{ route('landing') }}" class="brand-link"><img src="{{ asset('storage/raquibul.png') }}"
                        style="width:auto; height:40px;" alt="" srcset=""></a>
            </div>

            <!-- Desktop Navigation -->
            <div class="nav-menu" id="nav-menu">
                <a href="{{ route('landing') }}" class="nav-link">Home</a>
                <a href="{{ route('landing') }}#about" class="nav-link">About</a>
                <a href="{{ route('landing') }}#gallery" class="nav-link">Photos</a>
                <a href="{{ route('landing') }}#portfolio" class="nav-link">Business</a>
                <a href="{{ route('landing') }}#services" class="nav-link">Blog</a>
                <a href="{{ route('landing') }}#contact" class="nav-link">Contact</a>
            </div>

            <!-- Theme Toggle & Mobile Menu -->
            <div class="nav-actions">
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle theme">
                    <i class="fas fa-moon" id="theme-icon"></i>
                </button>

                <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
                    <i class="fas fa-bars" id="menu-icon"></i>
                </button>
            </div>
        </div>
    </nav>
        <article class="max-w-3xl mx-auto mb-3">
            <a style="text-decoration: none; font-size: 40px;" href="{{ route('landing') }}">←</a><h1 class="text-3xl font-bold mb-4">{{ $blog->title }}</h1>

            @if ($blog->image)
                <img src="{{ asset('storage') }}/{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full rounded-lg mb-4">
            @endif

            <div class="prose max-w-none mb-6">
                {!! $blog->body !!}
            </div>

            {{-- Reactions --}}
            <div id="postReactions" data-post-id="{{ $blog->id }}"
                data-counts-url="{{ route('reactions', ['blog' => $blog]) }}"
                data-react-url="{{ route('react', ['blog' => $blog]) }}" aria-live="polite">
                <button id="btnLike" type="button"
                    class="inline-flex items-center gap-2 rounded-lg border px-4 py-2 hover:bg-gray-50"
                    aria-pressed="false">
                    <span>👍 Like</span>
                    <span id="likeCount" class="font-semibold">0</span>
                </button>

                <button id="btnDislike" type="button"
                    class="inline-flex items-center gap-2 rounded-lg border px-4 py-2 hover:bg-gray-50"
                    aria-pressed="false">
                    <span>👎 Dislike</span>
                    <span id="dislikeCount" class="font-semibold">0</span>
                </button>

                <span id="reactStatus" class="text-sm text-gray-500"></span>
            </div>
        </article>
    </div>

        <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- Brand -->
                <div class="footer-brand">
                    <div class="footer-logo"><img src="{{ asset('storage/raquibul.png') }}" alt=""
                            srcset=""></div>
                    <p class="footer-description">
                        Entrepreneur and digital transformation expert helping businesses turn innovative ideas into
                        successful ventures.
                    </p>
                    <div class="social-links">
                        <a href="https://www.youtube.com/@raquibulislamrakib" target="_blank" class="social-link">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/raquibulislamrakib/" target="_blank"
                            class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.facebook.com/raquibul2030" target="_blank" class="social-link">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h4 class="footer-section-title">Quick Links</h4>
                    <div class="footer-links">
                        <a href="#home" class="nav-link">Home</a>
                        <a href="#about" class="nav-link">About</a>
                        <a href="#gallery" class="nav-link">Photos</a>
                        <a href="#portfolio" class="nav-link">Business</a>
                        <a href="#services" class="nav-link">Blog</a>
                        <a href="#contact" class="nav-link">Contact</a>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="footer-section">
                    <h4 class="footer-section-title">Get in Touch</h4>
                    <div class="footer-contact">
                        <a href="mailto:alex@alexthompson.com" class="footer-contact-item">
                            <i class="fas fa-envelope"></i>
                            raquibul2030@gmail.com
                        </a>
                        {{-- <a href="tel:+15551234567" class="footer-contact-item">
                            <i class="fas fa-phone"></i>
                            +8801716122945
                        </a> --}}
                        <div class="footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            46, Shewrapara, Begum Rokeya Sarani, Dhaka
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="footer-copyright">
                        © 2024 Raquibul Islam. All rights reserved.
                    </div>
                    <div class="footer-bottom-links">
                        <a href="#" class="footer-bottom-link" onclick="showPrivacyPolicy()">Privacy Policy</a>
                        <a href="#" class="footer-bottom-link" onclick="showTerms()">Terms of Service</a>
                        <button class="btn btn-outline btn-small" onclick="scrollToTop()">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
 
        <script>
            (function() {
                const wrap = document.getElementById('postReactions');
                if (!wrap) {
                    console.warn('postReactions wrapper not found');
                    return;
                }

                const postId = wrap.dataset.postId;
                const countsUrl = wrap.dataset.countsUrl;
                const reactUrl = wrap.dataset.reactUrl;
                const btnLike = document.getElementById('btnLike');
                const btnDislike = document.getElementById('btnDislike');
                const likeCountEl = document.getElementById('likeCount');
                const dislikeCountEl = document.getElementById('dislikeCount');
                const statusEl = document.getElementById('reactStatus');

                const LS_KEY = `post:${postId}:reaction`;
                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                function setPressed(which) {
                    btnLike.setAttribute('aria-pressed', which === 'like' ? 'true' : 'false');
                    btnDislike.setAttribute('aria-pressed', which === 'dislike' ? 'true' : 'false');
                }

                function setStatus(msg) {
                    statusEl.textContent = msg || '';
                }

                async function fetchCounts() {
                    try {
                        const r = await fetch(countsUrl, {
                            headers: {
                                Accept: 'application/json'
                            },
                            credentials: 'same-origin'
                        });
                        if (!r.ok) throw new Error(`GET reactions failed ${r.status}`);
                        const data = await r.json();

                        likeCountEl.textContent = data.likes ?? 0;
                        dislikeCountEl.textContent = data.dislikes ?? 0;

                        if (data.user_reaction) {
                            localStorage.setItem(LS_KEY, data.user_reaction);
                            setPressed(data.user_reaction);
                            setStatus(`আপনি এটি পছন্দ করেছেন : ${data.user_reaction}`);
                        } else {
                            const local = localStorage.getItem(LS_KEY);
                            if (local) {
                                setPressed(local);
                                setStatus(`আপনি এটি পছন্দ করেছেন : ${local}`);
                            } else {
                                setPressed(null);
                                setStatus('');
                            }
                        }
                    } catch (e) {
                        console.error('fetchCounts error:', e);
                        setStatus('Unable to load reactions.');
                    }
                }

                async function sendReaction(type) {
                    const prevPressed = btnLike.getAttribute('aria-pressed') === 'true' ? 'like' :
                        (btnDislike.getAttribute('aria-pressed') === 'true' ? 'dislike' : null);
                    if (prevPressed === type) return;

                    try {
                        const r = await fetch(reactUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf ?? '',
                                Accept: 'application/json'
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                type
                            })
                        });
                        if (!r.ok) throw new Error(`POST react failed ${r.status}`);
                        const data = await r.json();

                        likeCountEl.textContent = data.likes ?? likeCountEl.textContent;
                        dislikeCountEl.textContent = data.dislikes ?? dislikeCountEl.textContent;

                        const ur = data.user_reaction || type;
                        setPressed(ur);
                        localStorage.setItem(LS_KEY, ur);
                        setStatus(data.reason === 'আপনি এটি পছন্দ করেছেন ' ? `আপনি এটি পছন্দ করেছেন : ${ur}` :
                            `You reacted: ${ur}`);
                    } catch (e) {
                        console.error('sendReaction error:', e);
                        setStatus('Unable to submit reaction.');
                    }
                }

                btnLike?.addEventListener('click', () => sendReaction('like'));
                btnDislike?.addEventListener('click', () => sendReaction('dislike'));

                fetchCounts();
            })();
        </script>
    

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>









