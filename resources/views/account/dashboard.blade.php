@extends('layouts.app')

@section('title', 'My Account | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">My account</h1>
                <p class="sec-desc">Manage your sign-in details and get help with a bulk enquiry.</p>
            </div>
        </div>

        @guest
            <div class="account-welcome co-section">
                <span class="co-num" aria-hidden="true">01</span>
                <div>
                    <h2>Sign in to your account</h2>
                    <p>Sign in to view your account profile. Online orders and order history are not currently available on this site.</p>
                    <div class="account-actions">
                        <a class="btn btn-p" href="{{ route('login') }}">Sign in <span aria-hidden="true">→</span></a>
                        <a class="btn btn-o" href="{{ route('quote.index') }}">Start a bulk quote <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        @else
            <div class="account-welcome co-section">
                <span class="co-num" aria-hidden="true">✓</span>
                <div>
                    <h2>Welcome, {{ auth()->user()->name }}</h2>
                    <p>You’re signed in as <strong>{{ auth()->user()->email }}</strong>.</p>
                    <div class="account-actions">
                        <a class="btn btn-o" href="{{ route('account.profile') }}">View profile <span aria-hidden="true">→</span></a>
                        <a class="btn btn-o" href="{{ route('account.orders') }}">Order information <span aria-hidden="true">→</span></a>
                        <a class="btn btn-p" href="{{ route('quote.index') }}">Request a bulk quote <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        @endguest

        <div class="account-feature-grid">
            <a class="account-feature co-section" href="{{ route('account.profile') }}">
                <span class="account-feature-icon" aria-hidden="true">01</span>
                <h2>Profile</h2>
                <p>Review the account details associated with your sign-in.</p>
                <span class="account-feature-link">View account <span aria-hidden="true">→</span></span>
            </a>
            <a class="account-feature co-section" href="{{ route('account.orders') }}">
                <span class="account-feature-icon" aria-hidden="true">02</span>
                <h2>Order information</h2>
                <p>Online order tracking is not available. Contact us for help with a confirmed order.</p>
                <span class="account-feature-link">Get order help <span aria-hidden="true">→</span></span>
            </a>
            <a class="account-feature co-section" href="{{ route('cart.index') }}">
                <span class="account-feature-icon" aria-hidden="true">03</span>
                <h2>Quote list</h2>
                <p>Build a local list of styles and quantities before asking for pricing.</p>
                <span class="account-feature-link">Open quote list <span aria-hidden="true">→</span></span>
            </a>
        </div>
    </div>
</section>
@endsection
