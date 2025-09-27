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

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Gallery Grid */
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 1200px;
            margin: auto;
        }

        .gallery img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        /* Hide extra images initially */
        .gallery img.hidden {
            display: none;
        }

        /* Load More Button */
        .load-more {
            display: block;
            margin: 25px auto;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background: #ff9800;
            color: #fff;
            transition: background 0.3s;
        }

        .load-more:hover {
            background: #e68900;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .gallery {
                grid-template-columns: 1fr;
            }
        }

        /* Lightbox */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        .lightbox.active {
            visibility: visible;
            opacity: 1;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 8px;
        }

        /* Controls */
        .lightbox .close,
        .lightbox .prev,
        .lightbox .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2rem;
            color: #fff;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            user-select: none;
        }

        .lightbox .close {
            top: 30px;
            right: 30px;
            transform: none;
            font-size: 2.5rem;
        }

        .lightbox .prev {
            left: 40px;
        }

        .lightbox .next {
            right: 40px;
        }

        .lightbox .close:hover,
        .lightbox .prev:hover,
        .lightbox .next:hover {
            background: rgba(255, 152, 0, 0.8);
        }
    </style>

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="#home" class="brand-link"><img src="{{ asset('storage/raquibul.png') }}"
                        style="width:auto; height:40px;" alt="" srcset=""></a>
            </div>

            <!-- Desktop Navigation -->
            <div class="nav-menu" id="nav-menu">
                <a href="#home" class="nav-link">Home</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#gallery" class="nav-link">Photos</a>
                <a href="#portfolio" class="nav-link">Business</a>
                <a href="#services" class="nav-link">Blog</a>
                <a href="#contact" class="nav-link">Contact</a>
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

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-background">
            <img src="{{ asset('storage/galleries/6G3YhKrt8QKcyXMVeX56qYq4VB9W9kVHJmT7d3F9.jpg') }}"
                style="opacity: 0.7;" alt="Entrepreneur workspace" class="hero-image">
            <div class="hero-overlay"></div>
        </div>

        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="hero-title-line">Hello</span><br>
                    <div class="hero-title-line">I am <span class="hero-title-gradient">Raquibul Islam</span></div>
                </h1>

                <p class="hero-description" style="color:black; font-style:bold;">
                    Entrepreneur, innovator, and digital transformation expert with 15+ years of experience
                    building successful ventures and leading high-performance teams.
                </p>

                <!-- Stats -->
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label" style="color:black; font-style:bold;">Successful Ventures</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15</div>
                        <div class="stat-label" style="color:black; font-style:bold;">Years of success</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">200+</div>
                        <div class="stat-label" style="color:black; font-style:bold;">Team Members Led</div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="hero-actions">
                    <button class="btn btn-primary" onclick="scrollToSection('portfolio')">
                        View My Work
                        <i class="fas fa-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">

                <h2 class="section-title">
                    About <span class="gradient-text">Myself</span>
                </h2>
                <p class="section-description">
                    Businessman & Entrepreneur
                    <br> Passionate about turning innovative ideas into successful businesses that make a real
                    difference in people's lives.
                </p>
            </div>

            <div class="about-content">
                <!-- Profile Image -->
                <div class="about-image">
                    <img src="{{ asset('storage/images/raquibul islam.jpeg') }}" alt="Raquibul Islam"
                        class="profile-image">
                </div>

                <!-- Content -->
                <div class="about-text">
                    <h3 class="about-heading">Driven by Innovation</h3>
                    <p class="about-paragraph">
                        I am Raquibul Islam, a passionate and forward-thinking entrepreneur from Bangladesh.
                        My journey in the world of business began in 2011 with the electronics sector, and over the
                        years, I have diversified into multiple other ventures that are also running successfully today.
                        
                    </p>
                    <p class="about-paragraph">
                        We warmly invite you to become a part of the our family. Your valuable feedback and suggestions
                        will continue to guide and inspire us on our journey to excellence.


                        May the Almighty bless us all with prosperity, growth and success in every walk of life.

                       
                    </p>
                    {{-- <p class="about-paragraph">
                        Warm regards, <br>
                        Md Raquibul Islam (Rakib) <br>
                        Founder & CEO, Ponnobd Electronics <br>
                        Local Vice President of (JCI Dhaka Pioneer)
                    </p> --}}

                    <!-- Skills -->
                    <div class="skills-section">
                        <h4 class="skills-title">Core Expertise</h4>
                        <div class="skills-list">
                            <span class="skill-tag">Strategic Planning</span>
                            <span class="skill-tag">Digital Transformation</span>
                            <span class="skill-tag">Team Leadership</span>
                            <span class="skill-tag">Product Development</span>
                            <span class="skill-tag">Market Analysis</span>

                            <span class="skill-tag">SaaS Development</span>
                            <span class="skill-tag">Brand Strategy</span>
                            <span class="skill-tag">Operations Management</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievements Grid -->
            <div class="achievements-grid">
                <a class="achievement-card" style="text-decoration: none;" href="https://ponnobd.com"
                    target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/ponnobd.png') }}"
                            alt="" srcset=""></div>
                    <div class="achievement-label">Founder & CEO</div>
                </a>
                <a class="achievement-card" style="text-decoration: none;" href="https://pentanik.com"
                    target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/Pentanik.png') }}"
                            alt="" srcset=""></div>
                    <div class="achievement-label">Founder & CEO</div>
                </a>
                <a class="achievement-card" style="text-decoration: none;" href="https://servicebari.com"
                    target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/servicebari.png') }}"
                            alt="" srcset=""></div>
                    <div class="achievement-label">Founder & CEO</div>
                </a>
                <a class="achievement-card" style="text-decoration: none;" href="https://pentanikit.com"
                    target="_blank">

                    <div class="achievement-value"><img
                            src="{{ asset('storage/logos/pentanik-it-Solution-Park.png') }}" alt=""
                            srcset=""></div>
                    <div class="achievement-label">Founder & CEO</div>
                </a>
            </div>
            <div class="achievements-grid">
                <a class="achievement-card" style="text-decoration: none;"
                    href="https://fcclubltd.com/founding-members/" target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/fcc.png') }}" alt=""
                            srcset=""></div>
                    <div class="achievement-label">Founder Member</div>
                </a>
                <a class="achievement-card" style="text-decoration: none;"
                    href="https://basis.org.bd/company-profile/20-11-1195" target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/basis.png') }}"
                            alt="" srcset=""></div>
                    <div class="achievement-label">General Member BASIS</div>
                </a>
                <a class="achievement-card" style="text-decoration: none;"
                    href="https://e-cab.net/company-profile/0911/ponnobd-electronics" target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/e-Cab.png') }}" alt=""
                            srcset=""></div>
                    <div class="achievement-label">Member</div>
                </a>
                <a class="achievement-card" style="text-decoration: none;" href="#" target="_blank">

                    <div class="achievement-value"><img src="{{ asset('storage/logos/jci.png') }}"
                            alt="" srcset=""></div>
                    <div class="achievement-label">Local Vice President</div>
                </a>
            </div>

        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    Featured <span class="gradient-text">Business</span>
                </h2>
                <p class="section-description">
                    A showcase of innovative solutions that have generated millions in revenue and impacted hundreds of
                    thousands of users.
                </p>
            </div>


            <div class="portfolio-grid">
                <!-- Project 1 -->
                <a class="project-card" style="text-decoration: none; color:inherit;" href="https://ponnobd.com"
                    target="_blank">
                    <div class="project-image" style="max-width: 90%; margin:auto;">
                        <img src="{{ asset('storage/images/ponnobd.com.png') }}" alt="ponnobd">

                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Ponnobd Electronics</h3>
                        <p class="project-description">
                            Ponnobd Electronics is one of the top electronics, electric and home appliances brand with
                            one of the largest trusted online shop.
                        </p>
                        <!-- <div class="project-technologies">
                            <span class="tech-tag">React Native</span>
                            <span class="tech-tag">Node.js</span>
                            <span class="tech-tag">MongoDB</span>
                            <span class="tech-tag">+1 more</span>
                        </div> -->

                    </div>
                </a>

                <!-- Project 2 -->
                <a class="project-card" style="text-decoration: none; color:inherit;" href="https://pentanik.com"
                    target="_blank">
                    <div class="project-image" style="max-width: 90%; margin:auto;">
                        <img src="{{ asset('storage/images/pentanik-logo.png') }}" alt="">
                        <div class="project-overlay">
                            <!-- <span class="project-category">E-commerce</span> -->
                            {{-- <span class="project-status live">Live</span> --}}
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Pentanik</h3>
                        <p class="project-description">
                            Pentanik has flourished as a prominent brand in Bangladesh's electronics industry by
                            offering a diverse range of high quality electronic products.
                        </p>
                        <!-- <div class="project-technologies">
                            <span class="tech-tag">Next.js</span>
                            <span class="tech-tag">Shopify</span>
                            <span class="tech-tag">Stripe</span>
                            <span class="tech-tag">+1 more</span>
                        </div> -->

                    </div>
                </a>

                <!-- Project 3 -->
                {{-- <a class="project-card" style="text-decoration: none; color:inherit;"
                    href="https://onlinebanglanews.com" target="_blank">
                    <div class="project-image">
                        <img src="{{ asset('storage/images/logo-onlinebanglanews-raq.jpg') }}"
                            alt="Online bangla news">
                        <div class="project-overlay">
                            <!-- <span class="project-category">Media</span> -->
                            <span class="project-status live">Live</span>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Online Bangla News</h3>
                        <p class="project-description">
                            দেশ ও জনগনের স্বার্থে
                        </p>
                        <!-- <div class="project-technologies">
                            <span class="tech-tag">React</span>
                            <span class="tech-tag">Python</span>
                            <span class="tech-tag">PostgreSQL</span>
                            <span class="tech-tag">+1 more</span>
                        </div> -->

                    </div>
                </a> --}}

                <!-- Project 4 -->
                <a class="project-card" style="text-decoration: none; color:inherit; " href="https://pentanikit.com"
                    target="_blank">
                    <div class="project-image" style="max-width: 90%; margin:auto;">
                        <img src="{{ asset('storage/images/pentanik-it-Solution-Park.png') }}" alt="pentanikit">
                        <div class="project-overlay">
                            <!-- <span class="project-category">Service</span> -->
                            {{-- <span class="project-status live">Live</span> --}}
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Pentanik IT</h3>
                        <p class="project-description">
                            Pentanik IT Solution Park is your trusted partner for Business Consulting, Business
                            Development, Web Design, and Digital Marketing services.
                        </p>
                        <!-- <div class="project-technologies">
                            <span class="tech-tag">Vue.js</span>
                            <span class="tech-tag">Canvas API</span>
                            <span class="tech-tag">AWS</span>
                            <span class="tech-tag">+1 more</span>
                        </div> -->

                    </div>
                </a>

                <!--project 5-->
                <a class="project-card" style="text-decoration: none; color:inherit;" href="https://servicebari.com"
                    target="_blank">
                    <div class="project-image" style="max-width: 90%; margin:auto;">
                        <img src="{{ asset('storage/images/service-bari-logo.png') }}" alt="Service Bari">
                        <div class="project-overlay">
                            <!-- <span class="project-category">Service</span> -->
                            {{-- <span class="project-status live">Live</span> --}}
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">Service Bari</h3>
                        <p class="project-description">
                            সেরা সেবায় বিশ্বাসী
                        </p>

                        <!-- <div class="project-technologies">
                            <span class="tech-tag">Vue.js</span>
                            <span class="tech-tag">Canvas API</span>
                            <span class="tech-tag">AWS</span>
                            <span class="tech-tag">+1 more</span>
                        </div> -->

                    </div>
                </a>

                <!--project 6-->
                {{-- <a class="project-card" style="text-decoration: none; color:inherit;" href="https://thebrainbd.com"
                    target="_blank">
                    <div class="project-image">
                        <img src="{{ asset('storage/images/images.jpg') }}" alt="Service Bari">
                        <div class="project-overlay">
                            <!-- <span class="project-category">Service</span> -->
                            <span class="project-status live">Live</span>
                        </div>
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">The Brain BD</h3>
                        <p class="project-description">
                            Luxury Lifestyle Brand
                        </p>
                        <!-- <div class="project-technologies">
                            <span class="tech-tag">Vue.js</span>
                            <span class="tech-tag">Canvas API</span>
                            <span class="tech-tag">AWS</span>
                            <span class="tech-tag">+1 more</span>
                        </div> -->

                    </div>
                </a> --}}
            </div>
        </div>
    </section>



    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    Collected Business Tips & <span class="gradient-text">Tricks</span>
                </h2>
                {{-- <p class="section-description">
                    Collected Business Tips & Tricks
                </p> --}}
            </div>

            @if ($posts)
                <div class="services-grid">
                    <!-- Service 1 -->
                    @foreach ($posts as $item)
                        <a class="service-card" style="text-decoration: none; color:inherit;"
                            href="/single-post/{{ $item->title }}">
                            <div>

                                <img class="mb-3" style="width: 100%; height:200px; object-fit:cover;"
                                    src="{{ asset('storage') }}/{{ $item->image }}" alt="">

                                <h3 class="service-title">{{ $item->title }}</h3>

                                <p>{{ Str::limit(strip_tags($item->body), 150) }}</p>

                            </div>
                        </a>
                    @endforeach



                </div>
            @else
                <div class="service-grid">
                    <p>No posts to show</p>
                </div>
            @endif


            <h2>Photos</h2>
            <div class="gallery" id="gallery">

                @foreach ($photos as $item)
                    <figure>
                        <img src="{{ asset('storage') }}/{{ $item->image_url }}" alt="Project 1">
                        <figcaption>{{ $item->title }}</figcaption>
                    </figure>
                @endforeach
                {{-- <!-- First 6 -->

                <figure>
                    <img src="https://picsum.photos/id/1016/600/400" alt="Project 2">
                    <figcaption>Bridge Architecture</figcaption>
                </figure>
                <figure>
                    <img src="https://picsum.photos/id/1018/600/400" alt="Project 3">
                    <figcaption>Forest Walk</figcaption>
                </figure>
                <figure>
                    <img src="https://picsum.photos/id/1020/600/400" alt="Project 4">
                    <figcaption>City Skyline</figcaption>
                </figure>
                <figure>
                    <img src="https://picsum.photos/id/1021/600/400" alt="Project 5">
                    <figcaption>Desert Road</figcaption>
                </figure>
                <figure>
                    <img src="https://picsum.photos/id/1022/600/400" alt="Project 6">
                    <figcaption>Snowy Peaks</figcaption>
                </figure>

                <!-- More hidden -->
                <figure class="hidden">
                    <img src="https://picsum.photos/id/1023/600/400" alt="Project 7">
                    <figcaption>Quiet Lake</figcaption>
                </figure>
                <figure class="hidden">
                    <img src="https://picsum.photos/id/1024/600/400" alt="Project 8">
                    <figcaption>Street Alley</figcaption>
                </figure>
                <figure class="hidden">
                    <img src="https://picsum.photos/id/1025/600/400" alt="Project 9">
                    <figcaption>Green Hills</figcaption>
                </figure>
                <figure class="hidden">
                    <img src="https://picsum.photos/id/1026/600/400" alt="Project 10">
                    <figcaption>Ocean Sunset</figcaption>
                </figure>
                <figure class="hidden">
                    <img src="https://picsum.photos/id/1027/600/400" alt="Project 11">
                    <figcaption>Night Lights</figcaption>
                </figure>
                <figure class="hidden">
                    <img src="https://picsum.photos/id/1028/600/400" alt="Project 12">
                    <figcaption>Wooden Path</figcaption>
                </figure> --}}
            </div>

            <button id="loadMore" class="load-more" data-skip="{{ $photos->count() }}" data-take="6">
                Load More
            </button>

            <!-- Lightbox -->
            <div class="lightbox" id="lightbox">
                <button class="close" id="close">&times;</button>
                <button class="prev" id="prev">&#10094;</button>
                <img src="" alt="Preview" id="lightbox-img">
                <button class="next" id="next">&#10095;</button>
            </div>


            <!-- Call to Action -->
            <div class="services-cta">
                <h3 class="cta-title">Ready to Transform Your Business?</h3>
                <p class="cta-description">
                    Let's discuss how we can work together to achieve your goals and take your business to the next
                    level.
                </p>
                <div class="cta-buttons">
                    <button class="btn btn-primary" onclick="scrollToSection('contact')">
                        Schedule a Consultation
                    </button>
                    <button class="btn btn-outline" onclick="scrollToSection('portfolio')">
                        View Portfolio
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    Let's Work <span class="gradient-text">Together</span>
                </h2>
                <p class="section-description">
                    Ready to turn your vision into reality? Get in touch and let's discuss how we can create something
                    amazing together.
                </p>
            </div>

            <div class="contact-content">
                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <div class="contact-form-card">
                        <h3 class="form-title">Send a Message</h3>
                        <form id="contact-form" class="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Full Name *</label>
                                    <input type="text" id="name" name="name" required
                                        placeholder="John Doe">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" required
                                        placeholder="john@company.com">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" id="company" name="company" placeholder="Your Company">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject *</label>
                                    <input type="text" id="subject" name="subject" required
                                        placeholder="Project Discussion">
                                </div>
                            </div>

                            {{-- <div class="form-row">
                                <div class="form-group">
                                    <label>Budget Range</label>
                                    <div class="budget-options">
                                        <span class="budget-option" data-budget="$5k - $15k">$5k - $15k</span>
                                        <span class="budget-option" data-budget="$15k - $50k">$15k - $50k</span>
                                        <span class="budget-option" data-budget="$50k - $100k">$50k - $100k</span>
                                        <span class="budget-option" data-budget="$100k+">$100k+</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Timeline</label>
                                    <div class="timeline-options">
                                        <span class="timeline-option" data-timeline="ASAP">ASAP</span>
                                        <span class="timeline-option" data-timeline="1-3 months">1-3 months</span>
                                        <span class="timeline-option" data-timeline="3-6 months">3-6 months</span>
                                        <span class="timeline-option" data-timeline="6+ months">6+ months</span>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" required rows="5"
                                    placeholder="Tell me about your project, goals, and how I can help..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary form-submit">
                                <span class="submit-text">Send Message</span>
                                <span class="submit-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i> Sending...
                                </span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="contact-info">
                    <div class="contact-info-card">
                        <h3 class="info-title">Contact Information</h3>
                        <div class="info-items">
                            <div class="info-item" onclick="window.location.href='mailto:raquibul2030@gmail.com'">
                                <div class="info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">raquibul2030@gmail.com</div>
                                </div>
                            </div>
                            {{-- <div class="info-item" onclick="window.location.href='tel:+8801716122945'">
                                <div class="info-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Phone</div>
                                    <div class="info-value">+8801716122945</div>
                                </div>
                            </div> --}}
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Location</div>
                                    <div class="info-value">46, shewrapara, Begum Rokeya Sarani, Dhaka</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Response Time</div>
                                    <div class="info-value">Within 24 hours</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <h3 class="info-title">
                            <i class="fas fa-calendar-alt"></i>
                            Schedule a Call
                        </h3>
                        <p class="info-description">
                            Prefer to talk? Schedule a 30-minute consultation call to discuss your project in detail.
                        </p>
                        <button class="btn btn-outline" onclick="scheduleCall()">
                            <i class="fas fa-calendar-alt"></i>
                            Book a Call
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <a href="https://www.youtube.com/@raquibulislamrakib" target="_blank" class="social-link"  >
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/raquibulislamrakib/" target="_blank" class="social-link" >
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.facebook.com/raquibul2030" target="_blank" class="social-link" >
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

    <!-- Project Modal -->
    {{-- <div id="project-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title" class="modal-title"></h2>
                <button class="modal-close" onclick="closeProjectModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <img id="modal-image" class="modal-image" src="" alt="">
                <div class="modal-details">
                    <div class="modal-description">
                        <h4>Project Details</h4>
                        <p id="modal-long-description"></p>
                        <div class="modal-info">
                            <div><strong>Category:</strong> <span id="modal-category"></span></div>
                            <div><strong>Status:</strong> <span id="modal-status"></span></div>
                            <div><strong>Metrics:</strong> <span id="modal-metrics"></span></div>
                        </div>
                    </div>
                    <div class="modal-technologies">
                        <h4>Technologies Used</h4>
                        <div id="modal-tech-list" class="tech-tags"></div>

                        <h4>Key Achievements</h4>
                        <ul id="modal-achievements" class="achievement-list"></ul>
                    </div>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-primary" onclick="viewLive()">
                        <i class="fas fa-external-link-alt"></i>
                        View Live
                    </button>
                    <button class="btn btn-outline" onclick="viewCode()">
                        <i class="fab fa-github"></i>
                        View Code
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div class="toast-content">
            <i class="fas fa-check-circle"></i>
            <span id="toast-message">Message sent successfully!</span>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener("mousemove", (e) => {
            document.querySelectorAll(".float").forEach(el => {
                const speed = el.getAttribute("data-speed");
                const x = (window.innerWidth - e.pageX * speed) / 200;
                const y = (window.innerHeight - e.pageY * speed) / 200;
                el.style.transform = `translate(${x}px, ${y}px)`;
            });

            const bg = document.querySelector(".hero-image");
            if (bg) {
                const x = (e.pageX / window.innerWidth - 0.5) * 20;
                const y = (e.pageY / window.innerHeight - 0.5) * 20;
                bg.style.transform = `scale(1.1) translate(${x}px, ${y}px)`;
            }
        });
    </script>


    <script>
        const gallery = document.getElementById("gallery");
        const loadMoreBtn = document.getElementById("loadMore");
        const hiddenImages = gallery.querySelectorAll("img.hidden");
        let currentBatch = 0;
        const batchSize = 6;

        async function fetchMore() {
            loadMoreBtn.disabled = true;

            const take = parseInt(loadMoreBtn.dataset.take || '6', 10);

            let url = '{{ route('loadmoreimages') }}';
            if (USE_CURSOR) {
                const afterId = afterIdInput.value;
                url += `?take=${take}` + (afterId ? `&after_id=${afterId}` : '');
            } else {
                const skip = parseInt(loadMoreBtn.dataset.skip || '0', 10);
                url += `?take=${take}&skip=${skip}`;
            }

            try {
                const res = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const data = await res.json();

                const items = data.items || [];
                if (!items.length) {
                    loadMoreBtn.style.display = 'none';
                    return;
                }

                // Append new figures
                const frag = document.createDocumentFragment();
                items.forEach(item => {
                    const fig = document.createElement('figure');
                    // fig.setAttribute('data-id', item.id);
                    fig.innerHTML = `
          <img src="${item.image_url}" alt="${item.alt_text}">
          <figcaption>${item.title ?? ''}</figcaption>
        `;
                    frag.appendChild(fig);
                });
                galleryEl.appendChild(frag);

                // Update paging state
                if (USE_CURSOR) {
                    afterIdInput.value = data.next_after_id || '';
                    if (!data.has_more) loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.dataset.skip = data.next_skip ?? (parseInt(loadMoreBtn.dataset.skip || '0', 10) + items
                        .length);
                    if (!data.has_more || items.length < take) loadMoreBtn.style.display = 'none';
                }
            } catch (e) {
                console.error(e);
            } finally {
                loadMoreBtn.disabled = false;
            }
        }

        // Load More button
        loadMoreBtn.addEventListener("click", fetchMore)

        // Lightbox
        const lightbox = document.getElementById("lightbox");
        const lightboxImg = document.getElementById("lightbox-img");
        const closeBtn = document.getElementById("close");
        const prevBtn = document.getElementById("prev");
        const nextBtn = document.getElementById("next");

        let currentIndex = 0;

        function showImage(index) {
            const allImages = gallery.querySelectorAll("img");
            currentIndex = index;
            lightboxImg.src = allImages[index].src;
            lightbox.classList.add("active");
        }

        // Click on gallery image
        gallery.addEventListener("click", (e) => {
            if (e.target.tagName === "IMG") {
                const allImages = [...gallery.querySelectorAll("img")];
                showImage(allImages.indexOf(e.target));
            }
        });

        // Controls
        closeBtn.addEventListener("click", () => lightbox.classList.remove("active"));

        prevBtn.addEventListener("click", () => {
            const allImages = gallery.querySelectorAll("img:not(.hidden)");
            currentIndex = (currentIndex - 1 + allImages.length) % allImages.length;
            lightboxImg.src = allImages[currentIndex].src;
        });

        nextBtn.addEventListener("click", () => {
            const allImages = gallery.querySelectorAll("img:not(.hidden)");
            currentIndex = (currentIndex + 1) % allImages.length;
            lightboxImg.src = allImages[currentIndex].src;
        });

        // Close on background click
        lightbox.addEventListener("click", (e) => {
            if (e.target === lightbox) {
                lightbox.classList.remove("active");
            }
        });

        // Keyboard navigation
        document.addEventListener("keydown", (e) => {
            if (!lightbox.classList.contains("active")) return;
            if (e.key === "ArrowRight") nextBtn.click();
            if (e.key === "ArrowLeft") prevBtn.click();
            if (e.key === "Escape") closeBtn.click();
        });
    </script>


</body>

</html>
