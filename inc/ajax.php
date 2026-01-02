<?php
/**
 * AJAX Handlers
 * 
 * @package Waxing_Shop
 * @since 3.1
 */

// =============================================
// ADD TO CART
// =============================================

/**
 * Handle AJAX add to cart
 */
function waxing_ajax_add_to_cart() {
    check_ajax_referer('waxing_nonce', 'nonce');
    
    $product_id = absint($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
    
    if (!$product_id || !function_exists('WC')) {
        wp_send_json_error(array('message' => __('Ongeldige aanvraag', 'waxing-shop')));
    }
    
    $product = wc_get_product($product_id);
    if (!$product || !$product->is_in_stock()) {
        wp_send_json_error(array('message' => __('Product niet beschikbaar', 'waxing-shop')));
    }
    
    $added = WC()->cart->add_to_cart($product_id, $quantity);
    
    if ($added) {
        wp_send_json_success(array(
            'cart_count'   => WC()->cart->get_cart_contents_count(),
            'cart_total'   => WC()->cart->get_cart_total(),
            'product_name' => $product->get_name(),
            'message'      => sprintf(
                /* translators: %s: product name */
                __('%s toegevoegd aan winkelmand', 'waxing-shop'),
                $product->get_name()
            ),
        ));
    }
    
    wp_send_json_error(array('message' => __('Kon niet toevoegen aan winkelmand', 'waxing-shop')));
}
add_action('wp_ajax_waxing_add_to_cart', 'waxing_ajax_add_to_cart');
add_action('wp_ajax_nopriv_waxing_add_to_cart', 'waxing_ajax_add_to_cart');

// =============================================
// FILTER PRODUCTS
// =============================================

/**
 * Handle AJAX product filtering
 */
function waxing_ajax_filter_products() {
    check_ajax_referer('waxing_nonce', 'nonce');
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'paged'          => isset($_POST['page']) ? absint($_POST['page']) : 1,
    );
    
    $tax_query = array('relation' => 'AND');
    $meta_query = array();
    
    // Category filter
    if (!empty($_POST['category']) && $_POST['category'] !== 'all') {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_POST['category']),
        );
    }
    
    // Variant (color) filter
    if (!empty($_POST['variant'])) {
        $variant = sanitize_text_field($_POST['variant']);
        $args['s'] = $variant;
    }
    
    // Price range filter
    $min = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $max = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 999;
    if ($min > 0 || $max < 999) {
        $meta_query[] = array(
            'key'     => '_price',
            'value'   => array($min, $max),
            'type'    => 'NUMERIC',
            'compare' => 'BETWEEN',
        );
    }
    
    if (count($tax_query) > 1) $args['tax_query'] = $tax_query;
    if (!empty($meta_query)) $args['meta_query'] = $meta_query;
    
    // Sorting
    $orderby = sanitize_text_field($_POST['orderby'] ?? 'popularity');
    switch ($orderby) {
        case 'price-asc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'price-desc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'date':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'rating':
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        default:
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
    }
    
    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        $first = true;
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $product = wc_get_product(get_the_ID());

            get_template_part('template-parts/product-card', null, array(
                'featured' => $first,
            ));
            $first = false;
        }
    } else {
        ?>
        <div class="no-products" role="status">
            <div class="no-products-icon" aria-hidden="true">🔍</div>
            <h3 class="no-products-title"><?php esc_html_e('Geen producten gevonden', 'waxing-shop'); ?></h3>
            <p class="no-products-text"><?php esc_html_e('Probeer andere filters of bekijk alle producten.', 'waxing-shop'); ?></p>
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary"><?php esc_html_e('Alle producten', 'waxing-shop'); ?></a>
        </div>
        <?php
    }
    $html = ob_get_clean();
    wp_reset_postdata();
    
    wp_send_json_success(array(
        'html'  => $html,
        'count' => $query->found_posts,
        'pages' => $query->max_num_pages,
    ));
}
add_action('wp_ajax_waxing_filter_products', 'waxing_ajax_filter_products');
add_action('wp_ajax_nopriv_waxing_filter_products', 'waxing_ajax_filter_products');

