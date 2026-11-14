@extends('layouts.app')

@section('title', 'Order Information | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">Order information</h1>
                <p class="sec-desc">A clear note on how to get support for your bulk order.</p>
            </div>
            <a class="btn btn-o" href="{{ route('account.dashboard') }}">Back to account <span aria-hidden="true">→</span></a>
        </div>

        <div class="co-section account-empty-state">
            <div class="fcart-empty-ico" aria-hidden="true">i</div>
            <h2>Online order history isn’t available here</h2>
            <p>This website does not currently place or track orders online. If you have an order confirmed by the Fleming Fabtex team, contact us with your quote or order reference and we’ll help.</p>
            <div class="account-actions">
                <a class="btn btn-p" href="tel:+917990718742">Call +91 79907 18742</a>
                <a class="btn btn-o" href="mailto:info@flemingfabtex.com?subject=Bulk%20order%20help">Email the team</a>
            </div>
        </div>
    </div>
</section>
@endsection
