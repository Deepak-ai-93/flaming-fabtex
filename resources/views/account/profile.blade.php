@extends('layouts.app')

@section('title', 'Account Profile | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">Account profile</h1>
                <p class="sec-desc">Your sign-in details associated with this account.</p>
            </div>
            <a class="btn btn-o" href="{{ route('account.dashboard') }}">Back to account <span aria-hidden="true">→</span></a>
        </div>

        <div class="co-section account-profile">
            <div class="account-profile-row">
                <span>Name</span>
                <strong>{{ auth()->user()->name }}</strong>
            </div>
            <div class="account-profile-row">
                <span>Email</span>
                <strong>{{ auth()->user()->email }}</strong>
            </div>
            <p class="fcart-note">Profile editing and saved addresses are not available online. For help with your account, contact <a href="mailto:info@flemingfabtex.com">info@flemingfabtex.com</a>.</p>
            <div class="account-actions">
                <a class="btn btn-o" href="{{ route('password.request') }}">Reset password <span aria-hidden="true">→</span></a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-p" type="submit">Sign out</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
