<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_catalog_search_finds_matching_products_and_polo_aliases(): void
    {
        $this->get('/shop?s=hoodie')
            ->assertOk()
            ->assertSeeText('Sweatshirt/Jackets/Hoodies')
            ->assertSee('href="' . url('/product/sweatshirt-jackets-hoodies') . '"', false)
            ->assertDontSee('href="' . url('/product/corporate-wear') . '"', false);

        $this->get('/shop?s=polo')
            ->assertOk()
            ->assertSee('href="' . url('/product/corporate-wear') . '"', false);
    }

    public function test_catalog_search_ignores_non_string_query_values(): void
    {
        $this->get('/shop?s%5B%5D=hoodie')
            ->assertOk()
            ->assertSee('href="' . url('/product/corporate-wear') . '"', false);
    }

    public function test_assets_use_https_when_request_is_forwarded_over_https(): void
    {
        $this->withServerVariables([
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ])->get('/')
            ->assertOk()
            ->assertSee('href="https://localhost:8000/assets/css/tokens.css"', false)
            ->assertSee('src="https://localhost:8000/assets/js/vendor/gsap.min.js"', false);
    }
}
