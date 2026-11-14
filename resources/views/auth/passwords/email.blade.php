@extends('layouts.app')

@section('title', 'Reset Password | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">Reset your password</h1>
                <p class="sec-desc">Enter the email address associated with your account.</p>
            </div>
        </div>

        <div class="co-section account-login">
            @if (session('status'))
                <p class="fq-msg ok" role="status">{{ session('status') }}</p>
            @endif
            @if ($errors->any())
                <div class="fq-msg err" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="fq-form">
                @csrf
                <div class="fq-field fq-full">
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
                </div>
                <button class="btn btn-p fq-submit fq-full" type="submit">Send password reset link <span aria-hidden="true">→</span></button>
                <a class="account-forgot fq-full" href="{{ route('login') }}">Return to sign in</a>
            </form>
        </div>
    </div>
</section>
@endsection
