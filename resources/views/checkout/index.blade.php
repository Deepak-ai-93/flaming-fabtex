@extends('layouts.app')

@section('title', 'Bulk Order Process | Fleming Fabtex')

@section('content')
<section class="section fleming-checkout-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">A CLEARER WAY TO ORDER</span>
                <h1 class="sec-title">Bulk order process</h1>
                <p class="sec-desc">Every large order starts with the right product, quantity and written quote—not a surprise checkout.</p>
            </div>
        </div>

        <div class="fleming-checkout-grid fcheckout-layout">
            <section class="co-section fcheckout-steps" aria-labelledby="order-steps-title">
                <div class="co-head">
                    <span class="co-num">01</span>
                    <h2 class="co-title" id="order-steps-title">From enquiry to production</h2>
                </div>
                <ol class="fcheckout-timeline">
                    <li>
                        <span class="fcheckout-step">01</span>
                        <div><h3>Choose your styles</h3><p>Add products, color and size requirements to your quote list. Bulk minimums start at 25 pieces per style.</p></div>
                    </li>
                    <li>
                        <span class="fcheckout-step">02</span>
                        <div><h3>Send your requirements</h3><p>Share quantities, artwork, delivery PIN code and timing with our team through a quote request.</p></div>
                    </li>
                    <li>
                        <span class="fcheckout-step">03</span>
                        <div><h3>Review the written quote</h3><p>We confirm product availability, branding, final pricing, applicable taxes and delivery details for your approval.</p></div>
                    </li>
                    <li>
                        <span class="fcheckout-step">04</span>
                        <div><h3>Approve before production</h3><p>Production or payment arrangements are discussed only after you approve the confirmed quote.</p></div>
                    </li>
                </ol>
            </section>

            <aside class="co-section fcheckout-aside" aria-labelledby="checkout-help-title">
                <div class="co-head">
                    <span class="co-num">02</span>
                    <h2 class="co-title" id="checkout-help-title">Ready to get started?</h2>
                </div>
                <p>Prepare your product list and our team can help with bulk pricing, size splits and custom branding options.</p>
                <a class="btn btn-p fcheckout-cta" href="{{ route('cart.index') }}">Review your quote list <span aria-hidden="true">→</span></a>
                <a class="btn btn-o fcheckout-cta" href="{{ route('quote.index') }}">Request a bulk quote <span aria-hidden="true">→</span></a>
                <div class="fcheckout-contact">
                    <span class="sec-eyebrow">TALK TO OUR TEAM</span>
                    <a href="tel:+917990718742">+91 79907 18742</a>
                    <a href="mailto:info@flemingfabtex.com">info@flemingfabtex.com</a>
                </div>
                <p class="fcheckout-disclaimer">This site does not collect online payment or confirm orders. Prices shown in the catalog are indicative; the written quote is the source for final order details.</p>
            </aside>
        </div>
    </div>
</section>
@endsection
