<?php
/**
 * Helper Functions
 * 
 * @package Waxing_Shop
 * @since 3.1
 */

// =============================================
// PRODUCT HELPERS
// =============================================

/**
 * Get product color based on meta field or name
 * 
 * @param int $product_id Product ID
 * @return array Array of two color hex values [primary, secondary]
 */
function waxing_get_product_color($product_id) {
    $variant = get_post_meta($product_id, '_wax_color_variant', true);
    
    $colors = array(
        'rose'    => array('#F5E4E6', '#EDD5D8'),
        'gold'    => array('#F2E8D5', '#E5D9C4'),
        'sunset'  => array('#F7DFD0', '#EAD0BF'),
        'nacree'  => array('#F9F9F7', '#EEEEEB'),
        'default' => array('#F5F3F0', '#E8E4DF'),
    );
    
    if ($variant && isset($colors[$variant])) {
        return $colors[$variant];
    }
    
    // Fallback: detect from product name
    $name = strtolower(get_the_title($product_id));
    foreach (array('rose', 'gold', 'sunset', 'nacr') as $key) {
        if (strpos($name, $key) !== false) {
            $lookup = ($key === 'nacr') ? 'nacree' : $key;
            return $colors[$lookup];
        }
    }
    
    return $colors['default'];
}

/**
 * Get cart item count
 * 
 * @return int Cart count
 */
function waxing_cart_count() {
    return function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
}

/**
 * Get discount percentage for a product
 * 
 * @param WC_Product $product Product object
 * @return int Discount percentage
 */
function waxing_get_discount_percentage($product) {
    if (!$product->is_on_sale()) return 0;
    $regular = floatval($product->get_regular_price());
    $sale = floatval($product->get_sale_price());
    if ($regular <= 0) return 0;
    return round((($regular - $sale) / $regular) * 100);
}

/**
 * Get stock status
 * 
 * @param WC_Product $product Product object
 * @return string 'in', 'low', or 'out'
 */
function waxing_get_stock_status($product) {
    if (!$product->is_in_stock()) return 'out';
    $qty = $product->get_stock_quantity();
    if ($qty !== null && $qty <= 5) return 'low';
    return 'in';
}

// =============================================
// CONVERSION: URGENCY & SOCIAL PROOF
// =============================================

/**
 * Get delivery estimate based on current time
 * 
 * @return string Delivery estimate text
 */
function waxing_get_delivery_estimate() {
    $hour = (int) current_time('G');
    $day = (int) current_time('w');
    
    // Before 5pm on weekdays
    if ($hour < 17 && $day >= 1 && $day <= 5) {
        return __('morgen in huis', 'waxing-shop');
    }
    // Friday after 5pm or Saturday
    if (($day == 5 && $hour >= 17) || $day == 6) {
        return __('maandag in huis', 'waxing-shop');
    }
    // Sunday
    if ($day == 0) {
        return __('dinsdag in huis', 'waxing-shop');
    }
    return __('overmorgen in huis', 'waxing-shop');
}

/**
 * Get shipping deadline countdown
 * Returns time remaining until 17:00 cutoff
 * 
 * @return array|false Array with hours/minutes or false if past deadline
 */
function waxing_get_shipping_countdown() {
    $hour = (int) current_time('G');
    $minute = (int) current_time('i');
    $day = (int) current_time('w');
    
    // Only show on weekdays before 17:00
    if ($day >= 1 && $day <= 5 && $hour < 17) {
        $hours_left = 16 - $hour;
        $minutes_left = 60 - $minute;
        
        if ($minutes_left === 60) {
            $minutes_left = 0;
            $hours_left++;
        }
        
        return array(
            'hours'   => $hours_left,
            'minutes' => $minutes_left,
        );
    }
    
    return false;
}

/**
 * Get "live visitors" count
 *
 * WARNING: This function returns simulated data by default which can be
 * misleading to customers. It is disabled by default via WAXING_ENABLE_FAKE_SOCIAL_PROOF.
 *
 * @param int $product_id Product ID for consistency
 * @return int Number of "visitors" or 0 if disabled
 */