// =============================================
// NEWSLETTER
// =============================================

/**
 * Handle AJAX newsletter subscription
 */
function waxing_ajax_newsletter() {
    check_ajax_referer('waxing_nonce', 'nonce');

    // Rate limiting - max attempts per hour per IP
    $ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $rate_key = 'waxing_newsletter_' . md5($ip);
    $attempt_count = (int) get_transient($rate_key);
    $rate_limit = defined('WAXING_NEWSLETTER_RATE_LIMIT') ? WAXING_NEWSLETTER_RATE_LIMIT : 3;

    if ($attempt_count >= $rate_limit) {
        wp_send_json_error(array('message' => __('Te veel aanmeldpogingen. Probeer later opnieuw.', 'waxing-shop')));
    }
    set_transient($rate_key, $attempt_count + 1, HOUR_IN_SECONDS);

    $email = sanitize_email($_POST['email']);
    $source = sanitize_text_field($_POST['source'] ?? 'footer');
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Ongeldig e-mailadres', 'waxing-shop')));
    }
    
    $subscribers = get_option('waxing_subscribers', array());
    
    // Check for duplicates
    foreach ($subscribers as $sub) {
        if ($sub['email'] === $email) {
            wp_send_json_error(array('message' => __('Dit e-mailadres is al ingeschreven', 'waxing-shop')));
        }
    }
    
    // Add subscriber
    $subscribers[] = array(
        'email'  => $email,
        'source' => $source,
        'date'   => current_time('mysql'),
        'ip'     => '', // Don't store IP for GDPR
    );
    update_option('waxing_subscribers', $subscribers);
    
    // Hook for external email providers (Mailchimp, Klaviyo, etc.)
    do_action('waxing_new_subscriber', $email, $source);
    
    wp_send_json_success(array(
        'message' => __('Bedankt! Check je inbox voor 10% korting.', 'waxing-shop'),
    ));
}
add_action('wp_ajax_waxing_newsletter', 'waxing_ajax_newsletter');
add_action('wp_ajax_nopriv_waxing_newsletter', 'waxing_ajax_newsletter');

// =============================================
// ENHANCED QUICK VIEW
// =============================================

/**
 * Handle AJAX quick view with full product data
 * Supports: images, gallery, variations, stock, ratings
 */
