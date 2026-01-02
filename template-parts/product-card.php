<?php
/**
 * Product Card Template Part
 *
 * @package Waxing_Shop
 * @since 5.8
 *
 * @param array $args {
 *     @type bool   $featured     Whether this is a featured card (larger size)
 *     @type bool   $show_viewers Whether to show live viewers count
 * }
 */

defined('ABSPATH') || exit;

global $product;

if (!$product || !is_a($product, 'WC_Product')) {
    return;
}

$product_id = $product->get_id();
$colors = waxing_get_product_color($product_id);

// Template args
$featured = isset($args['featured']) ? $args['featured'] : false;
$show_viewers = isset($args['show_viewers']) ? $args['show_viewers'] : false;

// Get wishlist status
$wishlist = isset($_COOKIE['waxing_wishlist']) ? json_decode(stripslashes($_COOKIE['waxing_wishlist']), true) : array();
$in_wishlist = is_array($wishlist) && in_array($product_id, $wishlist);
?>
<article class="product-card <?php echo $featured ? 'featured' : ''; ?>" data-product-id="<?php echo esc_attr($product_id); ?>" role="listitem">
    <!-- Full card link overlay -->
    <a href="<?php echo esc_url(get_permalink($product_id)); ?>" class="product-card-link" aria-label="<?php echo esc_attr($product->get_name()); ?>"></a>

    <div class="product-card-image">
        <?php if (has_post_thumbnail($product_id)) : ?>
            <?php echo get_the_post_thumbnail($product_id, 'product-card', array(
                'loading' => 'lazy',
                'sizes'   => '(max-width: 768px) 100vw, 400px',
            )); ?>
        <?php else : ?>
            <div class="product-card-image-bg" style="background: linear-gradient(135deg, <?php echo esc_attr($colors[0]); ?>, <?php echo esc_attr($colors[1]); ?>);"></div>
            <div class="pellets-placeholder" aria-hidden="true">
                <div class="pellets-grid">
                    <?php for ($i = 0; $i < 12; $i++) : ?><div class="pellet"></div><?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($product->is_on_sale()) : ?>
            <span class="product-badge badge-sale">-<?php echo esc_html(waxing_get_discount_percentage($product)); ?>%</span>
        <?php elseif ($product->is_featured()) : ?>
            <span class="product-badge badge-bestseller"><?php esc_html_e('Bestseller', 'waxing-shop'); ?></span>
        <?php endif; ?>

        <button
            class="product-wishlist<?php echo $in_wishlist ? ' active' : ''; ?>"
            aria-label="<?php echo $in_wishlist ? esc_attr__('Verwijderen uit favorieten', 'waxing-shop') : esc_attr__('Toevoegen aan favorieten', 'waxing-shop'); ?>"
            aria-pressed="<?php echo $in_wishlist ? 'true' : 'false'; ?>"
            data-product-id="<?php echo esc_attr($product_id); ?>"
        ><?php echo $in_wishlist ? '&hearts;' : '&hearts;'; ?></button>

        <div class="product-actions">
            <button class="btn-quick-view" data-product-id="<?php echo esc_attr($product_id); ?>">
                <?php esc_html_e('Quick View', 'waxing-shop'); ?>
            </button>
            <button class="btn-add-cart" data-product-id="<?php echo esc_attr($product_id); ?>">
                + <?php esc_html_e('Toevoegen', 'waxing-shop'); ?>
            </button>
        </div>
    </div>

    <div class="product-card-info">
        <p class="product-card-category"><?php echo wp_kses_post(wc_get_product_category_list($product_id, ' &bull; ')); ?></p>
        <h3 class="product-card-name"><?php echo esc_html($product->get_name()); ?></h3>

        <?php
        // Stock status
        $stock_status = waxing_get_stock_status($product);
        if ($stock_status === 'low') :
        ?>
            <p class="product-card-stock low">
                <span aria-hidden="true">!</span>
                <?php
                /* translators: %d: stock quantity */
                printf(esc_html__('Nog %d op voorraad', 'waxing-shop'), $product->get_stock_quantity());
                ?>
            </p>
        <?php endif; ?>

        <div class="product-card-footer">
            <span class="product-card-price">
                <?php if ($product->is_on_sale()) : ?>
                    <span class="product-card-price-old">
                        <span class="sr-only"><?php esc_html_e('Was', 'waxing-shop'); ?></span>
                        <?php echo wc_price($product->get_regular_price()); ?>
                    </span>
                <?php endif; ?>
                <?php echo wc_price($product->get_price()); ?>
            </span>
            <?php
            $review_count = $product->get_review_count();
            if ($review_count > 0) :
            ?>
            <div class="product-card-rating">
                <span class="stars" aria-hidden="true">*****</span>
                <span class="count">(<?php echo esc_html($review_count); ?>)</span>
                <span class="sr-only">
                    <?php
                    /* translators: %d: number of reviews */
                    printf(esc_html__('%d beoordelingen', 'waxing-shop'), $review_count);
                    ?>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</article>