function waxing_get_live_visitors($product_id = 0) {
    // Return 0 if fake social proof is disabled (default)
    if (!defined('WAXING_ENABLE_FAKE_SOCIAL_PROOF') || !WAXING_ENABLE_FAKE_SOCIAL_PROOF) {
        return 0;
    }

    $hour = (int) current_time('G');

    // Base varies by time of day
    if ($hour >= 9 && $hour <= 12) {
        $base = 3; // Morning peak
    } elseif ($hour >= 19 && $hour <= 22) {
        $base = 5; // Evening peak
    } elseif ($hour >= 1 && $hour <= 6) {
        $base = 1; // Night low
    } else {
        $base = 2; // Normal
    }

    // Add some variation based on product_id for consistency
    $variation = $product_id ? ($product_id % 3) : rand(0, 2);

    return $base + $variation;
}

/**
 * Get recent sales info
 *
 * Returns total sales count. The 'hours_ago' field is simulated and only
 * returned if WAXING_ENABLE_FAKE_SOCIAL_PROOF is enabled.
 *
 * @param int $product_id Product ID
 * @return array|false Sales info or false
 */
function waxing_get_recent_sales($product_id) {
    $product = wc_get_product($product_id);
    if (!$product) return false;

    $total_sales = $product->get_total_sales();

    if ($total_sales > 0) {
        $data = array(
            'total' => $total_sales,
        );

        // Only add fake "hours ago" if explicitly enabled
        if (defined('WAXING_ENABLE_FAKE_SOCIAL_PROOF') && WAXING_ENABLE_FAKE_SOCIAL_PROOF) {
            $data['hours_ago'] = ($product_id % 12) + 1;
        }

        return $data;
    }

    return false;
}

// =============================================
// TRUST BAR
// =============================================

/**
 * Output trust bar
 */
function waxing_trust_bar() {
    $countdown = waxing_get_shipping_countdown();
    ?>
    <div class="trust-bar" role="banner" aria-label="<?php esc_attr_e('Voordelen', 'waxing-shop'); ?>">
        <div class="trust-bar-inner">
            <span class="trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                <?php esc_html_e('Gratis verzending vanaf €50', 'waxing-shop'); ?>
            </span>
            <span class="trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <?php if ($countdown) : ?>
                    <?php 
                    /* translators: %1$d: hours, %2$d: minutes */
                    printf(
                        esc_html__('Bestel binnen %1$d:%2$02d uur = morgen in huis', 'waxing-shop'),
                        $countdown['hours'],
                        $countdown['minutes']
                    ); 
                    ?>
                <?php else : ?>
                    <?php 
                    /* translators: %s: delivery estimate */
                    printf(esc_html__('Besteld = %s', 'waxing-shop'), waxing_get_delivery_estimate()); 
                    ?>
                <?php endif; ?>
            </span>
            <span class="trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3"/><polyline points="21 3 21 9 15 9"/></svg>
                <?php esc_html_e('30 dagen retourrecht', 'waxing-shop'); ?>
            </span>
            <span class="trust-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <?php esc_html_e('Veilig betalen', 'waxing-shop'); ?>
            </span>
        </div>
    </div>
    <?php
}

/**
 * Output product trust signals
 */
function waxing_product_trust_signals() {
    ?>
    <div class="product-trust" role="list" aria-label="<?php esc_attr_e('Product voordelen', 'waxing-shop'); ?>">
        <div class="trust-row" role="listitem">
            <span aria-hidden="true">✓</span> 
            <?php esc_html_e('Gratis verzending vanaf €50', 'waxing-shop'); ?>
        </div>
        <div class="trust-row" role="listitem">
            <span aria-hidden="true">✓</span> 
            <?php esc_html_e('30 dagen niet goed, geld terug', 'waxing-shop'); ?>
        </div>
        <div class="trust-row" role="listitem">
            <span aria-hidden="true">✓</span> 
            <?php esc_html_e('Veilig betalen met iDEAL, creditcard, PayPal', 'waxing-shop'); ?>
        </div>
        <div class="trust-row" role="listitem">
            <span aria-hidden="true">⭐</span> 
            <?php esc_html_e('9.0 gemiddelde beoordeling', 'waxing-shop'); ?>
        </div>
    </div>
    <?php
}