function waxing_ajax_quick_view() {
    // Verify nonce for security
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'waxing_nonce')) {
        wp_send_json_error(array('message' => __('Beveiligingscontrole mislukt', 'waxing-shop')));
    }

    $product_id = isset($_GET['product_id']) ? absint($_GET['product_id']) : 0;

    if (!$product_id) {
        wp_send_json_error(array('message' => __('Ongeldig product', 'waxing-shop')));
    }
    
    $product = wc_get_product($product_id);
    
    if (!$product) {
        wp_send_json_error(array('message' => __('Product niet gevonden', 'waxing-shop')));
    }
    
    $colors = waxing_get_product_color($product_id);
    
    // Build response data
    $data = array(
        'id'                => $product_id,
        'name'              => $product->get_name(),
        'permalink'         => get_permalink($product_id),
        'price'             => $product->get_price_html(),
        'price_raw'         => floatval($product->get_price()),
        'regular_price_raw' => floatval($product->get_regular_price()),
        'short_description' => apply_filters('woocommerce_short_description', $product->get_short_description()),
        'category'          => wp_strip_all_tags(wc_get_product_category_list($product_id, ' • ')),
        'sku'               => $product->get_sku(),
        
        // Stock info
        'in_stock'          => $product->is_in_stock(),
        'stock_qty'         => $product->get_stock_quantity(),
        'stock_status'      => waxing_get_stock_status($product),
        'backorders'        => $product->backorders_allowed(),
        
        // Ratings
        'rating'            => floatval($product->get_average_rating()),
        'rating_count'      => intval($product->get_review_count()),
        
        // Color fallback
        'color'             => 'linear-gradient(135deg, ' . esc_attr($colors[0]) . ', ' . esc_attr($colors[1]) . ')',
        
        // Sale info
        'on_sale'           => $product->is_on_sale(),
        'sale_price'        => $product->is_on_sale() ? wc_price($product->get_sale_price()) : '',
        'regular_price'     => $product->is_on_sale() ? wc_price($product->get_regular_price()) : '',
        
        // Images
        'image'             => null,
        'image_thumb'       => null,
        'gallery'           => array(),
        
        // Variations (for variable products)
        'type'              => $product->get_type(),
        'variations'        => array(),
    );
    
    // Main image
    $image_id = $product->get_image_id();
    if ($image_id) {
        $data['image'] = wp_get_attachment_image_url($image_id, 'woocommerce_single');
        $data['image_thumb'] = wp_get_attachment_image_url($image_id, 'woocommerce_thumbnail');
    }
    
    // Gallery images
    $gallery_ids = $product->get_gallery_image_ids();
    if (!empty($gallery_ids)) {
        foreach ($gallery_ids as $gallery_id) {
            $data['gallery'][] = array(
                'full'  => wp_get_attachment_image_url($gallery_id, 'woocommerce_single'),
                'thumb' => wp_get_attachment_image_url($gallery_id, 'woocommerce_thumbnail'),
            );
        }
    }
    
    // Handle variable products
    if ($product->is_type('variable')) {
        $available_variations = $product->get_available_variations();
        
        if (!empty($available_variations)) {
            foreach ($available_variations as $variation) {
                $var_product = wc_get_product($variation['variation_id']);
                if (!$var_product) continue;
                
                // Get variation attributes as readable name
                $attr_values = array();
                foreach ($variation['attributes'] as $attr_key => $attr_value) {
                    if ($attr_value) {
                        $attr_values[] = ucfirst(str_replace('-', ' ', $attr_value));
                    }
                }
                $variation_name = implode(' / ', $attr_values);
                if (empty($variation_name)) {
                    $variation_name = __('Standaard', 'waxing-shop');
                }
                
                $var_image = isset($variation['image']['url']) ? $variation['image']['url'] : null;
                
                $data['variations'][] = array(
                    'id'            => $variation['variation_id'],
                    'name'          => $variation_name,
                    'price'         => $var_product->get_price_html(),
                    'price_raw'     => floatval($var_product->get_price()),
                    'in_stock'      => $variation['is_in_stock'],
                    'stock_qty'     => $var_product->get_stock_quantity(),
                    'image'         => $var_image,
                    'sku'           => $var_product->get_sku(),
                );
            }
        }
        
        // Set default price to first variation if available
        if (!empty($data['variations'])) {
            $data['price_raw'] = $data['variations'][0]['price_raw'];
        }
    }
    
    // Add delivery estimate
    $data['delivery'] = waxing_get_delivery_estimate();
    
    wp_send_json_success($data);
}
add_action('wp_ajax_waxing_quick_view', 'waxing_ajax_quick_view');
add_action('wp_ajax_nopriv_waxing_quick_view', 'waxing_ajax_quick_view');


// =============================================
// MINI CART AJAX HANDLERS
// =============================================

/**
 * Get cart fragments for mini-cart updates
 */
function waxing_ajax_get_cart_fragments() {
    if (!function_exists('WC')) {
        wp_send_json_error();
    }
    
    wp_send_json_success(array(
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_items' => waxing_get_mini_cart_items(),
    ));
}
add_action('wp_ajax_waxing_get_cart', 'waxing_ajax_get_cart_fragments');
add_action('wp_ajax_nopriv_waxing_get_cart', 'waxing_ajax_get_cart_fragments');


/**
 * Get mini cart items for slide-in cart
 */
function waxing_get_mini_cart_items() {
    if (!function_exists('WC') || WC()->cart->is_empty()) {
        return array();
    }
    
    $items = array();
    
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];
        $items[] = array(
            'key'       => $cart_item_key,
            'id'        => $cart_item['product_id'],
            'name'      => $product->get_name(),
            'quantity'  => $cart_item['quantity'],
            'price'     => wc_price($product->get_price()),
            'subtotal'  => wc_price($cart_item['line_subtotal']),
            'image'     => get_the_post_thumbnail_url($cart_item['product_id'], 'woocommerce_thumbnail'),
            'permalink' => get_permalink($cart_item['product_id']),
        );
    }
    
    return $items;
}


