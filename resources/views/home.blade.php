@extends('layouts.app')

@section('title', 'Fleming Fabtex | Bulk T-Shirt Manufacturer, Ahmedabad')

@section('content')
<div class="marquee" role="presentation" aria-hidden="true">
    <div class="marquee-track">
        @foreach (range(1, 2) as $copy)
            <span>Plain T-Shirts <i>•</i> Promotional Wear <i>•</i> Corporate Polos <i>•</i> School Uniforms <i>•</i> Sweatshirts <i>•</i> Hoodies <i>•</i> Event Tees <i>•</i> Bio-Wash Cotton <i>•</i></span>
        @endforeach
    </div>
</div>

<section class="hero-stage" data-hero-v2>
    <div class="hero-bg" aria-hidden="true">
        <i class="blob b1"></i>
        <i class="blob b2"></i>
        <i class="blob b3"></i>
        <i class="grid"></i>
    </div>
    <div class="wrap">
        <div class="hero">
            <div class="hero-copy">
                <div class="eyebrow eyebrow-pill" data-hero-el>
                    <span class="cap-dot"></span>
                    Ahmedabad-based apparel manufacturing • Est. 2013
                </div>
                <h1 class="hero-h1" data-hero-el>
                    <span class="hw"><span class="hw-in">Custom Bulk Apparel,</span></span>
                    <span class="hw"><span class="hw-in"><em class="hero-em">Factory Direct</em></span></span>
                </h1>
                <p class="lede" data-hero-el>
                    Bulk apparel for businesses, schools, teams and events. Share your style, quantity, artwork and delivery needs to get a tailored written quote.
                </p>
                <p class="hero-rot" data-rotator data-hero-el>
                    We print &amp; stitch
                    <span class="rot-word" data-words="T-Shirts|Polos|Hoodies|Sweatshirts|Uniforms|Woven Tees">Polos</span>
                    for corporates, schools &amp; brands
                </p>
                <div class="hero-btns" data-hero-el>
                    <a class="btn btn-p btn-lg" href="{{ route('shop.index') }}">Explore Catalog <span aria-hidden="true">→</span></a>
                    <a class="btn btn-o btn-lg" href="#pricing">Bulk Pricing Slabs</a>
                </div>
                <div class="hero-trust" data-hero-el>
                    <span><b aria-hidden="true">✓</b> 25 MOQ</span>
                    <span><b aria-hidden="true">✓</b> Availability confirmed by quote</span>
                    <span><b aria-hidden="true">✓</b> Custom options by style</span>
                    <span><b aria-hidden="true">✓</b> Written order details</span>
                </div>
            </div>

            <div class="hero-media-wrap" data-hero>
                <div class="hero-media" data-media>
                    <img src="{{ asset('assets/img/image-10NH.png') }}" alt="Custom apparel manufactured by Fleming Fabtex" width="688" height="606" fetchpriority="high">
                </div>
                <div class="hero-badge-float"><span class="dot"></span> Ahmedabad • Est. 2013</div>
                <div class="pill pill-moq" data-pill data-depth="0.5"><span class="pill-k">MOQ</span> <b>25</b> pcs</div>
                <div class="hero-stamp" data-pill data-depth="0.3">
                    <i class="hero-stamp-ring" aria-hidden="true"></i>
                    <span class="stamp-core"><b>FF</b><small>Est. 2013</small></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section stats-band" aria-label="Bulk apparel ordering at a glance">
    <div class="wrap">
        <div class="stats">
            <div class="stat">
                <div class="stat-num">25 pcs</div>
                <div class="stat-lbl">Minimum per style</div>
            </div>
            <div class="stat">
                <div class="stat-num">Ahmedabad</div>
                <div class="stat-lbl">Manufacturing base</div>
            </div>
            <div class="stat">
                <div class="stat-num">Written quote</div>
                <div class="stat-lbl">Order details confirmed</div>
            </div>
            <div class="stat">
                <div class="stat-num">Style-led</div>
                <div class="stat-lbl">Availability confirmed per request</div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap sec-head">
        <div>
            <div class="eyebrow"><span class="cap-dot"></span> Direct From Ahmedabad Facility</div>
            <h2>Popular Styles for Bulk Orders</h2>
        </div>
        <a class="link-more" href="{{ route('shop.index') }}">View Complete Catalog <span aria-hidden="true">→</span></a>
    </div>
    <div class="wrap">
        <ul class="p-grid">
            @foreach ($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </ul>
    </div>
</section>

<section class="section features-section">
    <div class="wrap sec-head">
        <div>
            <span class="eyebrow">Industry Offerings</span>
            <h2>Specialized Manufacturing by Sector</h2>
        </div>
        <a class="link-more" href="{{ route('shop.index') }}">Explore All Sectors <span aria-hidden="true">→</span></a>
    </div>
    <div class="wrap">
        <div class="features-grid">
            <a class="feature-card" href="{{ route('shop.index') }}">
                <div class="feature-num">01</div>
                <h3 class="feature-title">Corporate Wear</h3>
                <p class="feature-desc">Polo &amp; formal bio-wash apparel</p>
            </a>
            <a class="feature-card" href="{{ route('shop.index') }}">
                <div class="feature-num">02</div>
                <h3 class="feature-title">Plain T-Shirts</h3>
                <p class="feature-desc">180–240 GSM bulk blanks</p>
            </a>
            <a class="feature-card" href="{{ route('shop.index') }}">
                <div class="feature-num">03</div>
                <h3 class="feature-title">Promotional Tees</h3>
                <p class="feature-desc">High-volume event shirts</p>
            </a>
            <a class="feature-card" href="{{ route('shop.index') }}">
                <div class="feature-num">04</div>
                <h3 class="feature-title">School Uniforms</h3>
                <p class="feature-desc">Durable, colorfast poly-cotton</p>
            </a>
            <a class="feature-card" href="{{ route('shop.index') }}">
                <div class="feature-num">05</div>
                <h3 class="feature-title">Hoodies &amp; Jackets</h3>
                <p class="feature-desc">Winter fleeces &amp; zipper hoodies</p>
            </a>
            <a class="feature-card" href="{{ route('shop.index') }}">
                <div class="feature-num">06</div>
                <h3 class="feature-title">Custom Printing</h3>
                <p class="feature-desc">Screen, DTF &amp; embroidery</p>
            </a>
        </div>
    </div>
</section>

<section class="section pricing-section" id="pricing">
    <div class="wrap">
        <div class="pricing-card">
            <div class="pricing-head sec-head">
                <div>
                    <span class="eyebrow">BULK QUOTE GUIDE</span>
                    <h2>Pricing for your order</h2>
                </div>
                <p class="pricing-lede">Prices depend on the style, quantity and customization. Request a written quote to confirm pricing, taxes and delivery.</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-tier">
                    <div class="pricing-tier-label">Starter Slab</div>
                    <div class="pricing-tier-range">25–99 pcs</div>
                    <div class="pricing-tier-desc">Start with a selected style and size mix</div>
                </div>
                <div class="pricing-tier">
                    <div class="pricing-tier-label">Bulk Slab</div>
                    <div class="pricing-tier-range">100–299 pcs</div>
                    <div class="pricing-tier-desc">Ask for a quantity-specific quote</div>
                </div>
                <div class="pricing-tier pricing-tier-featured">
                    <div class="pricing-tier-label">Corporate Slab</div>
                    <div class="pricing-tier-range">300–999 pcs</div>
                    <div class="pricing-tier-desc">Branding and delivery confirmed by quote</div>
                </div>
                <div class="pricing-tier">
                    <div class="pricing-tier-label">Enterprise / Govt</div>
                    <div class="pricing-tier-range">1,000+ pcs</div>
                    <div class="pricing-tier-desc">Production plan confirmed in writing</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section flow-section">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="eyebrow">Order Flow</span>
                <h2>How B2B Manufacturing Works</h2>
            </div>
            <a class="btn btn-p" href="{{ route('quote.index') }}">Request a Quote <span aria-hidden="true">→</span></a>
        </div>
        <div class="flow-grid">
            <div class="flow-step">
                <div class="flow-step-num">01. SPECIFY</div>
                <h3 class="flow-step-title">Select GSM &amp; Color</h3>
                <p class="flow-step-desc">Pick your apparel style, preferred fabric density, and split sizes S–XXL.</p>
            </div>
            <div class="flow-step">
                <div class="flow-step-num">02. CUSTOMIZE</div>
                <h3 class="flow-step-title">Brand Proof &amp; Sample</h3>
                <p class="flow-step-desc">Send your logo or tech pack. We provide a digital mockup and dispatch a sample within 48 hours.</p>
            </div>
            <div class="flow-step">
                <div class="flow-step-num">03. DISPATCH</div>
                <h3 class="flow-step-title">Bulk Production &amp; Freight</h3>
                <p class="flow-step-desc">Manufactured in Ahmedabad with QA checks, GST invoice, and doorstep tracking across India.</p>
            </div>
        </div>
    </div>
</section>
@endsection
