@extends('layouts.app')

@section('title', 'Privacy Information | Fleming Fabtex')

@section('content')
<section class="section fleming-content-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">YOUR INFORMATION</span>
                <h1 class="sec-title">Privacy information</h1>
                <p class="sec-desc">How the quote list and enquiry features on this website handle information.</p>
            </div>
            <a class="btn btn-o" href="{{ route('page.contact') }}">Contact us <span aria-hidden="true">→</span></a>
        </div>

        <article class="policy-content co-section">
            <p class="policy-intro">This website is designed to help you browse products and prepare a bulk enquiry. It does not submit quote or contact forms to a Fleming Fabtex server.</p>

            <section>
                <h2>Quote list stored in your browser</h2>
                <p>Products you add to the quote list and their selected quantities are stored in your browser’s local storage so they remain available when you return to the site on that browser. You can remove items or clear the list from the cart page. Clearing browser data also removes the saved list.</p>
            </section>

            <section>
                <h2>Enquiry details and WhatsApp</h2>
                <p>Information entered in the quote or contact form is used in your browser to prepare a message. The website does not send the form automatically. If you choose to open WhatsApp, the message is passed to WhatsApp and is handled under WhatsApp’s own privacy terms. You can review or edit the message before sending it.</p>
            </section>

            <section>
                <h2>Technical information</h2>
                <p>Your browser and hosting environment may process technical request information needed to deliver and protect the site. The site also requests fonts from Google Fonts, which may receive connection information as part of serving those fonts. Do not include sensitive personal information in a quote or contact message.</p>
            </section>

            <section>
                <h2>Your choices and questions</h2>
                <p>You can clear your saved quote list in the browser or avoid entering information in the enquiry forms. For privacy questions, contact <a href="mailto:info@flemingfabtex.com">info@flemingfabtex.com</a>.</p>
            </section>
        </article>
    </div>
</section>
@endsection