// =============================================
// CACHING
// =============================================

/**
 * Get bestsellers for mega-menu (cached)
 * 
 * @param int $count Number of products
 * @return array Products array
 */
function waxing_get_bestsellers($count = 3) {
    $cache_key = 'waxing_bestsellers_' . $count;
    $products = get_transient($cache_key);
    
    if ($products === false) {
        $query = new WP_Query(array(
            'post_type'      => 'product',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'meta_key'       => 'total_sales',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        ));
        
        $products = array();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());
                $colors = waxing_get_product_color(get_the_ID());
                $products[] = array(
                    'id'        => get_the_ID(),
                    'name'      => get_the_title(),
                    'price'     => $product ? $product->get_price_html() : '',
                    'permalink' => get_permalink(),
                    'image'     => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                    'color'     => $colors[0],
                );
            }
            wp_reset_postdata();
        }
        
        set_transient($cache_key, $products, HOUR_IN_SECONDS);
    }
    
    return $products;
}

/**
 * Clear bestsellers cache when product is updated
 * 
 * @param int $post_id Post ID
 */
function waxing_clear_bestsellers_cache($post_id) {
    if (get_post_type($post_id) === 'product') {
        delete_transient('waxing_bestsellers_3');
    }
}
add_action('save_post', 'waxing_clear_bestsellers_cache');

// =============================================
// QUIZ HELPERS
// =============================================

/**
 * Get quiz product recommendation based on answers
 * 
 * @param array $answers Quiz answers
 * @return array Product recommendation
 */
function waxing_get_quiz_recommendation($answers) {
    $products = array(
        'rose'   => array(
            'name'  => __('Rose Hotwax', 'waxing-shop'),
            'desc'  => __('Speciaal voor gevoelige huid met verzorgende ingrediënten.', 'waxing-shop'),
            'price' => '€24,95',
            'color' => '#F5E4E6',
        ),
        'gold'   => array(
            'name'  => __('Gold Hotwax', 'waxing-shop'),
            'desc'  => __('Perfecte all-rounder voor normaal haar en huid.', 'waxing-shop'),
            'price' => '€22,95',
            'color' => '#F2E8D5',
        ),
        'sunset' => array(
            'name'  => __('Sunset Hotwax', 'waxing-shop'),
            'desc'  => __('Krachtige formule voor sterk en dik haar.', 'waxing-shop'),
            'price' => '€26,95',
            'color' => '#F7DFD0',
        ),
        'nacree' => array(
            'name'  => __('Nacrée Hotwax', 'waxing-shop'),
            'desc'  => __('Universele wax geschikt voor alle huidtypes.', 'waxing-shop'),
            'price' => '€21,95',
            'color' => '#F9F9F7',
        ),
    );
    
    $skin = $answers['skin'] ?? 'normal';
    $hair = $answers['hair'] ?? 'medium';
    
    if ($skin === 'sensitive') return $products['rose'];
    if ($hair === 'coarse') return $products['sunset'];
    if ($skin === 'normal' && $hair === 'medium') return $products['gold'];
    return $products['nacree'];
}

/**
 * Get real product ID by name (for quiz)
 * 
 * @param string $name Product name to search
 * @return int Product ID or 0
 */
function waxing_get_product_id_by_name($name) {
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 1,
        's'              => $name,
        'fields'         => 'ids',
    );
    $products = get_posts($args);
    return !empty($products) ? $products[0] : 0;
}

// =============================================
// HEALTH CHECK & DIAGNOSTICS
// =============================================

/**
 * Theme health check endpoint
 * Register REST API endpoint for health checks (admin only)
 *
 * @since 5.8
 */
function waxing_register_health_endpoint() {
    register_rest_route('waxing/v1', '/health', array(
        'methods'  => 'GET',
        'callback' => 'waxing_health_check',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        },
    ));
}
add_action('rest_api_init', 'waxing_register_health_endpoint');

/**
 * Health check callback
 *
 * @since 5.8
 * @return WP_REST_Response
 */
