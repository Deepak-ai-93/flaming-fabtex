@extends('layouts.app')

@section('title', 'Your Quote List | Fleming Fabtex')

@section('content')
<section class="section fleming-cart-page" data-cart-page>
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">BULK ORDER WORKSPACE</span>
                <h1 class="sec-title">Your quote list</h1>
                <p class="sec-desc">Collect styles and quantities here, then send the details to our team for a confirmed quote.</p>
            </div>
            <a class="btn btn-o" href="{{ route('shop.index') }}">Continue browsing <span aria-hidden="true">→</span></a>
        </div>

        <p class="fq-msg err" data-storage-error hidden></p>

        <div class="fleming-checkout-grid fcart-layout">
            <section class="co-section fcart-main" aria-labelledby="cart-products-title">
                <div class="co-head">
                    <span class="co-num">01</span>
                    <h2 class="co-title" id="cart-products-title">Selected products</h2>
                </div>
                <p class="fcart-moq">Bulk pricing is estimated by quantity. Minimum order quantity: <strong>25 pieces per style.</strong></p>

                <div data-cart-content hidden>
                    <ul class="fcart-items" data-cart-items aria-label="Products in your quote list"></ul>
                    <div class="fcart-foot">
                        <span><strong data-cart-lines>0</strong> styles · <strong data-cart-pieces>0</strong> pieces</span>
                        <button class="fcart-clear" type="button" data-clear-quote>Clear quote list</button>
                    </div>
                </div>

                <div class="fcart-empty" data-cart-empty>
                    <div class="fcart-empty-ico" aria-hidden="true">＋</div>
                    <h2>Your quote list is ready for products</h2>
                    <p>Add a style from the catalog or configure product options first. Your list stays in this browser.</p>
                    <a class="btn btn-p" href="{{ route('shop.index') }}">Explore bulk apparel <span aria-hidden="true">→</span></a>
                </div>
                <noscript>
                    <p class="fq-msg err">Enable JavaScript to manage your local quote list.</p>
                </noscript>
            </section>

            <aside class="co-section fcart-summary" aria-labelledby="cart-summary-title">
                <div class="co-head">
                    <span class="co-num">02</span>
                    <h2 class="co-title" id="cart-summary-title">Estimate summary</h2>
                </div>
                <div class="fcart-totals">
                    <div class="fcart-total-row"><span>Styles</span><strong data-cart-lines>0</strong></div>
                    <div class="fcart-total-row"><span>Total pieces</span><strong data-cart-pieces>0</strong></div>
                    <div class="fcart-total-row fcart-total"><span>Indicative product estimate</span><strong data-cart-estimate>₹0</strong></div>
                </div>
                <p class="fcart-note">This is an indicative estimate, not an order or final invoice. Printing, size mix, stock, shipping and applicable taxes are confirmed in your written quote.</p>
                <a class="btn btn-p fcart-checkout-btn" href="{{ route('quote.index') }}">Continue to quote request <span aria-hidden="true">→</span></a>
                <a class="fcart-back" href="tel:+917990718742">Prefer to talk? Call +91 79907 18742</a>
                <div class="fcart-trust">
                    <span aria-hidden="true">✓</span>
                    <p><strong>No payment collected here.</strong><br>Your request is reviewed by the factory team before any commitment.</p>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
