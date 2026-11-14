@extends('layouts.app')

@section('title', 'Production & Customization | Fleming Fabtex')

@section('content')
<section class="section fleming-content-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">HOW WE WORK</span>
                <h1 class="sec-title">Production starts with the right details</h1>
                <p class="sec-desc">A practical overview of what to share when you’re planning a bulk apparel order.</p>
            </div>
            <a class="btn btn-p" href="{{ route('quote.index') }}">Start a quote <span aria-hidden="true">→</span></a>
        </div>

        <div class="content-feature-grid">
            <article class="co-section content-feature">
                <span class="content-feature-num">01</span>
                <h2>Choose the garment</h2>
                <p>Start with the product style and intended use. The available fabric, fit, color and size range depend on the style selected.</p>
            </article>
            <article class="co-section content-feature">
                <span class="content-feature-num">02</span>
                <h2>Share branding needs</h2>
                <p>Include your logo or artwork, print or embroidery preference, placement and any color requirements. We’ll confirm options for your garment.</p>
            </article>
            <article class="co-section content-feature">
                <span class="content-feature-num">03</span>
                <h2>Confirm the order plan</h2>
                <p>Quantities, size mix, production timing and delivery details are reviewed with you as part of the written quote.</p>
            </article>
        </div>

        <div class="content-info-grid">
            <section class="co-section content-info-card">
                <span class="sec-eyebrow">HELPFUL TO INCLUDE</span>
                <h2>What to prepare for a quote</h2>
                <ul class="content-check-list">
                    <li>Product style and approximate quantity</li>
                    <li>Color options and size breakdown</li>
                    <li>Artwork and branding placement</li>
                    <li>Required delivery date and PIN code</li>
                </ul>
            </section>
            <section class="co-section content-info-card content-info-highlight">
                <span class="sec-eyebrow">MADE TO ORDER DETAILS</span>
                <h2>Confirm before production</h2>
                <p>Product availability, customization method, final price and timing can vary by order. Review the written quote and approved artwork before confirming production.</p>
                <a class="content-inline-link" href="{{ route('page.contact') }}">Ask our team a question <span aria-hidden="true">→</span></a>
            </section>
        </div>
    </div>
</section>
@endsection
