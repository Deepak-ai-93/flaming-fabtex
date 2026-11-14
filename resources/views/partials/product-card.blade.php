<li class="p-card product">
    <a href="{{ route('product.show', ['slug' => $product['slug']]) }}" class="p-media">
        <span class="p-tag order">Bulk order</span>
        <img src="{{ asset('assets/img/' . $product['image']) }}" alt="{{ $product['name'] }}" width="300" height="300" loading="lazy">
    </a>
    <div class="p-body">
        <div class="p-cat">{{ $product['category'] }}</div>
        <h3 class="p-name">
            <a href="{{ route('product.show', ['slug' => $product['slug']]) }}">{{ $product['name'] }}</a>
        </h3>
        <div class="p-price">
            <span class="now">₹{{ $product['price'] }}</span>
            <span class="per">/piece</span>
        </div>
        <div class="p-meta">
            <span>Availability confirmed by quote</span>
            <span>MOQ 25</span>
        </div>
    </div>
    <div class="p-actions">
        <a href="{{ route('product.show', ['slug' => $product['slug']]) }}" class="btn btn-p">View &amp; Configure <span aria-hidden="true">→</span></a>
        <button
            type="button"
            class="btn btn-o btn-sm"
            data-add-to-quote
            data-product-slug="{{ $product['slug'] }}"
            data-product-name="{{ $product['name'] }}"
            data-product-category="{{ $product['category'] }}"
            data-product-image="{{ asset('assets/img/' . $product['image']) }}"
            data-product-price="{{ $product['price'] }}"
            aria-label="Add {{ $product['name'] }} to your quote list">
            Add to quote list
        </button>
    </div>
</li>