/**
 * Remove item from cart via AJAX
 */
function waxing_ajax_remove_cart_item() {
    check_ajax_referer('waxing_nonce', 'nonce');
    
    $cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';
    
    if (!$cart_item_key || !function_exists('WC')) {
        wp_send_json_error(array('message' => __('Ongeldige aanvraag', 'waxing-shop')));
    }
    
    $removed = WC()->cart->remove_cart_item($cart_item_key);
    
    if ($removed) {
        wp_send_json_success(array(
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => WC()->cart->get_cart_total(),
            'cart_items' => waxing_get_mini_cart_items(),
            'message'    => __('Product verwijderd', 'waxing-shop'),
        ));
    }
    
    wp_send_json_error(array('message' => __('Kon product niet verwijderen', 'waxing-shop')));
}
add_action('wp_ajax_waxing_remove_cart_item', 'waxing_ajax_remove_cart_item');
add_action('wp_ajax_nopriv_waxing_remove_cart_item', 'waxing_ajax_remove_cart_item');


/**
 * Update cart item quantity via AJAX
 */
function waxing_ajax_update_cart_qty() {
    check_ajax_referer('waxing_nonce', 'nonce');
    
    $cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';
    $quantity = isset($_POST['quantity']) ? absint($_POST['quantity']) : 1;
    
    if (!$cart_item_key || !function_exists('WC')) {
        wp_send_json_error(array('message' => __('Ongeldige aanvraag', 'waxing-shop')));
    }
    
    if ($quantity === 0) {
        WC()->cart->remove_cart_item($cart_item_key);
    } else {
        WC()->cart->set_quantity($cart_item_key, $quantity);
    }
    
    wp_send_json_success(array(
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total(),
        'cart_items' => waxing_get_mini_cart_items(),
    ));
}
add_action('wp_ajax_waxing_update_cart_qty', 'waxing_ajax_update_cart_qty');
add_action('wp_ajax_nopriv_waxing_update_cart_qty', 'waxing_ajax_update_cart_qty');

// =============================================
// GDPR: DATA EXPORT & DELETE
// =============================================

/**
 * Export subscriber data (for GDPR compliance)
 */
function waxing_export_subscriber_data($email) {
    $subscribers = get_option('waxing_subscribers', array());
    
    foreach ($subscribers as $sub) {
        if ($sub['email'] === $email) {
            return $sub;
        }
    }
    
    return null;
}

/**
 * Delete subscriber data (for GDPR compliance)
 */
function waxing_delete_subscriber_data($email) {
    $subscribers = get_option('waxing_subscribers', array());
    $updated = array();
    $deleted = false;
    
    foreach ($subscribers as $sub) {
        if ($sub['email'] !== $email) {
            $updated[] = $sub;
        } else {
            $deleted = true;
        }
    }
    
    if ($deleted) {
        update_option('waxing_subscribers', $updated);
    }
    
    return $deleted;
}

/**
 * AJAX handler for subscriber data deletion
 */
function waxing_ajax_gdpr_delete() {
    check_ajax_referer('waxing_nonce', 'nonce');
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => __('Ongeldig e-mailadres', 'waxing-shop')));
    }
    
    $deleted = waxing_delete_subscriber_data($email);
    
    if ($deleted) {
        wp_send_json_success(array(
            'message' => __('Je gegevens zijn verwijderd.', 'waxing-shop'),
        ));
    }
    
    wp_send_json_error(array(
        'message' => __('E-mailadres niet gevonden.', 'waxing-shop'),
    ));
}
add_action('wp_ajax_waxing_gdpr_delete', 'waxing_ajax_gdpr_delete');
add_action('wp_ajax_nopriv_waxing_gdpr_delete', 'waxing_ajax_gdpr_delete');

// =============================================
// LIVE SEARCH
// =============================================

/**
 * Handle AJAX live search for products
 * @since 5.8
 */
