@extends('layouts.app')

@section('title', 'Confirm Password | Fleming Fabtex')

@section('content')
<section class="section fleming-account-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">CUSTOMER ACCOUNT</span>
                <h1 class="sec-title">Confirm your password</h1>
                <p class="sec-desc">For your security, please confirm your password to continue.</p>
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
            <form method="POST" action="{{ route('password.confirm') }}" class="fq-form">
                @csrf
                <div class="fq-field fq-full">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required autofocus>
                </div>
                <button class="btn btn-p fq-submit fq-full" type="submit">Confirm password <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </div>
</section>
@endsection