function waxing_health_check() {
    $health = array(
        'status'    => 'ok',
        'version'   => defined('WAXING_VERSION') ? WAXING_VERSION : '5.8',
        'timestamp' => current_time('c'),
        'checks'    => array(
            'woocommerce' => class_exists('WooCommerce') ? 'active' : 'missing',
            'products'    => wp_count_posts('product')->publish ?? 0,
            'cache'       => get_transient('waxing_bestsellers_3') !== false ? 'warm' : 'cold',
        ),
    );

    return new WP_REST_Response($health, 200);
}

// =============================================
// STARTER SETS & PRODUCT ID HELPERS
// =============================================

/**
 * Get all configured product IDs from admin settings
 *
 * @return array All configured product IDs grouped by type
 */
function waxing_get_product_ids() {
    return array(
        'sets' => array(
            'starter'  => absint(get_option('waxing_starter_set_id', 0)),
            'complete' => absint(get_option('waxing_complete_set_id', 0)),
            'pro'      => absint(get_option('waxing_pro_set_id', 0)),
        ),
        'wax_400g' => array(
            'gold'       => absint(get_option('waxing_gold_400_id', 0)),
            'rose'       => absint(get_option('waxing_rose_400_id', 0)),
            'nacree'     => absint(get_option('waxing_nacree_400_id', 0)),
            'intimicire' => absint(get_option('waxing_intimicire_400_id', 0)),
        ),
        'wax_1kg' => array(
            'gold'       => absint(get_option('waxing_gold_1kg_id', 0)),
            'rose'       => absint(get_option('waxing_rose_1kg_id', 0)),
            'nacree'     => absint(get_option('waxing_nacree_1kg_id', 0)),
            'intimicire' => absint(get_option('waxing_intimicire_1kg_id', 0)),
            'sunset'     => absint(get_option('waxing_sunset_1kg_id', 0)),
            'rodo'       => absint(get_option('waxing_rodo_1kg_id', 0)),
            'vegan'      => absint(get_option('waxing_vegan_1kg_id', 0)),
        ),
        'accessories' => array(
            'warmer_single' => absint(get_option('waxing_warmer_single_id', 0)),
            'warmer_double' => absint(get_option('waxing_warmer_double_id', 0)),
            'spatels_50'    => absint(get_option('waxing_spatels_50_id', 0)),
            'spatels_100'   => absint(get_option('waxing_spatels_100_id', 0)),
            'pre_lotion'    => absint(get_option('waxing_pre_lotion_id', 0)),
            'after_lotion'  => absint(get_option('waxing_after_lotion_id', 0)),
        ),
    );
}

/**
 * Get wax options for dropdown selection
 *
 * @param string $size '400g' or '1kg'
 * @return array Product options with id, name, price
 */
function waxing_get_wax_options($size = '400g') {
    $ids = waxing_get_product_ids();
    $key = 'wax_' . $size;
    $options = array();

    if (!isset($ids[$key])) {
        return $options;
    }

    foreach ($ids[$key] as $variant => $product_id) {
        if (!$product_id) continue;

        $product = wc_get_product($product_id);
        if (!$product) continue;

        $options[] = array(
            'id'      => $product_id,
            'slug'    => $variant,
            'name'    => $product->get_name(),
            'price'   => $product->get_price(),
            'display' => ucfirst($variant) . ' ' . $size,
        );
    }

    return $options;
}

/**
 * Get starter set data with WooCommerce product info
 *
 * @param string $set_type 'starter', 'complete', or 'pro'
 * @return array|false Set data or false if not configured
 */
function waxing_get_starter_set($set_type) {
    $ids = waxing_get_product_ids();

    if (!isset($ids['sets'][$set_type]) || !$ids['sets'][$set_type]) {
        return false;
    }

    $product_id = $ids['sets'][$set_type];
    $product = wc_get_product($product_id);

    if (!$product) {
        return false;
    }

    return array(
        'id'            => $product_id,
        'name'          => $product->get_name(),
        'price'         => $product->get_price(),
        'regular_price' => $product->get_regular_price(),
        'sale_price'    => $product->get_sale_price(),
        'description'   => $product->get_short_description(),
        'in_stock'      => $product->is_in_stock(),
    );
}
