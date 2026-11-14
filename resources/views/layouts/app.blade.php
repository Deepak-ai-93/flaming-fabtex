<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/tokens.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ffx-sections.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/motion.css') }}">
</head>
<body>
@php
    $searchQuery = request()->query('s');
    $searchQuery = is_string($searchQuery) ? $searchQuery : '';
@endphp
<a class="skip-link" href="#content">Skip to main content</a>

<div class="announce">
    <span>Bulk apparel from Ahmedabad · <b>Fleming Fabtex est. 2013</b> · MOQ from 25 pieces per style</span>
</div>

<header class="nav" id="main-header">
    <div class="wrap nav-in">
        <a class="nav-logo" href="{{ route('home') }}" aria-label="Fleming Fabtex — Home">
            <img class="nav-logo-img" src="{{ asset('assets/img/logo-white.png') }}" alt="Fleming Fabtex" width="129" height="35">
        </a>

        <nav class="nav-links" aria-label="Primary">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop.index') }}">Catalog</a>
            <a href="{{ route('home') }}#pricing">Bulk Pricing</a>
            <a href="{{ route('page.about') }}">About Us</a>
            <a href="{{ route('page.contact') }}">Contact</a>
        </nav>

        <div class="nav-act">
            <form class="nav-search-form" method="get" action="{{ route('shop.index') }}" role="search">
                <input type="search" name="s" aria-label="Search catalog" placeholder="Search T-shirts, polos, hoodies..." value="{{ $searchQuery }}">
            </form>
            <a class="btn btn-o btn-quote" href="{{ route('quote.index') }}" aria-label="Request a quote">
                <span>Quote</span>
                <span class="badge" id="fleming-quote-count">0</span>
            </a>
            <a class="btn btn-o btn-cart" href="{{ route('cart.index') }}" aria-label="Open cart">
                <span>Cart</span>
                <span class="badge" id="fleming-bag-count">0</span>
            </a>
            <button type="button" class="burger" id="burger-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mobile-menu">☰</button>
        </div>
    </div>
</header>

<div id="mobile-menu" class="mobile-drawer" aria-hidden="true">
    <div class="wrap mob-nav">
        <form class="mob-search" method="get" action="{{ route('shop.index') }}" role="search">
            <input type="search" name="s" aria-label="Search catalog" placeholder="Search bulk catalog..." value="{{ $searchQuery }}">
        </form>
        <a href="{{ route('home') }}" class="mob-link">Home</a>
        <a href="{{ route('shop.index') }}" class="mob-link">Catalog &amp; Styles</a>
        <a href="{{ route('home') }}#pricing" class="mob-link">Bulk Pricing Slabs</a>
        <a href="{{ route('page.about') }}" class="mob-link">About Facility</a>
        <a href="{{ route('page.contact') }}" class="mob-link">Contact &amp; Custom Quote</a>
        <a href="{{ route('quote.index') }}" class="btn btn-o mob-quote">Request a Quote</a>
        <a href="{{ route('cart.index') }}" class="btn btn-p mob-cart">View Cart / Enquiry Bag</a>
    </div>
</div>

<main id="content">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="wrap">
        <div class="f-grid">
            <div class="f-brand">
                <a class="f-logo" href="{{ route('home') }}" aria-label="Fleming Fabtex home">
                    <img class="f-logo-img" src="{{ asset('assets/img/logo-white.png') }}" alt="Fleming Fabtex" width="129" height="35" loading="lazy">
                </a>
                <p class="f-desc">Ahmedabad-based apparel manufacturer focused on bulk garments, corporate wear and promotional apparel.</p>
                <p class="f-contact">
                    <span>Khokhra, Ahmedabad, Gujarat 380026</span><br>
                    <a href="tel:+917990718742">+91 79907 18742</a> ·
                    <a href="mailto:info@flemingfabtex.com">info@flemingfabtex.com</a>
                </p>
                <div class="f-social" aria-label="Contact Fleming Fabtex">
                    <a class="f-soc" href="https://wa.me/917990718742?text=Hi%20Fleming%20Fabtex%2C%20I%20need%20a%20bulk%20quote" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">WA</a>
                    <a class="f-soc" href="https://www.instagram.com/flemingfabtex" target="_blank" rel="noopener noreferrer" aria-label="Instagram">IG</a>
                    <a class="f-soc" href="tel:+917990718742" aria-label="Call Fleming Fabtex">☎</a>
                </div>
            </div>

            <div class="f-col f-col--links">
                <h5>Products</h5>
                <a href="{{ route('shop.index') }}">Round Neck T-Shirts</a>
                <a href="{{ route('shop.index') }}">Collar Polos</a>
                <a href="{{ route('shop.index') }}">Hoodies &amp; Jackets</a>
                <a href="{{ route('shop.index') }}">School Uniforms</a>
                <a href="{{ route('shop.index') }}">Corporate Wear</a>
            </div>

            <div class="f-col f-col--links">
                <h5>Company</h5>
                <a href="{{ route('page.about') }}">About Us</a>
                <a href="{{ route('page.infrastructure') }}">Infrastructure</a>
                <a href="{{ route('page.store') }}">Our Store</a>
                <a href="{{ route('page.contact') }}">Contact Us</a>
            </div>

            <div class="f-col f-col--cta">
                <h5>Direct Factory Enquiry</h5>
                <p class="f-cta-text">Planning custom branding or a bulk apparel order? Share your requirements with our team.</p>
                <a href="{{ route('quote.index') }}" class="btn btn-p f-cta-btn">Request Quotation <span aria-hidden="true">→</span></a>
                <div class="f-trust-list">
                    ✓ MOQ from 25 pcs per style<br>
                    ✓ Availability confirmed by quote<br>
                    ✓ Order details confirmed in writing
                </div>
            </div>
        </div>

        <div class="f-bot">
            <span>© {{ date('Y') }} Fleming Fabtex. All rights reserved.</span>
            <span>Indicative catalog prices · Final details in written quote</span>
        </div>
    </div>
</footer>

<div class="fab-dock" id="fab-dock" aria-label="Quick contact">
    <div class="fab-menu" id="fab-menu" role="menu" aria-hidden="true">
        <a class="fab fab-ig" href="https://www.instagram.com/flemingfabtex" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><span aria-hidden="true">IG</span></a>
        <a class="fab fab-call" href="tel:+917990718742" aria-label="Call factory"><span aria-hidden="true">☎</span></a>
        <a class="fab fab-wa" href="https://wa.me/917990718742?text=Hi%20Fleming%20Fabtex%2C%20I%20need%20a%20bulk%20quote" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp"><span aria-hidden="true">WA</span></a>
        <button type="button" class="fab fab-top" id="fab-to-top" aria-label="Back to top"><span aria-hidden="true">↑</span></button>
    </div>
    <button type="button" class="fab fab-main" id="fab-toggle" aria-expanded="false" aria-controls="fab-menu" aria-label="Open contact options">
        <span class="fab-main-swap" aria-hidden="true">
            <svg class="fab-ico fab-ico-chat" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
            <svg class="fab-ico fab-ico-close" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"></path></svg>
        </span>
        <span class="fab-tip">Contact us</span>
    </button>
</div>

<script src="{{ asset('assets/js/vendor/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/ScrollTrigger.min.js') }}"></script>
</body>
</html>
