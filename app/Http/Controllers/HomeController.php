<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private const FEATURED_PRODUCTS = [
        [
            'slug' => 'corporate-wear',
            'name' => 'Corporate Wear',
            'category' => 'COLLAR T-SHIRT',
            'image' => '22-300x300.jpg',
            'price' => '399',
        ],
        [
            'slug' => 'promotional-t-shirts',
            'name' => 'Promotional T-Shirts',
            'category' => 'COLLAR T-SHIRT, V SHAPE T-SHIRTS',
            'image' => '18-300x300.jpg',
            'price' => '149',
        ],
        [
            'slug' => 'election-event-t-shirts',
            'name' => 'Election/Event T-Shirts',
            'category' => 'COLLAR T-SHIRT, V SHAPE T-SHIRTS',
            'image' => 'image-10-1-300x300.png',
            'price' => '119',
        ],
        [
            'slug' => 'customized-t-shirts',
            'name' => 'Customized T-Shirts',
            'category' => 'COLLAR T-SHIRT, V SHAPE T-SHIRTS',
            'image' => '16-300x300.jpg',
            'price' => '279',
        ],
        [
            'slug' => 'sweatshirt-jackets-hoodies',
            'name' => 'Sweatshirt/Jackets/Hoodies',
            'category' => 'ALL, HOODIES, JACKETS, SWEATSHIRT',
            'image' => 'Untitled-design-88-300x300.jpg',
            'price' => '699',
        ],
        [
            'slug' => 'solid-plain-t-shirts',
            'name' => 'Solid Plain T-Shirts',
            'category' => 'COLLAR T-SHIRT, V SHAPE T-SHIRTS',
            'image' => 'image-10NH-300x300.png',
            'price' => '249',
        ],
        [
            'slug' => 'school-institute-uniform',
            'name' => 'School/Institute Uniform',
            'category' => 'COLLAR T-SHIRT, V SHAPE T-SHIRTS',
            'image' => '20-300x300.jpg',
            'price' => '299',
        ],
        [
            'slug' => 'customized-event-t-shirt-full-print',
            'name' => 'Customized Event T-Shirt — Full Print',
            'category' => 'CUSTOMIZED T-SHIRTS',
            'image' => 'image-10-1-300x300.png',
            'price' => '319',
        ],
    ];

    private const BLOG_POSTS = [
        [
            'slug' => 'choosing-the-right-t-shirt-weight',
            'category' => 'BUYING GUIDE',
            'title' => 'Choosing the right T-shirt weight for a bulk order',
            'excerpt' => 'A practical way to compare fabric weight, comfort and use before placing a large apparel order.',
            'image' => '18-300x300.jpg',
            'readTime' => '4 min read',
            'sections' => [
                [
                    'heading' => 'Start with how the garment will be used',
                    'paragraphs' => [
                        'Lightweight fabrics can be comfortable for warm weather, events and frequent movement. A heavier fabric can feel more substantial and may suit uniforms or daily wear.',
                        'The right choice depends on the garment, the climate and how it will be cared for. If a sample is available for the style, review it when hand-feel matters to your team.',
                    ],
                ],
                [
                    'heading' => 'Compare samples, not only numbers',
                    'paragraphs' => [
                        'GSM is a useful weight reference, but it does not describe the whole fabric. Knit, yarn, finishing and fit all affect the final feel.',
                        'Compare the same garment after washing and check that the size range, color and print finish match your requirements.',
                    ],
                ],
                [
                    'heading' => 'Plan the order details early',
                    'paragraphs' => [
                        'Before requesting a quote, prepare an approximate quantity, size split, preferred colors, artwork and required delivery date. This helps the factory recommend a suitable option and confirm availability.',
                    ],
                ],
            ],
        ],
        [
            'slug' => 'planning-custom-event-t-shirts',
            'category' => 'ORDER PLANNING',
            'title' => 'How to plan custom T-shirts for an event',
            'excerpt' => 'A simple checklist for quantities, size mixes, artwork and delivery timing.',
            'image' => 'image-10-1-300x300.png',
            'readTime' => '3 min read',
            'sections' => [
                [
                    'heading' => 'Estimate quantities with a clear size mix',
                    'paragraphs' => [
                        'Use registration, team or previous event information to estimate the size split. Keep a small buffer if your event allows on-site distribution changes.',
                        'Confirm whether each color or design is treated as a separate style when checking minimum quantities.',
                    ],
                ],
                [
                    'heading' => 'Prepare artwork for production',
                    'paragraphs' => [
                        'Share a high-resolution logo or vector artwork, the intended print location and approximate print dimensions. Mention any special colors or finishes.',
                        'Ask for a proof or sample approval before production when exact brand colors are important.',
                    ],
                ],
                [
                    'heading' => 'Allow time for approval and delivery',
                    'paragraphs' => [
                        'A useful request includes the event date, delivery PIN code and the date by which the finished garments are needed. Custom printing and shipping can affect lead time.',
                    ],
                ],
            ],
        ],
        [
            'slug' => 'screen-printing-dtf-or-embroidery',
            'category' => 'PRINTING GUIDE',
            'title' => 'Screen printing, DTF or embroidery?',
            'excerpt' => 'Understand common branding options and what to discuss with your apparel supplier.',
            'image' => '16-300x300.jpg',
            'readTime' => '4 min read',
            'sections' => [
                [
                    'heading' => 'Screen printing',
                    'paragraphs' => [
                        'Screen printing is often considered for repeat designs and larger runs. The artwork, number of colors, garment fabric and print placement help determine whether it is a good fit.',
                    ],
                ],
                [
                    'heading' => 'Direct-to-film printing',
                    'paragraphs' => [
                        'DTF can reproduce detailed, multi-color artwork. Ask how the print will feel on the selected fabric and request a sample if comfort or finish is a priority.',
                    ],
                ],
                [
                    'heading' => 'Embroidery',
                    'paragraphs' => [
                        'Embroidery gives logos a stitched finish and is commonly used for polos, uniforms and corporate apparel. Fine details may need to be simplified for clean stitching.',
                        'The best method depends on the artwork, fabric, quantity and intended use. Share those details with the factory before choosing.',
                    ],
                ],
            ],
        ],
    ];

    public function index()
    {
        return view('home', [
            'featuredProducts' => self::FEATURED_PRODUCTS,
        ]);
    }

    public function shop(Request $request, ?string $category = null)
    {
        $search = $request->query('s');
        $search = is_string($search) ? trim($search) : '';
        $products = self::FEATURED_PRODUCTS;

        if ($search !== '') {
            $products = array_values(array_filter($products, function ($product) use ($search) {
                if (stripos($product['name'] . ' ' . $product['category'], $search) !== false) {
                    return true;
                }

                return stripos($search, 'polo') !== false
                    && stripos($product['category'], 'COLLAR T-SHIRT') !== false;
            }));
        }

        return view('shop.index', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    public function product($slug)
    {
        foreach (self::FEATURED_PRODUCTS as $product) {
            if ($product['slug'] === $slug) {
                $gallery = $slug === 'promotional-t-shirts'
                    ? [
                        ['image' => '18.jpg', 'thumbnail' => '18-300x300.jpg'],
                        ['image' => '21.jpg', 'thumbnail' => '21-300x300.jpg'],
                    ]
                    : [
                        ['image' => $product['image'], 'thumbnail' => $product['image']],
                    ];

                $relatedProducts = array_values(array_filter(
                    self::FEATURED_PRODUCTS,
                    function ($relatedProduct) use ($slug) {
                        return $relatedProduct['slug'] !== $slug;
                    }
                ));

                return view('product.show', [
                    'product' => $product,
                    'productGallery' => $gallery,
                    'relatedProducts' => $relatedProducts,
                ]);
            }
        }

        abort(404);
    }

    public function cart()
    {
        return view('cart.index');
    }

    public function checkout()
    {
        return view('checkout.index');
    }

    public function account()
    {
        return view('account.dashboard');
    }

    public function orders()
    {
        if (auth()->guest()) {
            return redirect()->guest(route('login'));
        }

        return view('account.orders');
    }

    public function orderDetail($id)
    {
        if (auth()->guest()) {
            return redirect()->guest(route('login'));
        }

        abort(404);
    }

    public function profile()
    {
        if (auth()->guest()) {
            return redirect()->guest(route('login'));
        }

        return view('account.profile');
    }

    public function quote()
    {
        return view('quote.index');
    }

    public function blog()
    {
        return view('blog.index', ['posts' => self::BLOG_POSTS]);
    }

    public function blogPost($slug)
    {
        foreach (self::BLOG_POSTS as $post) {
            if ($post['slug'] === $slug) {
                return view('blog.show', [
                    'post' => $post,
                    'relatedPosts' => array_values(array_filter(
                        self::BLOG_POSTS,
                        function ($relatedPost) use ($slug) {
                            return $relatedPost['slug'] !== $slug;
                        }
                    )),
                ]);
            }
        }

        abort(404);
    }
}