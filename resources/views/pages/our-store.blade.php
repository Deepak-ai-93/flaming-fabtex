@extends('layouts.app')

@section('title', 'Visit Fleming Fabtex | Ahmedabad')

@section('content')
<section class="section fleming-content-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">FLEMING FABTEX · AHMEDABAD</span>
                <h1 class="sec-title">Connect with our team</h1>
                <p class="sec-desc">Talk to us about product options, fabric samples and your bulk apparel requirements.</p>
            </div>
            <a class="btn btn-p" href="{{ route('page.contact') }}">Get in touch <span aria-hidden="true">→</span></a>
        </div>

        <div class="store-layout">
            <section class="store-location co-section">
                <span class="sec-eyebrow">OUR LOCATION</span>
                <h2>Fleming Fabtex</h2>
                <p>Khokhra, Ahmedabad<br>Gujarat 380026, India</p>
                <div class="store-region-card">
                    <span>BASED IN</span>
                    <strong>KHOKHRA, AHMEDABAD</strong>
                    <small>GUJARAT · INDIA</small>
                </div>
                <p class="fcart-note">Please contact us before planning an in-person visit to confirm availability and visit details.</p>
            </section>

            <aside class="store-visit co-section">
                <span class="content-feature-num">01</span>
                <h2>Plan a product discussion</h2>
                <p>Tell us the product type, quantity and customization you’re considering. Our team can guide you on the next steps and confirm whether samples or a visit can be arranged.</p>
                <div class="store-contact-links">
                    <a href="tel:+917990718742"><span>Call</span><strong>+91 79907 18742</strong></a>
                    <a href="mailto:info@flemingfabtex.com"><span>Email</span><strong>info@flemingfabtex.com</strong></a>
                </div>
                <a class="btn btn-p store-cta" href="{{ route('quote.index') }}">Prepare a quote request <span aria-hidden="true">→</span></a>
            </aside>
        </div>
    </div>
</section>
@endsection
