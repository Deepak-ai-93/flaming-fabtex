@extends('layouts.app')

@section('title', 'Apparel Buying Guides | Fleming Fabtex')

@section('content')
<section class="section fleming-blog-page">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="sec-eyebrow">THE FABTEX JOURNAL</span>
                <h1 class="sec-title">Ideas for better bulk orders</h1>
                <p class="sec-desc">Practical notes on choosing apparel, planning quantities and preparing artwork for your next order.</p>
            </div>
            <a class="btn btn-o" href="{{ route('shop.index') }}">Browse the catalog <span aria-hidden="true">→</span></a>
        </div>

        <div class="blog-grid">
            @foreach ($posts as $post)
                <article class="blog-card">
                    <a class="blog-card-image" href="{{ route('blog.show', ['slug' => $post['slug']]) }}">
                        <img src="{{ asset('assets/img/' . $post['image']) }}" alt="" loading="lazy">
                    </a>
                    <div class="blog-card-body">
                        <div class="blog-meta"><span>{{ $post['category'] }}</span><span>{{ $post['readTime'] }}</span></div>
                        <h2><a href="{{ route('blog.show', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a></h2>
                        <p>{{ $post['excerpt'] }}</p>
                        <a class="blog-read-more" href="{{ route('blog.show', ['slug' => $post['slug']]) }}">Read article <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="blog-cta co-section">
            <div>
                <span class="sec-eyebrow">PLANNING A BULK ORDER?</span>
                <h2>Bring your brief to our team</h2>
                <p>Share your product, quantity, artwork and delivery requirements to get a tailored quote.</p>
            </div>
            <a class="btn btn-p" href="{{ route('quote.index') }}">Request a quote <span aria-hidden="true">→</span></a>
        </div>
    </div>
</section>
@endsection
