@extends('layouts.app')

@section('title', 'Wholesale Apparel Catalog | Fleming Fabtex')

@section('content')
<section class="section">
    <div class="wrap">
        <div class="sec-head">
            <div>
                <span class="eyebrow"><span class="cap-dot"></span> Factory Direct · MOQ 25 pcs</span>
                <h1>Wholesale Apparel Catalog</h1>
            </div>
            <a class="link-more" href="{{ route('quote.index') }}">Need a custom order? Request a quote <span aria-hidden="true">→</span></a>
        </div>

        <form class="mb-6 flex flex-col gap-3 sm:flex-row" method="get" action="{{ route('shop.index') }}" role="search">
            <label class="sr-only" for="catalog-search">Search products</label>
            <input id="catalog-search" class="min-w-0 flex-1" type="search" name="s" value="{{ $search }}" placeholder="Search T-shirts, polos, hoodies...">
            <button class="btn btn-p" type="submit">Search catalog</button>
        </form>
        <p class="catalog-price-note">Catalog prices are indicative. Availability, customization, taxes and delivery are confirmed in your written quote.</p>

        @if (count($products))
            <ul class="p-grid">
                @foreach ($products as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </ul>
        @else
            <div class="rounded-2xl bg-white p-8 text-center shadow-sm">
                <h2 class="mb-2 text-xl font-bold">No matching products</h2>
                <p class="mb-5 text-slate-600">Try another search, or tell us what you need and we’ll help with a bulk quote.</p>
                <a class="btn btn-p" href="{{ route('quote.index') }}">Request a Quote <span aria-hidden="true">→</span></a>
            </div>
        @endif
    </div>
</section>
@endsection
