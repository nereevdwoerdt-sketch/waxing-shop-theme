<?php
/**
 * Waxing Shop Theme Functions
 *
 * @package Waxing_Shop
 * @since 5.8
 */

defined('ABSPATH') || exit;

/**
 * Cloudflare Tunnel URL Replacement
 * Replaces local URLs with tunnel URL when accessed via Cloudflare
 */
function waxing_tunnel_url_filter($buffer) {
    // Check if request is coming through Cloudflare
    if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) || isset($_SERVER['HTTP_CF_RAY'])) {
        // Get the tunnel URL from referer or a custom header
        $tunnel_url = '';

        if (isset($_SERVER['HTTP_CF_VISITOR'])) {
            $visitor = json_decode($_SERVER['HTTP_CF_VISITOR'], true);
            if (isset($visitor['scheme'])) {
                $tunnel_url = $visitor['scheme'] . '://';
            }
        }

        // Try to get from referer
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'trycloudflare.com') !== false) {
            preg_match('/https?:\/\/[^\/]+/', $_SERVER['HTTP_REFERER'], $matches);
            if (!empty($matches[0])) {
                $tunnel_url = $matches[0];
            }
        }

        // Fallback: check Origin header
        if (empty($tunnel_url) && isset($_SERVER['HTTP_ORIGIN']) && strpos($_SERVER['HTTP_ORIGIN'], 'trycloudflare.com') !== false) {
            $tunnel_url = $_SERVER['HTTP_ORIGIN'];
        }

        // Replace URLs if we found a tunnel URL
        if (!empty($tunnel_url)) {
            $buffer = str_replace(
                array('http://waxing-shop.local', 'https://waxing-shop.local'),
                $tunnel_url,
                $buffer
            );
        }
    }
    return $buffer;
}

// Only enable when Cloudflare headers are present
if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) || isset($_SERVER['HTTP_CF_RAY'])) {
    add_action('template_redirect', function() {
        ob_start('waxing_tunnel_url_filter');
    });
}

// Load config constants first
require_once get_template_directory() . '/inc/config.php';

/**
 * Theme Setup
 */
function waxing_shop_theme_setup() {
    load_theme_textdomain('waxing-shop', WAXING_DIR . '/languages');
    
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style'));
    add_theme_support('responsive-embeds');
    
    // WooCommerce support
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 400,
        'single_image_width' => 800,
        'product_grid' => array('default_rows' => 3, 'default_columns' => 4),
    ));
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Image sizes
    add_image_size('product-card', 600, 600, true);
    add_image_size('product-large', 1200, 1200, true);
    add_image_size('blog-card', 600, 400, true);
    
    // Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'waxing-shop'),
        'footer' => __('Footer Menu', 'waxing-shop'),
    ));
}
add_action('after_setup_theme', 'waxing_shop_theme_setup');

/**
 * Enqueue Styles and Scripts
 */
function waxing_shop_enqueue_scripts() {
    // Google Fonts
    wp_enqueue_style('waxing-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap', array(), null);

    // Main stylesheet
    wp_enqueue_style('waxing-style', get_stylesheet_uri(), array('waxing-fonts'), WAXING_VERSION);

    // Components CSS - always load (contains shared components)
    waxing_maybe_enqueue_css('components');
    waxing_maybe_enqueue_css('sections');
    waxing_maybe_enqueue_css('mobile-fixes');

    // Conditionally load page-specific CSS
    if (function_exists('is_woocommerce')) {
        // Shop and category pages
        if (is_shop() || is_product_category() || is_product_tag()) {
            waxing_maybe_enqueue_css('shop');
        }

        // Single product page
        if (is_product()) {
            waxing_maybe_enqueue_css('single-product');
        }

        // Cart and checkout
        if (is_cart() || is_checkout() || is_account_page()) {
            waxing_maybe_enqueue_css('shop');
        }
    }

    // Blog pages
    if (is_home() || is_archive() || is_single() && get_post_type() === 'post') {
        waxing_maybe_enqueue_css('blog');
    }

    // Content pages (about, contact, etc.)
    if (is_page() && !is_front_page()) {
        waxing_maybe_enqueue_css('content-pages');
    }

    // Wholesale page (check by template or page slug)
    if (is_page('wholesale') || is_page('groothandel') || is_page_template('page-wholesale.php')) {
        waxing_maybe_enqueue_css('wholesale');
    }

    // Main JavaScript (use minified in production)
    $js_file = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '/js/main.js' : '/js/main.min.js';
    wp_enqueue_script('waxing-main', WAXING_URI . $js_file, array(), WAXING_VERSION, true);

    wp_localize_script('waxing-main', 'waxingShop', array(
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('waxing_nonce'),
        'homeUrl'  => home_url('/'),
        'cartUrl'  => function_exists('wc_get_cart_url') ? wc_get_cart_url() : '',
        'shopUrl'  => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '',
        'currency' => function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '€',
        'wishlist' => function_exists('waxing_get_wishlist') ? waxing_get_wishlist() : array(),
    ));
}
add_action('wp_enqueue_scripts', 'waxing_shop_enqueue_scripts');

