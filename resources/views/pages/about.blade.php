@extends('layouts.app')

@section('title', 'About Fleming Fabtex | Bulk Apparel')

@section('content')
<section class="section fleming-content-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">ABOUT FLEMING FABTEX</span>
                <h1 class="sec-title">Apparel for teams, businesses and events</h1>
                <p class="sec-desc">Fleming Fabtex is an Ahmedabad-based apparel manufacturer focused on bulk clothing and custom business requirements.</p>
            </div>
            <a class="btn btn-p" href="{{ route('quote.index') }}">Discuss a bulk order <span aria-hidden="true">→</span></a>
        </div>

        <div class="content-intro co-section">
            <span class="content-mark" aria-hidden="true">FF</span>
            <div>
                <span class="sec-eyebrow">AHMEDABAD · EST. 2013</span>
                <h2>Built around the brief</h2>
                <p>From promotional T-shirts to corporate apparel, every bulk requirement starts with understanding the intended use, quantity, garment and branding. Our team helps customers explore suitable options and confirms the details in a written quote.</p>
            </div>
        </div>

        <div class="content-feature-grid">
            <article class="co-section content-feature">
                <span class="content-feature-num">01</span>
                <h2>Product selection</h2>
                <p>Compare available styles and share your preferred fabric, fit, color and size requirements before confirming an order.</p>
            </article>
            <article class="co-section content-feature">
                <span class="content-feature-num">02</span>
                <h2>Branding details</h2>
                <p>Provide your artwork, print or embroidery preference and placement. The team will confirm the suitable method for the selected garment.</p>
            </article>
            <article class="co-section content-feature">
                <span class="content-feature-num">03</span>
                <h2>Clear quote first</h2>
                <p>Quantity, availability, production details, delivery and applicable taxes are reviewed before a final quote is issued.</p>
            </article>
        </div>

        <div class="content-contact-band">
            <div>
                <span class="sec-eyebrow">BASED IN KHOKHRA, AHMEDABAD</span>
                <h2>Have a bulk apparel requirement?</h2>
                <p>Share the outline of your order and our team can help you take it forward.</p>
            </div>
            <div class="account-actions">
                <a class="btn btn-p" href="{{ route('quote.index') }}">Request a quote <span aria-hidden="true">→</span></a>
                <a class="btn btn-o" href="{{ route('page.contact') }}">Contact us</a>
            </div>
        </div>
    </div>
</section>
@endsection
