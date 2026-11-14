@extends('layouts.app')

@section('title', $post['title'] . ' | Fleming Fabtex')

@section('content')
<section class="section fleming-blog-page">
    <div class="wrap">
        <nav class="blog-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span><a href="{{ route('blog.index') }}">Journal</a><span aria-hidden="true">/</span><span>{{ $post['category'] }}</span>
        </nav>

        <article class="blog-article">
            <header class="blog-article-header">
                <span class="sec-eyebrow">{{ $post['category'] }} · {{ $post['readTime'] }}</span>
                <h1>{{ $post['title'] }}</h1>
                <p>{{ $post['excerpt'] }}</p>
            </header>
            <div class="blog-article-image">
                <img src="{{ asset('assets/img/' . $post['image']) }}" alt="" fetchpriority="high">
            </div>
            <div class="blog-article-body">
                @foreach ($post['sections'] as $section)
                    <section>
                        <h2>{{ $section['heading'] }}</h2>
                        @foreach ($section['paragraphs'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </section>
                @endforeach
                <div class="blog-article-cta">
                    <h2>Need help planning your order?</h2>
                    <p>Send your product and quantity requirements to the Fleming Fabtex team.</p>
                    <a class="btn btn-p" href="{{ route('quote.index') }}">Build a quote request <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </article>

        <section class="blog-related" aria-labelledby="related-guides-title">
            <div class="sec-head">
                <div>
                    <span class="sec-eyebrow">KEEP EXPLORING</span>
                    <h2 class="sec-title" id="related-guides-title">More buying guides</h2>
                </div>
                <a class="btn btn-o" href="{{ route('blog.index') }}">All articles <span aria-hidden="true">→</span></a>
            </div>
            <div class="blog-related-grid">
                @foreach (array_slice($relatedPosts, 0, 2) as $relatedPost)
                    <a class="blog-related-card" href="{{ route('blog.show', ['slug' => $relatedPost['slug']]) }}">
                        <img src="{{ asset('assets/img/' . $relatedPost['image']) }}" alt="" loading="lazy">
                        <span><b>{{ $relatedPost['category'] }}</b><strong>{{ $relatedPost['title'] }}</strong></span>
                        <span class="blog-read-more" aria-hidden="true">Read guide →</span>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
</section>
@endsection