/**
 * Helper to conditionally enqueue CSS if file exists
 * Uses minified version in production
 *
 * @param string $file CSS filename without extension
 */
function waxing_maybe_enqueue_css($file) {
    $use_min = !(defined('SCRIPT_DEBUG') && SCRIPT_DEBUG);
    $suffix = $use_min ? '.min.css' : '.css';
    $path = WAXING_DIR . '/css/' . $file . $suffix;

    // Fallback to non-minified if minified doesn't exist
    if (!file_exists($path)) {
        $suffix = '.css';
        $path = WAXING_DIR . '/css/' . $file . '.css';
    }

    if (file_exists($path)) {
        wp_enqueue_style('waxing-' . $file, WAXING_URI . '/css/' . $file . $suffix, array('waxing-style'), WAXING_VERSION);
    }
}

/**
 * Register Widget Areas
 */
function waxing_shop_widgets_init() {
    register_sidebar(array(
        'name' => __('Shop Sidebar', 'waxing-shop'),
        'id' => 'shop-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'waxing_shop_widgets_init');

/**
 * Performance Optimizations
 */
// Add fetchpriority="high" to LCP image (hero/logo)
add_filter('wp_get_attachment_image_attributes', function($attr, $attachment, $size) {
    // Hero images and logos get high priority
    if (is_front_page() && in_array($size, array('full', 'large', 'hero'))) {
        $attr['fetchpriority'] = 'high';
        $attr['decoding'] = 'async';
        unset($attr['loading']); // Remove lazy for above-fold
    }
    return $attr;
}, 10, 3);

// Optimize image loading attributes
add_filter('the_content', function($content) {
    // Add loading="lazy" and decoding="async" to images without these attributes
    $content = preg_replace(
        '/<img((?![^>]*loading=)[^>]*)>/i',
        '<img$1 loading="lazy">',
        $content
    );
    $content = preg_replace(
        '/<img((?![^>]*decoding=)[^>]*)>/i',
        '<img$1 decoding="async">',
        $content
    );
    return $content;
}, 99);

// Preload critical fonts
add_action('wp_head', function() {
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/dmsans/v15/rP2Hp2ywxg089UriCZOIHQ.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/dmserifdisplay/v15/-nFnOHM81r4j6k0gjAW3mujVU2B2G_5x0g.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
}, 1);

// Inline critical CSS for faster FCP
add_action('wp_head', function() {
    $critical_css = WAXING_DIR . '/css/critical.css';
    if (file_exists($critical_css)) {
        $css = file_get_contents($critical_css);
        // Minify: remove comments, extra whitespace
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = preg_replace('/\s+/', ' ', $css);
        $css = str_replace(array(' {', '{ ', ' }', '} ', ': ', ' :', ', ', ' ,', '; ', ' ;'), array('{', '{', '}', '}', ':', ':', ',', ',', ';', ';'), $css);
        echo '<style id="critical-css">' . trim($css) . '</style>' . "\n";
    }
}, 2);

/**
 * Load includes - with existence check
 * Note: config.php is loaded first at the top of this file
 */
$include_files = array('helpers', 'ajax', 'shortcodes', 'admin-settings');
foreach ($include_files as $file) {
    $path = WAXING_DIR . '/inc/' . $file . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
}

/**
 * WooCommerce Customizations
 */
if (class_exists('WooCommerce')) {
    // Remove default WooCommerce styles
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Products per page
    add_filter('loop_shop_per_page', function() { return 12; });
    
    // Remove default breadcrumbs
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    
    // AJAX cart fragments
    add_filter('woocommerce_add_to_cart_fragments', function($fragments) {
        if (WC()->cart) {
            $fragments['.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
        }
        return $fragments;
    });
}

/**
 * Custom body classes
 */
add_filter('body_class', function($classes) {
    if (is_front_page()) $classes[] = 'home-page';
    if (function_exists('is_shop') && (is_shop() || is_product_category())) $classes[] = 'shop-page';
    if (function_exists('is_product') && is_product()) $classes[] = 'product-page';
    return $classes;
});

/**
 * Preconnect to Google Fonts
 */
add_action('wp_head', function() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1);

/**
 * Add defer to scripts for performance
 */
add_filter('script_loader_tag', function($tag, $handle) {
    // Scripts that should be deferred
    $defer_scripts = array('waxing-main', 'wc-add-to-cart', 'woocommerce', 'wc-cart-fragments');

    if (in_array($handle, $defer_scripts) && strpos($tag, 'defer') === false) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}, 10, 2);

// Remove jQuery migrate in production (saves ~10KB)
add_action('wp_default_scripts', function($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
});

// Add resource hints for third-party domains
add_action('wp_head', function() {
    $hints = array(
        'dns-prefetch' => array(
            '//fonts.gstatic.com',
            '//www.google-analytics.com',
            '//www.googletagmanager.com',
        ),
        'preconnect' => array(
            'https://fonts.gstatic.com',
        ),
    );

    foreach ($hints as $rel => $urls) {
        foreach ($urls as $url) {
            if ($rel === 'preconnect') {
                echo '<link rel="' . esc_attr($rel) . '" href="' . esc_url($url) . '" crossorigin>' . "\n";
            } else {
                echo '<link rel="' . esc_attr($rel) . '" href="' . esc_attr($url) . '">' . "\n";
            }
        }
    }
}, 0);

/**
 * Custom Nav Walker for adding nav-link class to menu items
 */
class Waxing_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        
        // Skip items with 'shop' in title (already shown with mega menu)
        $title_lower = strtolower($item->title);
        if ($title_lower === 'shop' || $title_lower === 'winkel') {
            return;
        }
        
        $output .= '<a href="' . esc_url($item->url) . '" class="nav-link">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing tag needed
    }
}

/**
 * Fallback menu if no menu is assigned
 */
function waxing_fallback_menu() {
    echo '<a href="' . esc_url(home_url('/waxen/')) . '" class="nav-link">Waxen</a>';
    echo '<a href="' . esc_url(home_url('/academy/')) . '" class="nav-link">Academy</a>';
    echo '<a href="' . esc_url(home_url('/blog/')) . '" class="nav-link">Blog</a>';
    echo '<a href="' . esc_url(home_url('/faq/')) . '" class="nav-link">FAQ</a>';
    echo '<a href="' . esc_url(home_url('/over-ons/')) . '" class="nav-link">Over Ons</a>';
    echo '<a href="' . esc_url(home_url('/contact/')) . '" class="nav-link">Contact</a>';
}

/**
 * Custom Mobile Nav Walker
 */
class Waxing_Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Skip items with 'shop' in title (already shown separately)
        $title_lower = strtolower($item->title);
        if ($title_lower === 'shop' || $title_lower === 'winkel') {
            return;
        }
        
        $output .= '<a href="' . esc_url($item->url) . '" class="mobile-menu-link">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        // No closing tag needed
    }
}