function waxing_ajax_live_search() {
    // Rate limiting - max searches per minute per IP
    $ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $rate_key = 'waxing_search_' . md5($ip);
    $search_count = (int) get_transient($rate_key);
    $rate_limit = defined('WAXING_SEARCH_RATE_LIMIT') ? WAXING_SEARCH_RATE_LIMIT : 10;

    if ($search_count > $rate_limit) {
        wp_send_json_error(array('message' => __('Te veel zoekopdrachten. Probeer later opnieuw.', 'waxing-shop')));
    }
    set_transient($rate_key, $search_count + 1, MINUTE_IN_SECONDS);

    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    if (strlen($search) < 2) {
        wp_send_json_success(array(
            'products' => array(),
            'articles' => array(),
            'pages'    => array(),
        ));
    }

    // Search Products
    $product_args = array(
        'post_type'      => 'product',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        's'              => $search,
    );
    $product_query = new WP_Query($product_args);
    $products = array();

    if ($product_query->have_posts()) {
        while ($product_query->have_posts()) {
            $product_query->the_post();
            $product = wc_get_product(get_the_ID());

            if (!$product) continue;

            $products[] = array(
                'id'        => get_the_ID(),
                'name'      => get_the_title(),
                'price'     => $product->get_price_html(),
                'permalink' => get_permalink(),
                'image'     => get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail'),
                'type'      => 'product',
            );
        }
    }
    wp_reset_postdata();

    // Search Blog Articles
    $article_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        's'              => $search,
    );
    $article_query = new WP_Query($article_args);
    $articles = array();

    if ($article_query->have_posts()) {
        while ($article_query->have_posts()) {
            $article_query->the_post();
            $articles[] = array(
                'id'        => get_the_ID(),
                'name'      => get_the_title(),
                'excerpt'   => wp_trim_words(get_the_excerpt(), 15, '...'),
                'permalink' => get_permalink(),
                'image'     => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'date'      => get_the_date('j M Y'),
                'type'      => 'article',
            );
        }
    }
    wp_reset_postdata();

    // Search Pages
    $page_args = array(
        'post_type'      => 'page',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        's'              => $search,
        'post__not_in'   => array(
            get_option('page_on_front'),
            get_option('woocommerce_cart_page_id'),
            get_option('woocommerce_checkout_page_id'),
            get_option('woocommerce_myaccount_page_id'),
        ),
    );
    $page_query = new WP_Query($page_args);
    $pages = array();

    if ($page_query->have_posts()) {
        while ($page_query->have_posts()) {
            $page_query->the_post();
            $pages[] = array(
                'id'        => get_the_ID(),
                'name'      => get_the_title(),
                'excerpt'   => wp_trim_words(get_the_content(), 15, '...'),
                'permalink' => get_permalink(),
                'type'      => 'page',
            );
        }
    }
    wp_reset_postdata();

    $total = $product_query->found_posts + $article_query->found_posts + $page_query->found_posts;

    wp_send_json_success(array(
        'products' => $products,
        'articles' => $articles,
        'pages'    => $pages,
        'total'    => $total,
    ));
}
add_action('wp_ajax_waxing_live_search', 'waxing_ajax_live_search');
add_action('wp_ajax_nopriv_waxing_live_search', 'waxing_ajax_live_search');

/**
 * Get popular products for search modal
 * @since 5.8
 */
function waxing_ajax_get_popular_products() {
    $cache_key = 'waxing_popular_products';
    $products = get_transient($cache_key);

    if ($products === false) {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'meta_key'       => 'total_sales',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        );

        $query = new WP_Query($args);
        $products = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());

                if (!$product || !$product->is_in_stock()) continue;

                $products[] = array(
                    'id'        => get_the_ID(),
                    'name'      => get_the_title(),
                    'price'     => $product->get_price_html(),
                    'permalink' => get_permalink(),
                    'image'     => get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail'),
                );
            }
        }
        wp_reset_postdata();

        // Cache for 15 minutes
        set_transient($cache_key, $products, 15 * MINUTE_IN_SECONDS);
    }

    wp_send_json_success(array(
        'products' => $products,
    ));
}
add_action('wp_ajax_waxing_get_popular_products', 'waxing_ajax_get_popular_products');
add_action('wp_ajax_nopriv_waxing_get_popular_products', 'waxing_ajax_get_popular_products');

