@extends('layouts.app')

@section('title', 'Choose a New Password | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">Choose a new password</h1>
                <p class="sec-desc">Set a new password for your Fleming Fabtex account.</p>
            </div>
        </div>

        <div class="co-section account-login">
            @if ($errors->any())
                <div class="fq-msg err" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}" class="fq-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="fq-field fq-full">
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $email ?? request('email')) }}" autocomplete="username" required autofocus>
                </div>
                <div class="fq-field fq-full">
                    <label for="password">New password</label>
                    <input id="password" type="password" name="password" autocomplete="new-password" required>
                </div>
                <div class="fq-field fq-full">
                    <label for="password-confirm">Confirm new password</label>
                    <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password" required>
                </div>
                <button class="btn btn-p fq-submit fq-full" type="submit">Reset password <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </div>
</section>
@endsection