/**
 * Fallback mobile menu if no menu is assigned
 */
function waxing_mobile_fallback_menu() {
    echo '<a href="' . esc_url(home_url('/waxen/')) . '" class="mobile-menu-link">Waxen</a>';
    echo '<a href="' . esc_url(home_url('/academy/')) . '" class="mobile-menu-link">Academy</a>';
    echo '<a href="' . esc_url(home_url('/blog/')) . '" class="mobile-menu-link">Blog</a>';
    echo '<a href="' . esc_url(home_url('/faq/')) . '" class="mobile-menu-link">FAQ</a>';
    echo '<a href="' . esc_url(home_url('/over-ons/')) . '" class="mobile-menu-link">Over Ons</a>';
    echo '<a href="' . esc_url(home_url('/contact/')) . '" class="mobile-menu-link">Contact</a>';
}

/**
 * ========================================
 * BLOG FUNCTIONS
 * ========================================
 */

/**
 * Calculate reading time for a post
 *
 * @param int|null $post_id Post ID (optional, uses current post if not provided)
 * @return string Reading time text (e.g., "5 min leestijd")
 */
function waxing_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words/min

    if ($reading_time < 1) {
        $reading_time = 1;
    }

    return $reading_time . ' min leestijd';
}

/**
 * Get reading time as integer (minutes only)
 *
 * @param int|null $post_id Post ID
 * @return int Reading time in minutes
 */