// =============================================
// WISHLIST
// =============================================

/**
 * Handle AJAX wishlist toggle
 * @since 5.8
 */
function waxing_ajax_wishlist_toggle() {
    // Verify nonce for security
    if (!check_ajax_referer('waxing_nonce', 'nonce', false)) {
        wp_send_json_error(array('message' => __('Beveiligingscontrole mislukt', 'waxing-shop')));
    }

    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;

    if (!$product_id) {
        wp_send_json_error(array('message' => __('Ongeldig product', 'waxing-shop')));
    }

    // Verify product exists
    $product = wc_get_product($product_id);
    if (!$product) {
        wp_send_json_error(array('message' => __('Product niet gevonden', 'waxing-shop')));
    }

    // Get wishlist from cookie/session
    $wishlist = isset($_COOKIE['waxing_wishlist']) ? json_decode(stripslashes($_COOKIE['waxing_wishlist']), true) : array();

    if (!is_array($wishlist)) {
        $wishlist = array();
    }

    // Limit wishlist items
    $max_items = defined('WAXING_WISHLIST_MAX_ITEMS') ? WAXING_WISHLIST_MAX_ITEMS : 50;
    if (count($wishlist) >= $max_items && !in_array($product_id, $wishlist)) {
        wp_send_json_error(array('message' => __('Maximaal 50 favorieten toegestaan', 'waxing-shop')));
    }

    $in_wishlist = in_array($product_id, $wishlist);

    if ($in_wishlist) {
        // Remove from wishlist
        $wishlist = array_diff($wishlist, array($product_id));
        $message = __('Verwijderd uit favorieten', 'waxing-shop');
        $action = 'removed';
    } else {
        // Add to wishlist
        $wishlist[] = $product_id;
        $message = __('Toegevoegd aan favorieten', 'waxing-shop');
        $action = 'added';
    }

    // Update cookie with secure flags (30 days expiry)
    $cookie_options = array(
        'expires'  => time() + (30 * DAY_IN_SECONDS),
        'path'     => '/',
        'secure'   => is_ssl(),
        'httponly' => true,
        'samesite' => 'Lax',
    );
    setcookie('waxing_wishlist', json_encode(array_values($wishlist)), $cookie_options);

    wp_send_json_success(array(
        'action'   => $action,
        'message'  => $message,
        'count'    => count($wishlist),
        'wishlist' => $wishlist,
    ));
}
add_action('wp_ajax_waxing_wishlist_toggle', 'waxing_ajax_wishlist_toggle');
add_action('wp_ajax_nopriv_waxing_wishlist_toggle', 'waxing_ajax_wishlist_toggle');

/**
 * Get wishlist from cookie
 */
function waxing_get_wishlist() {
    $wishlist = isset($_COOKIE['waxing_wishlist']) ? json_decode(stripslashes($_COOKIE['waxing_wishlist']), true) : array();
    return is_array($wishlist) ? $wishlist : array();
}

/**
 * Get wishlist items with product details
 */
function waxing_ajax_get_wishlist_items() {
    $wishlist = waxing_get_wishlist();
    $items = array();

    if (!empty($wishlist)) {
        foreach ($wishlist as $product_id) {
            $product = wc_get_product($product_id);

            if (!$product || !$product->is_visible()) continue;

            $items[] = array(
                'id'        => $product_id,
                'name'      => $product->get_name(),
                'price'     => $product->get_price_html(),
                'permalink' => get_permalink($product_id),
                'image'     => get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail'),
            );
        }
    }

    wp_send_json_success(array(
        'items' => $items,
        'count' => count($items),
    ));
}
add_action('wp_ajax_waxing_get_wishlist_items', 'waxing_ajax_get_wishlist_items');
add_action('wp_ajax_nopriv_waxing_get_wishlist_items', 'waxing_ajax_get_wishlist_items');

// =============================================
// CART SUGGESTIONS ("Misschien vergeten?")
// =============================================

