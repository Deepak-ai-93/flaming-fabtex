@extends('layouts.app')

@section('content')
<div class="p-4 max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold brand-color mb-6">B2B Features</h1>

    <div class="bg-white rounded-2xl p-6 mb-8 shadow">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- MOQ Settings -->
                <div>
                    <h2 class="font-semibold mb-3">MOQ Settings</h2>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Minimum Order Quantity (Row): <strong>25 pcs</strong></li>
                        <li>Minimum Total Order: <strong>25 pcs</strong></li>
                        <li>Cart auto-bumps to MOQ: <strong>Yes</strong></li>
                        <li>Quantity step: <strong>25 pcs increments</strong></li>
                    </ul>
                </div>
                
                <!-- Stock Matrix -->
                <div>
                    <h2 class="font-semibold mb-3">Stock Matrix</h2>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Stock distributed across sizes: <strong>Even split</strong></li>
                        <li>Remainder allocated to: <strong>L, XL, M, S, XXL</strong></li>
                        <li>XS-4XL size range supported</li>
                        <li>Per-size stock visibility on product page</li>
                    </ul>
                </div>
                
                <!-- Size Chart -->
                <div>
                    <h2 class="font-semibold mb-3">Size Charts</h2>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Grid mode: <strong>Chest Width, Length, Shoulder, Sleeve</strong></li>
                        <li>S-3XL size range</li>
                        <li>Attachable to products</li>
                        <li>[fleming_size_chart] shortcode support</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Brochure -->
    <div class="bg-orange-50 rounded-2xl p-6 mb-8">
        <div class="container">
            <div class="flex items-center space-x-3">
                <div class="bg-orange-100 rounded p-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium">Brochure</h3>
                    <p class="text-sm text-gray-600">Download PDF</p>
                </div>
            </div>
            <p class="mt-3 text-sm">
                <a href="https://flemingfabtex.com/wp-content/uploads/2025/04/23-4-1.pdf" target="_blank" class="brand-color underline">https://flemingfabtex.com/wp-content/uploads/2025/04/23-4-1.pdf</a>
            </p>
        </div>
    </div>

    <!-- ERP Status -->
    <div class="bg-gray-50 rounded-2xl p-6">
        <div class="container">
            <h2 class="font-semibold mb-3">ERP Integration</h2>
            <p class="text-gray-500">
                ERP adapter: <strong>Disabled</strong> (credentials not configured)
            </p>
            <p class="text-sm text-gray-500 mt-1">
                ERP base URL and token required for stock synchronization.
                Currently falls back to database stock levels.
            </p>
            <p class="text-xs text-gray-500 mt-2">
                When configured: 120s cache TTL, graceful fallback, failure logging
            </p>
        </div>
    </div>

</div>
@endsection