function waxing_get_reading_time_int($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);

    return max(1, $reading_time);
}

/**
 * Register Blog Categories
 * Creates default blog categories if they don't exist
 */
function waxing_register_blog_categories() {
    $categories = array(
        array(
            'name' => 'Huidproblemen',
            'slug' => 'huidproblemen',
            'description' => 'Artikelen over scheerbultjes, ingegroeide haren en andere huidproblemen'
        ),
        array(
            'name' => 'Vergelijkingen',
            'slug' => 'vergelijkingen',
            'description' => 'Vergelijkingen tussen wax types, harsen vs wax, etc.'
        ),
        array(
            'name' => 'Lichaamsdelen',
            'slug' => 'lichaamsdelen',
            'description' => 'Artikelen per lichaamsdeel: benen, bikinilijn, gezicht, etc.'
        ),
        array(
            'name' => 'Doelgroepen',
            'slug' => 'doelgroepen',
            'description' => 'Artikelen voor specifieke doelgroepen: mannen, gevoelige huid, etc.'
        ),
        array(
            'name' => 'Educatie',
            'slug' => 'educatie',
            'description' => 'How-to artikelen, tips en technieken'
        ),
        array(
            'name' => 'Product Advies',
            'slug' => 'product-advies',
            'description' => 'Productreviews en aanbevelingen'
        ),
    );

    foreach ($categories as $cat) {
        if (!term_exists($cat['slug'], 'category')) {
            wp_insert_term(
                $cat['name'],
                'category',
                array(
                    'slug' => $cat['slug'],
                    'description' => $cat['description']
                )
            );
        }
    }
}
add_action('after_switch_theme', 'waxing_register_blog_categories');

// Also run once on init if categories don't exist yet
add_action('init', function() {
    // Only run once - check if our first category exists
    if (!term_exists('huidproblemen', 'category')) {
        waxing_register_blog_categories();
    }
});

/**
 * Register WooCommerce Product Categories
 * Creates default product categories if they don't exist
 */
function waxing_register_product_categories() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    $categories = array(
        array(
            'name' => 'Verwarmers',
            'slug' => 'verwarmers',
            'description' => 'Professionele wax verwarmers voor thuis en salon. Nauwkeurige temperatuurregeling voor optimale resultaten.'
        ),
        array(
            'name' => 'Startersets',
            'slug' => 'pakketten',
            'description' => 'Complete startersets met alles wat je nodig hebt om te beginnen met waxen.'
        ),
        array(
            'name' => 'Hot Wax',
            'slug' => 'hot-wax',
            'description' => 'Premium hot wax in verschillende varianten voor elk huidtype.'
        ),
        array(
            'name' => 'Verzorging',
            'slug' => 'verzorging',
            'description' => 'Pre- en post-wax verzorgingsproducten voor optimale resultaten.'
        ),
        array(
            'name' => 'Accessoires',
            'slug' => 'accessoires',
            'description' => 'Spatels, strips en andere wax accessoires.'
        ),
    );

    foreach ($categories as $cat) {
        if (!term_exists($cat['slug'], 'product_cat')) {
            wp_insert_term(
                $cat['name'],
                'product_cat',
                array(
                    'slug' => $cat['slug'],
                    'description' => $cat['description']
                )
            );
        }
    }
}
add_action('init', 'waxing_register_product_categories', 20);

/**
 * Get related posts based on category
 *
 * @param int $post_id Current post ID
 * @param int $count Number of related posts to return
 * @return WP_Query Related posts query
 */
function waxing_get_related_posts($post_id = null, $count = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $categories = wp_get_post_categories($post_id);

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $count,
        'post__not_in' => array($post_id),
        'category__in' => $categories,
        'orderby' => 'rand',
        'post_status' => 'publish'
    );

    return new WP_Query($args);
}