/**
 * Get product suggestions based on cart contents
 * Returns complementary products the customer might have forgotten
 *
 * @since 5.8
 */
function waxing_ajax_get_cart_suggestions() {
    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_success(array('products' => array()));
    }

    $cart_items = WC()->cart->get_cart();
    $cart_product_ids = array();
    $cart_category_ids = array();

    // Collect product IDs and categories from cart
    foreach ($cart_items as $item) {
        $cart_product_ids[] = $item['product_id'];
        $terms = get_the_terms($item['product_id'], 'product_cat');
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $cart_category_ids[] = $term->term_id;
            }
        }
    }

    $cart_category_ids = array_unique($cart_category_ids);

    // Build suggestion query
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'post__not_in'   => $cart_product_ids, // Exclude items already in cart
        'orderby'        => 'meta_value_num',
        'meta_key'       => 'total_sales',
        'order'          => 'DESC',
    );

    // If cart has categories, suggest from same categories (complementary products)
    if (!empty($cart_category_ids)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $cart_category_ids,
            ),
        );
    }

    // Priority to accessory/complementary categories
    $accessory_cats = array('accessoires', 'verzorging', 'accessories', 'care');
    $accessory_term_ids = array();
    foreach ($accessory_cats as $slug) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if ($term) {
            $accessory_term_ids[] = $term->term_id;
        }
    }

    // If we have accessory categories and cart has wax products, prioritize accessories
    if (!empty($accessory_term_ids) && !empty($cart_product_ids)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $accessory_term_ids,
            ),
        );
    }

    $query = new WP_Query($args);
    $products = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            if (!$product || !$product->is_in_stock()) continue;

            $products[] = array(
                'id'        => get_the_ID(),
                'name'      => $product->get_name(),
                'price'     => $product->get_price_html(),
                'price_raw' => floatval($product->get_price()),
                'permalink' => get_permalink(),
                'image'     => get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail'),
            );
        }
    }
    wp_reset_postdata();

    // If no category-based suggestions, fall back to bestsellers
    if (empty($products)) {
        $fallback_args = array(
            'post_type'      => 'product',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
            'post__not_in'   => $cart_product_ids,
            'meta_key'       => 'total_sales',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        );

        $fallback_query = new WP_Query($fallback_args);

        if ($fallback_query->have_posts()) {
            while ($fallback_query->have_posts()) {
                $fallback_query->the_post();
                $product = wc_get_product(get_the_ID());

                if (!$product || !$product->is_in_stock()) continue;

                $products[] = array(
                    'id'        => get_the_ID(),
                    'name'      => $product->get_name(),
                    'price'     => $product->get_price_html(),
                    'price_raw' => floatval($product->get_price()),
                    'permalink' => get_permalink(),
                    'image'     => get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail'),
                );
            }
        }
        wp_reset_postdata();
    }

    wp_send_json_success(array(
        'products' => $products,
        'title'    => __('Misschien vergeten?', 'waxing-shop'),
    ));
}
add_action('wp_ajax_waxing_get_cart_suggestions', 'waxing_ajax_get_cart_suggestions');
add_action('wp_ajax_nopriv_waxing_get_cart_suggestions', 'waxing_ajax_get_cart_suggestions');

// =============================================
// STARTER SET ADD TO CART
// =============================================

/**
 * Handle AJAX add starter set to cart with selected wax options
 * Adds the main set product plus selected wax products
 *
 * @since 5.8
 */
