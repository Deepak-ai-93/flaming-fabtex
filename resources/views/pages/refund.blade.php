@extends('layouts.app')

@section('title', 'Returns & Order Support | Fleming Fabtex')

@section('content')
<section class="section fleming-content-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">ORDER SUPPORT</span>
                <h1 class="sec-title">Returns &amp; order concerns</h1>
                <p class="sec-desc">Need help with an order? Contact the team with your quote or order reference so we can review the agreed terms.</p>
            </div>
            <a class="btn btn-p" href="{{ route('page.contact') }}">Contact our team <span aria-hidden="true">→</span></a>
        </div>

        <article class="policy-content co-section">
            <div class="policy-notice">
                <strong>Bulk and customized orders are confirmed individually.</strong>
                <p>This website does not take payment or place orders online. Return, replacement or refund terms should be confirmed in the written quote or order documents before production is approved.</p>
            </div>

            <section>
                <h2>Report a concern</h2>
                <p>If there is a concern with a delivered order, contact us as soon as possible. Include your quote or order reference, a description of the issue and clear photos where helpful. The team will review the matter against the confirmed order details.</p>
            </section>

            <section>
                <h2>Custom-branded garments</h2>
                <p>Personalized or custom-branded garments may have different return or replacement conditions. Check the written terms for your order and confirm artwork, sizes, colors and quantities before production begins.</p>
            </section>

            <section>
                <h2>Get in touch</h2>
                <p>Email <a href="mailto:info@flemingfabtex.com">info@flemingfabtex.com</a> or call <a href="tel:+917990718742">+91 79907 18742</a>. Include your order reference so we can direct your enquiry.</p>
            </section>
        </article>
    </div>
</section>
@endsection
