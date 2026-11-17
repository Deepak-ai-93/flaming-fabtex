@extends('layouts.app')

@section('title', $product['name'] . ' | Fleming Fabtex')

@section('content')
@php
    $basePrice = (int) $product['price'];
    $quoteMessage = "Hi Fleming Fabtex, I'd like a bulk quote for {$product['name']}.";
    $quoteUrl = 'https://wa.me/917990718742?text=' . rawurlencode($quoteMessage);
    $priceTiers = [
        ['min' => 25, 'range' => '25–99 pcs', 'label' => 'Minimum order'],
        ['min' => 100, 'range' => '100–299 pcs', 'label' => 'Volume quote'],
        ['min' => 300, 'range' => '300–999 pcs', 'label' => 'Volume quote'],
        ['min' => 1000, 'range' => '1000+ pcs', 'label' => 'Volume quote'],
    ];
    $isPromotionalTShirt = $product['slug'] === 'promotional-t-shirts';
    $totalStock = (int) ($product['stock'] ?? 0);
    $stockState = $totalStock <= 0 ? 'out' : ($totalStock < 100 ? 'low' : 'in');
    $stockLabel = $stockState === 'out' ? 'Made to order' : ($stockState === 'low' ? 'Low stock' : 'In stock');
@endphp

<article class="pd-clean-layout"
    data-product-page
    data-product-slug="{{ $product['slug'] }}"
    data-product-name="{{ $product['name'] }}"
    data-product-category="{{ $product['category'] }}"
    data-base-price="{{ $basePrice }}"
    data-min-quantity="25"
    data-quote-url="{{ $quoteUrl }}">
    <div class="pd-breadcrumb">
        <nav aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span aria-hidden="true"> / </span>
            <a href="{{ route('shop.index') }}">Catalog</a>
            <span aria-hidden="true"> / </span>
            <span aria-current="page">{{ $product['name'] }}</span>
        </nav>
    </div>

    <div class="pd-grid">
        <div class="pd-gallery-wrap">
            <div class="pd-gallery">
                <div class="pd-thumbs" id="pd-gallery-thumbs" aria-label="Product photos">
                    @foreach($productGallery as $index => $image)
                        <button
                            type="button"
                            class="pd-thumb-btn {{ $loop->first ? 'active' : '' }}"
                            data-gallery-src="{{ asset('assets/img/' . $image['image']) }}"
                            aria-label="View photo {{ $index + 1 }}"
                            aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                            <img src="{{ asset('assets/img/' . $image['thumbnail']) }}" alt="" width="76" height="76">
                        </button>
                    @endforeach
                </div>

                <div class="pd-main-view">
                    <span class="pd-tag-in">Bulk order · MOQ 25 pcs</span>
                    <img
                        id="pd-main-img"
                        src="{{ asset('assets/img/' . $productGallery[0]['image']) }}"
                        alt="{{ $product['name'] }}"
                        width="688"
                        height="606"
                        fetchpriority="high">
                </div>
            </div>

            <div class="pd-trust-row">
                <div class="pd-trust-item"><span class="pd-icon-check" aria-hidden="true">✓</span> Ahmedabad-based apparel manufacturer</div>
                <div class="pd-trust-item"><span class="pd-icon-check" aria-hidden="true">✓</span> Custom branding options confirmed by style</div>
                <div class="pd-trust-item"><span class="pd-icon-check" aria-hidden="true">✓</span> Mix sizes and colors in bulk orders</div>
                <div class="pd-trust-item"><span class="pd-icon-check" aria-hidden="true">✓</span> Availability and lead time confirmed in quote</div>
            </div>
        </div>

        <div class="pd-info-wrap">
            <div class="pd-eyebrow">
                <span class="cap-dot" aria-hidden="true"></span>
                <span>{{ $isPromotionalTShirt ? 'Factory Direct · 180 GSM · ' : 'Factory Direct · ' }}{{ $product['category'] }}</span>
            </div>

            <h1 class="pd-title">{{ $product['name'] }}</h1>
            <p class="pd-description">
                @if($isPromotionalTShirt)
                    High-visibility promotional T-shirts for launches, trade shows and giveaways. Print-ready, MOQ 25 pcs; availability confirmed in your quote.
                @else
                    Factory-direct apparel for corporate, promotional and institutional bulk orders. Available with custom branding.
                @endif
            </p>

            <div class="pd-price-box">
                <div class="pd-price-row">
                    <span class="pd-price">₹{{ number_format($basePrice) }}</span>
                    <span class="pd-per">/piece · indicative</span>
                </div>
                <div class="pd-price-sub">Indicative catalog estimate · final price, taxes and customization confirmed in your written quote · MOQ: <b>25 pieces</b></div>
            </div>

            <div class="pd-slabs">
                <div class="pd-slabs-title">Choose a quantity range · final volume pricing is confirmed in your written quote</div>
                <div class="pd-slabs-list">
                    @foreach($priceTiers as $tier)
                        <button
                            type="button"
                            class="pd-slab-item {{ $loop->first ? 'active' : '' }}"
                            data-min-qty="{{ $tier['min'] }}"
                            data-unit-price="{{ $basePrice }}"
                            aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                            <span class="slab-q">{{ $tier['range'] }}</span>
                            <span class="slab-p">Set quantity</span>
                            <span class="slab-tag">{{ $tier['label'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="pd-option-row">
                <div class="pd-option-label">
                    <span>Available factory colors</span>
                    <b id="pd-active-color">Navy Blue</b>
                </div>
                <div class="pd-swatches" role="group" aria-label="Choose a color">
                    @foreach([
                        ['name' => 'Navy Blue', 'color' => '#172554'],
                        ['name' => 'Jet Black', 'color' => '#111827'],
                        ['name' => 'Pure White', 'color' => '#ffffff'],
                        ['name' => 'Royal Blue', 'color' => '#2563eb'],
                        ['name' => 'Crimson Red', 'color' => '#dc2626'],
                        ['name' => 'Heather Grey', 'color' => '#9ca3af'],
                        ['name' => 'Military Olive', 'color' => '#556b2f'],
                        ['name' => 'Deep Maroon', 'color' => '#7f1d1d'],
                    ] as $color)
                        <button
                            type="button"
                            class="pd-swatch {{ $loop->first ? 'selected' : '' }}"
                            style="background-color: {{ $color['color'] }};"
                            data-color="{{ $color['name'] }}"
                            title="{{ $color['name'] }}"
                            aria-label="{{ $color['name'] }}"
                            aria-pressed="{{ $loop->first ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
            </div>

            <div class="pd-option-row">
                <div class="pd-option-label">
                    <span>Select size: <b id="pd-active-size">L</b></span>
                    <button type="button" class="pd-size-guide-modal-btn" id="pd-open-size-modal" data-open-size-chart>
                        View detailed size chart
                    </button>
                </div>
                <div class="pd-sizes" role="group" aria-label="Choose a size">
                    @foreach(['S', 'M', 'L', 'XL', 'XXL', '3XL'] as $size)
                        <button
                            type="button"
                            class="pd-size-btn {{ $size === 'L' ? 'selected' : '' }}"
                            data-size="{{ $size }}"
                            aria-pressed="{{ $size === 'L' ? 'true' : 'false' }}">{{ $size }}</button>
                    @endforeach
                </div>
            </div>

            <div class="pd-action-box" id="pd-action-box">
                <div class="pd-qty-row">
                    <label for="pd-order-qty" class="pd-qty-lbl">Order quantity (pcs)</label>
                    <div class="pd-qty-stepper">
                        <button type="button" class="qty-btn" id="pd-qty-minus" aria-label="Decrease quantity">−</button>
                        <input
                            type="number"
                            id="pd-order-qty"
                            class="pd-qty-input"
                            value="25"
                            min="25"
                            step="25"
                            inputmode="numeric"
                            aria-describedby="pd-qty-hint"
                            aria-invalid="false">
                        <button type="button" class="qty-btn" id="pd-qty-plus" aria-label="Increase quantity">+</button>
                    </div>
                    <div class="pd-total-est">Estimated total: <b id="pd-est-total">₹{{ number_format($basePrice * 25) }}</b></div>
                    <span id="pd-qty-hint" class="sr-only">Minimum order is 25 pieces, in increments of 25.</span>
                </div>

                <div class="pd-avail-stock pd-avail-stock--{{ $stockState }}">
                    <span class="pd-dot" aria-hidden="true"></span>
                    <span>{{ $stockLabel }} · <b>{{ number_format($totalStock) }} pcs</b> at the factory</span>
                    <em>Total across sizes and colors · final allocation confirmed in your quote.</em>
                </div>

                <div class="pd-btn-group">
                    <a class="btn btn-p btn-lg pd-main-cta product-whatsapp-link" href="{{ $quoteUrl }}" target="_blank" rel="noopener noreferrer">
                        Request a Bulk Quote <span aria-hidden="true">→</span>
                    </a>
                    <button type="button" class="pd-quote-btn" data-add-to-quote>
                        Add to quote list
                    </button>
                    <a class="btn btn-o btn-lg pd-sec-cta" href="tel:+917990718742">Call the factory</a>
                </div>
            </div>

            <div class="pd-delivery-check">
                <div class="pd-pin-input-wrap">
                    <span class="pin-icon" aria-hidden="true">⌖</span>
                    <input type="text" id="pd-pincode" placeholder="Enter 6-digit delivery PIN" maxlength="6" inputmode="numeric" pattern="[0-9]{6}" aria-label="Delivery PIN code">
                    <button type="button" class="btn btn-dark btn-sm" id="pd-check-pin-btn">Include PIN</button>
                </div>
                <div id="pd-pin-res" class="pd-pin-res" role="status" aria-live="polite">
                    Add your PIN to the WhatsApp quote so the team can confirm delivery availability.
                </div>
            </div>
        </div>
    </div>

    <section class="pd-details-section" id="product-details" aria-label="Product details">
        <div class="pd-tabs-nav" role="tablist" aria-label="Product information">
            <button type="button" class="pd-tab-btn active" id="tab-specs-button" role="tab" aria-selected="true" aria-controls="tab-specs" data-tab="tab-specs">Technical specifications</button>
            <button type="button" class="pd-tab-btn" id="tab-size-chart-button" role="tab" aria-selected="false" aria-controls="tab-size-chart" data-tab="tab-size-chart">Size chart &amp; fit guide</button>
            <button type="button" class="pd-tab-btn" id="tab-printing-button" role="tab" aria-selected="false" aria-controls="tab-printing" data-tab="tab-printing">Custom printing &amp; embroidery</button>
            <button type="button" class="pd-tab-btn" id="tab-bulk-faq-button" role="tab" aria-selected="false" aria-controls="tab-bulk-faq" data-tab="tab-bulk-faq">Bulk ordering FAQ</button>
        </div>

        <div id="tab-specs" class="pd-tab-pane active" role="tabpanel" aria-labelledby="tab-specs-button" aria-hidden="false">
            <div class="pd-details-card">
                <h2 class="pd-sec-title">Fabric &amp; manufacturing specifications</h2>
                <div class="pd-specs-grid">
                    @if($isPromotionalTShirt)
                        <div class="pd-spec-item"><span class="k">Fabric material</span><span class="v">100% super-combed, bio-washed cotton</span></div>
                        <div class="pd-spec-item"><span class="k">Fabric weight</span><span class="v">180 GSM heavyweight fabric</span></div>
                        <div class="pd-spec-item"><span class="k">Fit</span><span class="v">Regular comfort fit with ribbed collar</span></div>
                        <div class="pd-spec-item"><span class="k">Printing</span><span class="v">Screen, DTF, puff print and embroidery</span></div>
                        <div class="pd-spec-item"><span class="k">Shrinkage control</span><span class="v">Pre-shrunk; shrinkage under 2.5%</span></div>
                        <div class="pd-spec-item"><span class="k">Color fastness</span><span class="v">Grade 4+ reactive dyed</span></div>
                    @else
                        <div class="pd-spec-item"><span class="k">Product</span><span class="v">{{ $product['name'] }}</span></div>
                        <div class="pd-spec-item"><span class="k">Category</span><span class="v">{{ $product['category'] }}</span></div>
                        <div class="pd-spec-item"><span class="k">Minimum order</span><span class="v">25 pieces</span></div>
                        <div class="pd-spec-item"><span class="k">Customization</span><span class="v">Printing and branding options available</span></div>
                    @endif
                    <div class="pd-spec-item"><span class="k">Manufacturing facility</span><span class="v">Khokhra, Ahmedabad, Gujarat</span></div>
                    <div class="pd-spec-item"><span class="k">Invoicing</span><span class="v">GST invoice available</span></div>
                </div>
            </div>
        </div>

        <div id="tab-size-chart" class="pd-tab-pane" role="tabpanel" aria-labelledby="tab-size-chart-button" aria-hidden="true">
            <div class="pd-size-guide-card">
                @if($isPromotionalTShirt)
                    <div class="pd-size-card-header">
                        <div>
                            <h2 class="pd-sec-title">Standard Indian / global apparel size chart</h2>
                            <p class="pd-sec-sub">Garment laid flat; manufacturing tolerance is approximately ±0.5 inch.</p>
                        </div>
                        <div class="pd-unit-toggle" aria-label="Measurement units">
                            <button type="button" class="unit-btn active" data-unit="in" aria-pressed="true">Inches</button>
                            <button type="button" class="unit-btn" data-unit="cm" aria-pressed="false">Centimeters</button>
                        </div>
                    </div>
                    <div class="pd-table-wrap">
                        <table class="pd-size-table" id="pd-main-size-table">
                            <thead><tr><th>Size</th><th>Chest</th><th>Length</th><th>Shoulder</th><th>Sleeve</th><th>Body chest</th></tr></thead>
                            <tbody>
                                <tr data-size="S"><td><span class="size-badge">S</span></td><td class="cell-val" data-in="38 in" data-cm="96.5 cm">38 in</td><td class="cell-val" data-in="26.5 in" data-cm="67.3 cm">26.5 in</td><td class="cell-val" data-in="16.5 in" data-cm="41.9 cm">16.5 in</td><td class="cell-val" data-in="8 in" data-cm="20.3 cm">8 in</td><td class="cell-val" data-in="36–38 in" data-cm="91.4–96.5 cm">36–38 in</td></tr>
                                <tr data-size="M"><td><span class="size-badge">M</span></td><td class="cell-val" data-in="40 in" data-cm="101.6 cm">40 in</td><td class="cell-val" data-in="27.5 in" data-cm="69.8 cm">27.5 in</td><td class="cell-val" data-in="17.5 in" data-cm="44.5 cm">17.5 in</td><td class="cell-val" data-in="8.5 in" data-cm="21.6 cm">8.5 in</td><td class="cell-val" data-in="38–40 in" data-cm="96.5–101.6 cm">38–40 in</td></tr>
                                <tr data-size="L"><td><span class="size-badge">L</span></td><td class="cell-val" data-in="42 in" data-cm="106.7 cm">42 in</td><td class="cell-val" data-in="28.5 in" data-cm="72.4 cm">28.5 in</td><td class="cell-val" data-in="18.5 in" data-cm="47 cm">18.5 in</td><td class="cell-val" data-in="9 in" data-cm="22.9 cm">9 in</td><td class="cell-val" data-in="40–42 in" data-cm="101.6–106.7 cm">40–42 in</td></tr>
                                <tr data-size="XL"><td><span class="size-badge">XL</span></td><td class="cell-val" data-in="44 in" data-cm="111.8 cm">44 in</td><td class="cell-val" data-in="29.5 in" data-cm="74.9 cm">29.5 in</td><td class="cell-val" data-in="19.5 in" data-cm="49.5 cm">19.5 in</td><td class="cell-val" data-in="9.5 in" data-cm="24.1 cm">9.5 in</td><td class="cell-val" data-in="42–44 in" data-cm="106.7–111.8 cm">42–44 in</td></tr>
                                <tr data-size="XXL"><td><span class="size-badge">XXL</span></td><td class="cell-val" data-in="46 in" data-cm="116.8 cm">46 in</td><td class="cell-val" data-in="30.5 in" data-cm="77.5 cm">30.5 in</td><td class="cell-val" data-in="20.5 in" data-cm="52.1 cm">20.5 in</td><td class="cell-val" data-in="10 in" data-cm="25.4 cm">10 in</td><td class="cell-val" data-in="44–46 in" data-cm="111.8–116.8 cm">44–46 in</td></tr>
                                <tr data-size="3XL"><td><span class="size-badge">3XL</span></td><td class="cell-val" data-in="48 in" data-cm="121.9 cm">48 in</td><td class="cell-val" data-in="31.5 in" data-cm="80 cm">31.5 in</td><td class="cell-val" data-in="21.5 in" data-cm="54.6 cm">21.5 in</td><td class="cell-val" data-in="10.5 in" data-cm="26.7 cm">10.5 in</td><td class="cell-val" data-in="46–48 in" data-cm="116.8–121.9 cm">46–48 in</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pd-size-fit-tips">
                        <div class="fit-tip-item"><b>Chest:</b> Measure a well-fitting T-shirt flat from armpit to armpit, then double the result.</div>
                        <div class="fit-tip-item"><b>Length:</b> Measure from the highest shoulder seam to the bottom hem.</div>
                    </div>
                @else
                    <h2 class="pd-sec-title">Confirm your fit before ordering</h2>
                    <p class="pd-sec-sub">Available size ranges and garment measurements vary by style. Share your size mix with our team to confirm the right fit for this product.</p>
                    <a class="btn btn-o" href="tel:+917990718742">Call for the product size chart</a>
                @endif
            </div>
        </div>

        <div id="tab-printing" class="pd-tab-pane" role="tabpanel" aria-labelledby="tab-printing-button" aria-hidden="true">
            <div class="pd-details-card">
                <h2 class="pd-sec-title">In-house customization &amp; printing</h2>
                <div class="pd-specs-grid">
                    <div class="pd-spec-item"><span class="k">Screen printing</span><span class="v">Vibrant, durable multi-color artwork</span></div>
                    <div class="pd-spec-item"><span class="k">Direct to film (DTF)</span><span class="v">Full-color graphics and detailed designs</span></div>
                    <div class="pd-spec-item"><span class="k">Puff printing</span><span class="v">Raised, tactile print finish</span></div>
                    <div class="pd-spec-item"><span class="k">Embroidery</span><span class="v">Logos, crests and monograms</span></div>
                    <div class="pd-spec-item"><span class="k">Custom labels</span><span class="v">Woven labels and branded tags</span></div>
                    <div class="pd-spec-item"><span class="k">Packing</span><span class="v">Individual packing options available</span></div>
                </div>
            </div>
        </div>

        <div id="tab-bulk-faq" class="pd-tab-pane" role="tabpanel" aria-labelledby="tab-bulk-faq-button" aria-hidden="true">
            <div class="pd-details-card">
                <h2 class="pd-sec-title">Frequently asked questions for bulk buyers</h2>
                <div class="pd-faq-list">
                    <div class="pd-faq-item">
                        <h3 class="pd-faq-q">What is the minimum order quantity?</h3>
                        <p class="pd-faq-a">The minimum order is 25 pieces. Sizes and colors can be mixed; share your selection when requesting a quote.</p>
                    </div>
                    <div class="pd-faq-item">
                        <h3 class="pd-faq-q">Can I request a sample first?</h3>
                        <p class="pd-faq-a">Ask our team about fabric samples and availability for your product and order quantity.</p>
                    </div>
                    <div class="pd-faq-item">
                        <h3 class="pd-faq-q">How does volume pricing work?</h3>
                        <p class="pd-faq-a">Choose a quantity range above to update the indicative estimate. Your confirmed volume price depends on the style, size mix and customization and is provided in the written quote.</p>
                    </div>
                    <div class="pd-faq-item">
                        <h3 class="pd-faq-q">How do I confirm delivery timing?</h3>
                        <p class="pd-faq-a">Delivery times depend on stock, order size and branding. Include your PIN code and required date in the quote request.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="pd-related-wrap">
        <section class="related products" aria-labelledby="related-products-heading">
            <h2 id="related-products-heading">Related products</h2>
            <ul class="products columns-4">
                @foreach($relatedProducts as $relatedProduct)
                    @include('partials.product-card', ['product' => $relatedProduct])
                @endforeach
            </ul>
        </section>
    </div>
</article>

<div class="pd-sticky-bar" id="pd-sticky-bar" aria-hidden="true" inert>
    <img class="pd-sticky-thumb" src="{{ asset('assets/img/' . $productGallery[0]['image']) }}" alt="" aria-hidden="true">
    <div class="pd-sticky-info">
        <b class="pd-sticky-price"><span id="pd-sticky-price">₹{{ number_format($basePrice) }}</span> <em>/piece</em></b>
        <span class="pd-sticky-sub">Indicative · MOQ 25 pcs</span>
    </div>
    <a class="btn btn-o product-whatsapp-link" href="{{ $quoteUrl }}" target="_blank" rel="noopener noreferrer">Quote</a>
    <a class="btn btn-p" href="tel:+917990718742">Call</a>
</div>

<div class="pd-stock-fab" id="pd-stock-fab" data-stock-state="{{ $stockState }}" data-total-stock="{{ $totalStock }}">
    <div class="pd-stock-panel" id="pd-stock-panel" role="dialog" aria-label="Total stock available" hidden>
        <div class="pd-stock-panel-head">
            <span class="pd-stock-panel-title">Total factory stock</span>
            <button type="button" class="pd-stock-panel-close" id="pd-stock-close" aria-label="Close stock details">&times;</button>
        </div>
        <div class="pd-stock-panel-total">
            <b>{{ number_format($totalStock) }}</b>
            <span>pieces available</span>
        </div>
        <ul class="pd-stock-panel-facts">
            <li><span>Product</span><b>{{ $product['name'] }}</b></li>
            <li><span>Minimum order</span><b>25 pcs</b></li>
            <li><span>Stock status</span><b class="pd-stock-state pd-stock-state--{{ $stockState }}">{{ $stockLabel }}</b></li>
        </ul>
        <p class="pd-stock-panel-note">Quantity across all sizes and colors. Exact allocation is confirmed in your written quote.</p>
        <a class="btn btn-p pd-stock-panel-cta product-whatsapp-link" href="{{ $quoteUrl }}" target="_blank" rel="noopener noreferrer">Check stock on WhatsApp <span aria-hidden="true">&rarr;</span></a>
    </div>
    <button type="button" class="pd-stock-fab-btn" id="pd-stock-toggle" aria-expanded="false" aria-controls="pd-stock-panel">
        <span class="pd-stock-fab-ico" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l9-4 9 4-9 4-9-4z"></path><path d="M3 7v10l9 4 9-4V7"></path><path d="M12 11v10"></path></svg>
        </span>
        <span class="pd-stock-fab-text">
            <span class="pd-stock-fab-label">{{ $stockLabel }}</span>
            <b class="pd-stock-fab-count">{{ number_format($totalStock) }} pcs</b>
        </span>
    </button>
</div>
@endsection
