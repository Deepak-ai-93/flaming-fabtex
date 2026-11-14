@extends('layouts.app')

@section('title', 'Sign In | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">Welcome back</h1>
                <p class="sec-desc">Sign in to access your account details.</p>
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

            <form method="POST" action="{{ route('login') }}" class="fq-form">
                @csrf
                <div class="fq-field fq-full">
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
                </div>
                <div class="fq-field fq-full">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required>
                </div>
                <label class="account-remember fq-full">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>
                <button class="btn btn-p fq-submit fq-full" type="submit">Sign in <span aria-hidden="true">→</span></button>
                <a class="account-forgot fq-full" href="{{ route('password.request') }}">Forgot your password?</a>
            </form>
        </div>
    </div>
</section>
@endsection