function waxing_ajax_add_starter_set() {
    check_ajax_referer('waxing_nonce', 'nonce');

    if (!function_exists('WC')) {
        wp_send_json_error(array('message' => __('WooCommerce niet actief', 'waxing-shop')));
    }

    $set_id = isset($_POST['set_id']) ? sanitize_text_field($_POST['set_id']) : '';
    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    $wax_choices = isset($_POST['wax_choices']) ? array_map('absint', (array) $_POST['wax_choices']) : array();

    // Validate set ID
    $valid_sets = array('starter', 'complete', 'pro');
    if (!in_array($set_id, $valid_sets)) {
        wp_send_json_error(array('message' => __('Ongeldige set', 'waxing-shop')));
    }

    // Validate main product
    $main_product = wc_get_product($product_id);
    if (!$main_product) {
        wp_send_json_error(array('message' => __('Set product niet gevonden', 'waxing-shop')));
    }

    if (!$main_product->is_in_stock()) {
        wp_send_json_error(array('message' => __('Set is uitverkocht', 'waxing-shop')));
    }

    // Validate required wax choices based on set type
    $required_choices = array(
        'starter'  => 1, // 1x 400g
        'complete' => 2, // 1x 400g + 1x 1kg
        'pro'      => 2, // 2x 1kg
    );

    $wax_choices = array_filter($wax_choices); // Remove empty values

    if (count($wax_choices) < $required_choices[$set_id]) {
        wp_send_json_error(array('message' => __('Selecteer alle wax opties', 'waxing-shop')));
    }

    // Validate each wax product
    $wax_products = array();
    foreach ($wax_choices as $wax_id) {
        $wax_product = wc_get_product($wax_id);
        if (!$wax_product) {
            wp_send_json_error(array('message' => __('Geselecteerde wax niet gevonden', 'waxing-shop')));
        }
        if (!$wax_product->is_in_stock()) {
            wp_send_json_error(array(
                'message' => sprintf(
                    /* translators: %s: product name */
                    __('%s is uitverkocht', 'waxing-shop'),
                    $wax_product->get_name()
                )
            ));
        }
        $wax_products[] = $wax_product;
    }

    // Add main set product to cart with wax selections as meta
    $wax_names = array_map(function($p) { return $p->get_name(); }, $wax_products);
    $cart_item_data = array(
        'waxing_set_type'   => $set_id,
        'waxing_wax_choices' => $wax_choices,
        'waxing_wax_names'   => $wax_names,
    );

    $added = WC()->cart->add_to_cart($product_id, 1, 0, array(), $cart_item_data);

    if (!$added) {
        wp_send_json_error(array('message' => __('Kon set niet toevoegen', 'waxing-shop')));
    }

    // Build success message
    $set_names = array(
        'starter'  => __('Starter Set', 'waxing-shop'),
        'complete' => __('Complete Set', 'waxing-shop'),
        'pro'      => __('Pro Set', 'waxing-shop'),
    );

    wp_send_json_success(array(
        'cart_count'   => WC()->cart->get_cart_contents_count(),
        'cart_total'   => WC()->cart->get_cart_total(),
        'product_name' => $set_names[$set_id],
        'wax_choices'  => $wax_names,
        'message'      => sprintf(
            /* translators: %s: set name */
            __('%s toegevoegd aan winkelmand', 'waxing-shop'),
            $set_names[$set_id]
        ),
    ));
}
add_action('wp_ajax_waxing_add_starter_set', 'waxing_ajax_add_starter_set');
add_action('wp_ajax_nopriv_waxing_add_starter_set', 'waxing_ajax_add_starter_set');

/**
 * Display wax choices in cart item
 */
function waxing_display_cart_item_wax_choices($item_data, $cart_item) {
    if (!empty($cart_item['waxing_wax_names'])) {
        foreach ($cart_item['waxing_wax_names'] as $index => $name) {
            $item_data[] = array(
                'key'   => sprintf(__('Wax keuze %d', 'waxing-shop'), $index + 1),
                'value' => $name,
            );
        }
    }
    return $item_data;
}
add_filter('woocommerce_get_item_data', 'waxing_display_cart_item_wax_choices', 10, 2);

/**
 * Save wax choices to order item meta
 */
function waxing_add_wax_choices_to_order_item($item, $cart_item_key, $values, $order) {
    if (!empty($values['waxing_wax_names'])) {
        $item->add_meta_data(__('Wax keuzes', 'waxing-shop'), implode(', ', $values['waxing_wax_names']));
    }
    if (!empty($values['waxing_set_type'])) {
        $item->add_meta_data('_set_type', $values['waxing_set_type']);
    }
    if (!empty($values['waxing_wax_choices'])) {
        $item->add_meta_data('_wax_product_ids', $values['waxing_wax_choices']);
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'waxing_add_wax_choices_to_order_item', 10, 4);
