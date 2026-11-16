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

@php
    $heroSlides = [
        [
            'image' => asset('assets/img/WhatsApp-Image-2026-10-14-at-9.18.18-AM.jpeg'),
            'alt' => 'Fleming Fabtex Custom Bulk Apparel Manufacturing',
            'link' => route('shop.index'),
        ],
        [
            'image' => asset('assets/img/WhatsApp-Image-2026-10-14-at-9.19.05-AM.jpeg'),
            'alt' => 'Corporate Polos, T-Shirts and Promotional Wear',
            'link' => route('shop.index'),
        ],
        [
            'image' => asset('assets/img/WhatsApp-Image-2026-10-14-at-9.16.24-AM-600x260.jpeg'),
            'alt' => 'Factory Direct Bulk Apparel Production',
            'link' => route('shop.index'),
        ],
    ];
@endphp

<section class="hero-stage hero-simple" data-hero-slider aria-label="Bulk apparel showcase">
    <div class="hero-full-progress" aria-hidden="true"><i data-progress></i></div>
    
    <div class="hero-full-track" data-track>
        @foreach ($heroSlides as $index => $slide)
            <div class="hero-full-slide {{ $index === 0 ? 'is-active' : '' }}" data-slide aria-hidden="{{ $index === 0 ? 'false' : 'true' }}">
                <div class="hero-full-bg" style="background-image: url('{{ $slide['image'] }}');" aria-hidden="true"></div>
                <a href="{{ $slide['link'] }}" class="hero-full-link" aria-label="{{ $slide['alt'] }}" tabindex="{{ $index === 0 ? '0' : '-1' }}">
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['alt'] }}" {!! $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"' !!}>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Desktop side navigation arrows -->
    <button type="button" class="hero-arrow-side hero-prev" data-prev aria-label="Previous slide">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>
    <button type="button" class="hero-arrow-side hero-next" data-next aria-label="Next slide">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>

    <!-- Glassmorphic floating control pill -->
    <div class="hero-full-controls" role="region" aria-label="Slider controls">
        <button type="button" class="hero-arrow hero-prev" data-prev aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <div class="hero-dots" role="tablist" aria-label="Slide dots">
            @foreach ($heroSlides as $index => $slide)
                <button type="button" class="hero-dot {{ $index === 0 ? 'is-active' : '' }}" data-dot role="tab" aria-label="Slide {{ $index + 1 }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}"></button>
            @endforeach
        </div>
        <button type="button" class="hero-arrow hero-next" data-next aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
        <span class="hero-count" data-count aria-live="polite">01 / {{ sprintf('%02d', count($heroSlides)) }}</span>
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
