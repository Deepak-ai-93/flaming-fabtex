@extends('layouts.app')

@section('title', 'Contact Fleming Fabtex | Bulk Apparel Enquiries')

@section('content')
<section class="section fleming-contact-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">LET’S TALK BULK APPAREL</span>
                <h1 class="sec-title">Talk to the factory team</h1>
                <p class="sec-desc">Share your style, quantity and branding requirements. We’ll help you work out the next step.</p>
            </div>
        </div>

        <div class="fleming-checkout-grid fcontact-layout">
            <section class="co-section" aria-labelledby="contact-form-title">
                <div class="co-head">
                    <span class="co-num">01</span>
                    <h2 class="co-title" id="contact-form-title">Send an enquiry</h2>
                </div>
                <p class="fq-form-intro">Complete the form to prepare a WhatsApp message. It won’t be sent until you review and confirm it in WhatsApp.</p>
                <form class="fq-form" data-contact-form>
                    <div class="fq-field">
                        <label for="contact-name">Full name <span aria-hidden="true">*</span></label>
                        <input id="contact-name" name="name" type="text" autocomplete="name" required maxlength="100">
                    </div>
                    <div class="fq-field">
                        <label for="contact-email">Email <span aria-hidden="true">*</span></label>
                        <input id="contact-email" name="email" type="email" autocomplete="email" required maxlength="150">
                    </div>
                    <div class="fq-field">
                        <label for="contact-phone">Phone <span aria-hidden="true">*</span></label>
                        <input id="contact-phone" name="phone" type="tel" autocomplete="tel" required maxlength="30">
                    </div>
                    <div class="fq-field">
                        <label for="contact-subject">Subject <span aria-hidden="true">*</span></label>
                        <input id="contact-subject" name="subject" type="text" required maxlength="120">
                    </div>
                    <div class="fq-field fq-full">
                        <label for="contact-message">How can we help? <span aria-hidden="true">*</span></label>
                        <textarea id="contact-message" name="message" rows="5" required maxlength="1500"></textarea>
                    </div>
                    <button class="btn btn-p fq-submit fq-full" type="submit">Prepare WhatsApp message <span aria-hidden="true">→</span></button>
                    <p class="fq-msg fq-full" data-contact-message role="status" aria-live="polite"></p>
                    <a class="btn btn-o fq-send-link fq-full" data-contact-send-link target="_blank" rel="noopener noreferrer" hidden>Review and send in WhatsApp <span aria-hidden="true">↗</span></a>
                </form>
                <p class="fq-privacy">This website does not submit or store this contact form. Your browser passes the message to WhatsApp only after you choose to open it.</p>
            </section>

            <aside class="fcontact-info">
                <div class="co-section">
                    <div class="co-head">
                        <span class="co-num">02</span>
                        <h2 class="co-title">Contact details</h2>
                    </div>
                    <div class="fcontact-detail">
                        <span class="sec-eyebrow">PHONE &amp; WHATSAPP</span>
                        <a href="tel:+917990718742">+91 79907 18742</a>
                    </div>
                    <div class="fcontact-detail">
                        <span class="sec-eyebrow">EMAIL</span>
                        <a href="mailto:info@flemingfabtex.com">info@flemingfabtex.com</a>
                    </div>
                    <div class="fcontact-detail">
                        <span class="sec-eyebrow">LOCATION</span>
                        <p>Fleming Fabtex<br>Khokhra, Ahmedabad, Gujarat 380026, India</p>
                    </div>
                    <a class="btn btn-p fcontact-direct" href="https://wa.me/917990718742?text=Hi%20Fleming%20Fabtex%2C%20I%20have%20a%20bulk%20apparel%20enquiry." target="_blank" rel="noopener noreferrer">Chat with us on WhatsApp <span aria-hidden="true">↗</span></a>
                </div>

                <div class="fcontact-quicklinks">
                    <span class="sec-eyebrow">EXPLORE FLEMING FABTEX</span>
                    <a href="{{ route('shop.index') }}">Browse the catalog <span aria-hidden="true">→</span></a>
                    <a href="{{ route('page.about') }}">About the company <span aria-hidden="true">→</span></a>
                    <a href="{{ route('page.privacy') }}">Privacy information <span aria-hidden="true">→</span></a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
