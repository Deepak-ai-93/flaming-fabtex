@extends('layouts.app')

@section('title', 'Request a Bulk Quote | Fleming Fabtex')

@section('content')
<section class="section fleming-quote-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">MADE FOR BULK APPAREL ORDERS</span>
                <h1 class="sec-title">Let’s build your quote</h1>
                <p class="sec-desc">Review your selected styles, share your requirements and send a ready-to-review request to our team.</p>
            </div>
            <a class="btn btn-o" href="{{ route('shop.index') }}">Add another style <span aria-hidden="true">→</span></a>
        </div>

        <p class="fq-msg err" data-storage-error hidden></p>

        <div class="fleming-checkout-grid fq-layout">
            <section class="co-section fq-products" aria-labelledby="quote-products-title">
                <div class="co-head">
                    <span class="co-num">01</span>
                    <h2 class="co-title" id="quote-products-title">Your selected styles</h2>
                </div>
                <div class="fq-items" data-quote-items aria-live="polite"></div>
                <div class="fq-empty" data-quote-empty>
                    <div class="fcart-empty-ico" aria-hidden="true">＋</div>
                    <h3>No styles selected yet</h3>
                    <p>Add products to your quote list before preparing the request.</p>
                    <a class="btn btn-p btn-sm" href="{{ route('shop.index') }}">Browse the catalog <span aria-hidden="true">→</span></a>
                </div>
                <div class="fq-list-foot">
                    <span>Minimum order: 25 pieces per style</span>
                    <a href="{{ route('cart.index') }}">Edit quantities in quote list</a>
                </div>
            </section>

            <aside class="co-section fq-contact" aria-labelledby="quote-contact-title">
                <div class="co-head">
                    <span class="co-num">02</span>
                    <h2 class="co-title" id="quote-contact-title">Your requirements</h2>
                </div>
                <p class="fq-form-intro">Tell us who to contact and what you need. We’ll prepare a WhatsApp message for you to review before sending.</p>
                <form class="fq-form" data-quote-request-form>
                    <div class="fq-field">
                        <label for="quote-name">Full name <span aria-hidden="true">*</span></label>
                        <input id="quote-name" name="name" type="text" autocomplete="name" required maxlength="100">
                    </div>
                    <div class="fq-field">
                        <label for="quote-company">Company / organization</label>
                        <input id="quote-company" name="company" type="text" autocomplete="organization" maxlength="120">
                    </div>
                    <div class="fq-field-row fq-full">
                        <div class="fq-field">
                            <label for="quote-phone">Phone <span aria-hidden="true">*</span></label>
                            <input id="quote-phone" name="phone" type="tel" autocomplete="tel" required maxlength="30">
                        </div>
                        <div class="fq-field">
                            <label for="quote-email">Email</label>
                            <input id="quote-email" name="email" type="email" autocomplete="email" maxlength="150">
                        </div>
                    </div>
                    <div class="fq-field fq-full">
                        <label for="quote-notes">Print, delivery or other details</label>
                        <textarea id="quote-notes" name="notes" rows="4" maxlength="1000" placeholder="Share your artwork, size mix, delivery PIN code or required date."></textarea>
                    </div>
                    <button class="btn btn-p fq-submit fq-full" type="submit" data-quote-submit disabled>Prepare WhatsApp request <span aria-hidden="true">→</span></button>
                    <p class="fq-msg fq-full" data-quote-message role="status" aria-live="polite"></p>
                    <a class="btn btn-o fq-send-link fq-full" data-quote-send-link target="_blank" rel="noopener noreferrer" hidden>Review and send in WhatsApp <span aria-hidden="true">↗</span></a>
                </form>
                <p class="fq-privacy">Your information stays in this form until you open WhatsApp. Nothing is submitted to this website or sent without your confirmation.</p>
            </aside>
        </div>
    </div>
</section>
@endsection