/**
 * Generate Table of Contents from post headings
 *
 * @param string $content Post content
 * @return array Array with 'toc' (HTML) and 'content' (modified content with IDs)
 */
function waxing_generate_toc($content) {
    preg_match_all('/<h([2-3])[^>]*>(.*?)<\/h[2-3]>/i', $content, $matches, PREG_SET_ORDER);

    if (empty($matches)) {
        return array('toc' => '', 'content' => $content);
    }

    $toc = '<nav class="toc" aria-label="Inhoudsopgave"><h4>Inhoudsopgave</h4><ul>';
    $modified_content = $content;

    foreach ($matches as $index => $match) {
        $level = $match[1];
        $heading_text = strip_tags($match[2]);
        $heading_id = 'heading-' . ($index + 1);

        // Add ID to heading in content
        $old_heading = $match[0];
        $new_heading = '<h' . $level . ' id="' . $heading_id . '">' . $match[2] . '</h' . $level . '>';
        $modified_content = str_replace($old_heading, $new_heading, $modified_content);

        // Add to TOC
        $indent_class = $level == 3 ? ' class="toc-sub"' : '';
        $toc .= '<li' . $indent_class . '><a href="#' . $heading_id . '">' . esc_html($heading_text) . '</a></li>';
    }

    $toc .= '</ul></nav>';

    return array('toc' => $toc, 'content' => $modified_content);
}

/**
 * 301 Redirects for old product URLs to new SEO-optimized slugs
 *
 * @since 5.8
 */
function waxing_product_redirects() {
    if (is_admin()) return;

    $redirects = array(
        // HOT WAX 1KG
        'hot-wax-rose-premium-wax-pellets-1kg' => 'hot-wax-rose',
        'hot-wax-nacree-blanche-premium-1kg-gratis-spatels' => 'nacree-blanche',
        'hot-wax-gold-luxe-hardwax-1kg' => 'hot-wax-gold',
        'hot-wax-melon-violet-wax-korrels-1kg' => 'melon-violet',
        'intieme-zone-wax-sunset-brazilian-wax-1kg' => 'sunset-hypoallergeen',
        'intimi-wax-caraibe-brazilian-premium' => 'intimicire',
        'vegan-hot-wax-100-plantaardig-1kg' => 'vegan-hotwax',
        'rodo-premium-ontharingswax-1kg-wax-beans' => 'rodo-premium',
        // HOT WAX BLIK
        'hot-wax-sunset-hypoallergeen-blik-400ml' => 'sunset-400ml',
        'hot-wax-nacree-blanche-blik-400ml' => 'nacree-400ml',
        // STRIPHARS
        'striphars-in-blik-800ml' => 'striphars-800ml',
        'striphars-in-blik-400ml' => 'striphars-400ml',
        'striphars-startpakket-800ml-spatels-strips' => 'striphars-startpakket',
        // HARSPATRONEN
        'harspatroon-rose-100ml-harsroller' => 'harspatroon-rose',
        'harspatroon-chloro-100ml-harsroller' => 'harspatroon-chloro',
        'harspatroon-tournesol-100ml-harsroller' => 'harspatroon-tournesol',
        // APPARATUUR
        'harsverwarmer-voor-harspatronen' => 'harsverwarmer',
        // VERZORGING
        'bikini-saver-tegen-ingegroeide-haren-60ml' => 'bikini-saver',
        'post-pre-wax-lotion-relax-100ml' => 'relax-lotion',
        // PAKKETTEN
        'pincet-wide-grip-professioneel' => 'pincet-professioneel',
        'hot-wax-startkit-4-x-200gr-50-spatels' => 'starterset-hotwax',
        'hot-wax-compleet-pakket-nacree-blanche-spatels-lotion' => 'starterset-compleet',
        'verzorgingsset-tegen-ingegroeide-haren' => 'verzorgingsset',
    );

    $request_uri = $_SERVER['REQUEST_URI'];

    // Check if this is a product URL
    if (preg_match('#^/product/([^/]+)/?$#', $request_uri, $matches)) {
        $old_slug = $matches[1];

        if (isset($redirects[$old_slug])) {
            $new_url = home_url('/product/' . $redirects[$old_slug] . '/');
            wp_redirect($new_url, 301);
            exit;
        }
    }
}
add_action('template_redirect', 'waxing_product_redirects', 1);
