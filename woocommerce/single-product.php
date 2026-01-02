<?php
/**
 * Single Product Template
 * 
 * Enhanced product page with trust signals and conversion optimization
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

while (have_posts()) :
    the_post();
    
    global $product;
    
    // Get product data
    $product_id = $product->get_id();
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    $stock_status = $product->get_stock_status();
    $stock_quantity = $product->get_stock_quantity();
    
    // Calculate savings
    $savings_percent = 0;
    if ($sale_price && $regular_price) {
        $savings_percent = round((($regular_price - $sale_price) / $regular_price) * 100);
    }
    
    // Get product categories
    $categories = get_the_terms($product_id, 'product_cat');
    $primary_cat = !empty($categories) ? $categories[0] : null;
?>

<main id="primary" class="single-product-page" itemscope itemtype="https://schema.org/Product">
    
    <div class="container">
        
        <!-- Breadcrumb -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="<?php echo home_url(); ?>"><span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1" />
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="<?php echo wc_get_page_permalink('shop'); ?>"><span itemprop="name">Shop</span></a>
                    <meta itemprop="position" content="2" />
                </li>
                <?php if ($primary_cat) : ?>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="<?php echo get_term_link($primary_cat); ?>">
                        <span itemprop="name"><?php echo esc_html($primary_cat->name); ?></span>
                    </a>
                    <meta itemprop="position" content="3" />
                </li>
                <?php endif; ?>
            </ol>
        </nav>
        
        <!-- Product Main -->
        <div class="product-main">
            
            <!-- Product Gallery -->
            <div class="product-gallery">
                <?php if ($sale_price) : ?>
                <span class="sale-badge">-<?php echo $savings_percent; ?>%</span>
                <?php endif; ?>
                
                <div class="gallery-main">
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    $main_image_id = $product->get_image_id();
                    
                    if ($main_image_id) :
                        $main_image = wp_get_attachment_image_src($main_image_id, 'large');
                    ?>
                    <img src="<?php echo esc_url($main_image[0]); ?>" 
                         alt="<?php echo esc_attr(get_the_title()); ?>"
                         id="main-product-image"
                         itemprop="image">
                    <?php else : ?>
                    <img src="<?php echo wc_placeholder_img_src('large'); ?>" alt="Placeholder">
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($attachment_ids)) : ?>
                <div class="gallery-thumbs">
                    <?php if ($main_image_id) : ?>
                    <button class="thumb-btn active" data-image="<?php echo esc_url($main_image[0]); ?>">
                        <?php echo wp_get_attachment_image($main_image_id, 'thumbnail'); ?>
                    </button>
                    <?php endif; ?>
                    
                    <?php foreach ($attachment_ids as $attachment_id) : 
                        $thumb_image = wp_get_attachment_image_src($attachment_id, 'large');
                    ?>
                    <button class="thumb-btn" data-image="<?php echo esc_url($thumb_image[0]); ?>">
                        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Product Info -->
            <div class="product-info">
                
                <?php if ($primary_cat) : ?>
                <a href="<?php echo get_term_link($primary_cat); ?>" class="product-category-link">
                    <?php echo esc_html($primary_cat->name); ?>
                </a>
                <?php endif; ?>
                
                <h1 class="product-title" itemprop="name"><?php the_title(); ?></h1>
                
                <!-- Rating -->
                <?php if ($product->get_average_rating()) : 
                    $rating = $product->get_average_rating();
                    $review_count = $product->get_review_count();
                ?>
                <div class="product-rating" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                    <div class="stars" aria-label="<?php echo $rating; ?> van 5 sterren">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="<?php echo $i <= round($rating) ? 'currentColor' : 'none'; ?>" stroke="currentColor" stroke-width="2">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
                        </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="rating-text">
                        <span itemprop="ratingValue"><?php echo number_format($rating, 1); ?></span>
                        (<span itemprop="reviewCount"><?php echo $review_count; ?></span> reviews)
                    </span>
                </div>
                <?php endif; ?>
                
                <!-- Short Description -->
                <?php if ($product->get_short_description()) : ?>
                <div class="product-short-description" itemprop="description">
                    <?php echo wpautop($product->get_short_description()); ?>
                </div>
                <?php endif; ?>
                
                <!-- Price -->
                <div class="product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                    <meta itemprop="priceCurrency" content="EUR" />
                    <?php if ($sale_price) : ?>
                    <span class="price-old"><?php echo wc_price($regular_price); ?></span>
                    <span class="price-current" itemprop="price" content="<?php echo $sale_price; ?>">
                        <?php echo wc_price($sale_price); ?>
                    </span>
                    <span class="savings-badge">Bespaar <?php echo $savings_percent; ?>%</span>
                    <?php else : ?>
                    <span class="price-current" itemprop="price" content="<?php echo $regular_price; ?>">
                        <?php echo $product->get_price_html(); ?>
                    </span>
                    <?php endif; ?>
                    
                    <link itemprop="availability" href="https://schema.org/<?php echo $stock_status === 'instock' ? 'InStock' : 'OutOfStock'; ?>" />
                </div>
                
                <!-- Stock Status -->
                <div class="stock-indicator <?php echo $stock_status; ?>">
                    <span class="stock-dot"></span>
                    <?php if ($stock_status === 'instock') : ?>
                        <?php if ($stock_quantity && $stock_quantity <= 5) : ?>
                        <span class="stock-text low">Nog maar <?php echo $stock_quantity; ?> op voorraad</span>
                        <?php else : ?>
                        <span class="stock-text">Op voorraad</span>
                        <?php endif; ?>
                    <?php elseif ($stock_status === 'outofstock') : ?>
                        <span class="stock-text out">Uitverkocht</span>
                    <?php else : ?>
                        <span class="stock-text">Op bestelling</span>
                    <?php endif; ?>
                </div>
                
                <!-- Delivery Estimate -->
                <div class="delivery-estimate">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <?php
                    $now = new DateTime('now', new DateTimeZone('Europe/Amsterdam'));
                    $hour = (int) $now->format('H');
                    
                    if ($hour < 14) {
                        $delivery = 'Bestel voor 14:00, morgen in huis';
                    } else {
                        $now->modify('+2 days');
                        $delivery = 'Verwacht op ' . $now->format('l j F');
                    }
                    ?>
                    <span><?php echo $delivery; ?></span>
                </div>
                
                <!-- Add to Cart -->
                <div class="product-add-to-cart">
                    <?php if ($stock_status !== 'outofstock') : ?>
                    <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                        
                        <?php do_action('woocommerce_before_add_to_cart_button'); ?>
                        
                        <div class="quantity-wrapper">
                            <label for="quantity" class="sr-only">Aantal</label>
                            <button type="button" class="qty-btn qty-minus" aria-label="Verminder aantal">−</button>
                            <input type="number" id="quantity" class="qty-input" name="quantity" value="1" min="1" max="<?php echo $stock_quantity ?: 99; ?>">
                            <button type="button" class="qty-btn qty-plus" aria-label="Verhoog aantal">+</button>
                        </div>
                        
                        <button type="submit" name="add-to-cart" value="<?php echo $product_id; ?>" class="btn btn-sage btn-lg add-to-cart-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1,1 L5,1 L7.68,14.39 C7.77,14.83 8.14,15.15 8.59,15.17 L19.4,15.97 C19.84,16 20.24,15.71 20.36,15.29 L22.36,8.29 C22.52,7.73 22.09,7.17 21.51,7.17 L6,7.17"></path>
                            </svg>
                            In winkelwagen
                        </button>
                        
                        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
                        
                    </form>
                    <?php else : ?>
                    <button class="btn btn-secondary btn-lg" disabled>Uitverkocht</button>
                    <?php endif; ?>
                </div>
                
                <!-- Trust Signals -->
                <div class="product-trust-signals">
                    <div class="trust-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                        <span>Gratis verzending vanaf €50</span>
                    </div>
                    <div class="trust-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 Z"></path>
                            <polyline points="9,12 12,15 16,10"></polyline>
                        </svg>
                        <span>14 dagen bedenktijd</span>
                    </div>
                    <div class="trust-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7,11 L7,7 C7,4.24 9.24,2 12,2 C14.76,2 17,4.24 17,7 L17,11"></path>
                        </svg>
                        <span>Veilig betalen met iDEAL</span>
                    </div>
                </div>
                
                <!-- Product Meta -->
                <div class="product-meta">
                    <?php if ($product->get_sku()) : ?>
                    <div class="meta-item">
                        <span class="meta-label">Artikelnr:</span>
                        <span class="meta-value" itemprop="sku"><?php echo esc_html($product->get_sku()); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($categories && !is_wp_error($categories)) : ?>
                    <div class="meta-item">
                        <span class="meta-label">Categorie:</span>
                        <span class="meta-value">
                            <?php foreach ($categories as $i => $cat) : ?>
                            <a href="<?php echo get_term_link($cat); ?>"><?php echo esc_html($cat->name); ?></a><?php echo $i < count($categories) - 1 ? ', ' : ''; ?>
                            <?php endforeach; ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
                
            </div>
            
        </div>
        
        <!-- Product Tabs -->
        <div class="product-tabs">
            <div class="tabs-nav" role="tablist">
                <button class="tab-btn active" role="tab" aria-selected="true" aria-controls="tab-description" id="btn-description">
                    Beschrijving
                </button>
                <?php if ($product->has_attributes()) : ?>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="tab-specs" id="btn-specs">
                    Specificaties
                </button>
                <?php endif; ?>
                <?php if ($product->get_review_count() > 0) : ?>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="tab-reviews" id="btn-reviews">
                    Reviews (<?php echo $product->get_review_count(); ?>)
                </button>
                <?php endif; ?>
                <button class="tab-btn" role="tab" aria-selected="false" aria-controls="tab-faq" id="btn-faq">
                    Veelgestelde vragen
                </button>
            </div>
            
            <div class="tabs-content">
                <!-- Description Tab -->
                <div class="tab-panel active" role="tabpanel" id="tab-description" aria-labelledby="btn-description">
                    <div class="tab-content-inner">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <!-- Specifications Tab -->
                <?php if ($product->has_attributes()) : ?>
                <div class="tab-panel" role="tabpanel" id="tab-specs" aria-labelledby="btn-specs" hidden>
                    <div class="tab-content-inner">
                        <table class="specs-table">
                            <tbody>
                            <?php foreach ($product->get_attributes() as $attribute) : ?>
                                <tr>
                                    <th><?php echo wc_attribute_label($attribute->get_name()); ?></th>
                                    <td>
                                        <?php
                                        $values = array();
                                        if ($attribute->is_taxonomy()) {
                                            $terms = wc_get_product_terms($product_id, $attribute->get_name(), array('fields' => 'names'));
                                            $values = $terms;
                                        } else {
                                            $values = $attribute->get_options();
                                        }
                                        echo implode(', ', $values);
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Reviews Tab -->
                <?php if ($product->get_review_count() > 0) : ?>
                <div class="tab-panel" role="tabpanel" id="tab-reviews" aria-labelledby="btn-reviews" hidden>
                    <div class="tab-content-inner">
                        <?php comments_template(); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- FAQ Tab -->
                <div class="tab-panel" role="tabpanel" id="tab-faq" aria-labelledby="btn-faq" hidden>
                    <div class="tab-content-inner">
                        <div class="faq-list">
                            <div class="faq-item">
                                <button class="faq-question" aria-expanded="false">
                                    <span>Hoe lang gaat dit product mee?</span>
                                    <span class="faq-icon">+</span>
                                </button>
                                <div class="faq-answer">
                                    <p>De houdbaarheid van dit product is minimaal 24 maanden na aankoop. Bewaar het op een koele, droge plek.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <button class="faq-question" aria-expanded="false">
                                    <span>Is dit product geschikt voor gevoelige huid?</span>
                                    <span class="faq-icon">+</span>
                                </button>
                                <div class="faq-answer">
                                    <p>Ja, al onze producten zijn dermatologisch getest en geschikt voor gevoelige huid. Test altijd eerst op een klein stukje huid.</p>
                                </div>
                            </div>
                            <div class="faq-item">
                                <button class="faq-question" aria-expanded="false">
                                    <span>Hoe warm moet de wax zijn?</span>
                                    <span class="faq-icon">+</span>
                                </button>
                                <div class="faq-answer">
                                    <p>De ideale temperatuur is 40-45°C. Test altijd eerst op de binnenkant van je pols voordat je de wax aanbrengt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <!-- Related Products -->
    <?php
    $related_ids = wc_get_related_products($product_id, 4);
    if ($related_ids) :
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 4,
            'post__in' => $related_ids,
            'orderby' => 'post__in'
        );
        $related_query = new WP_Query($args);

        if ($related_query->have_posts()) :
    ?>
    <section class="related-products">
        <div class="related-header">
            <h3><?php esc_html_e('Anderen bekeken ook', 'waxing-shop'); ?></h3>
        </div>

        <div class="related-grid">
            <?php while ($related_query->have_posts()) : $related_query->the_post();
                $rel_product = wc_get_product(get_the_ID());
            ?>
            <a href="<?php the_permalink(); ?>" class="related-item">
                <div class="related-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                    <?php endif; ?>
                </div>
                <div class="related-info">
                    <p class="related-title"><?php the_title(); ?></p>
                    <p class="related-price"><?php echo $rel_product->get_price_html(); ?></p>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php
        endif;
    endif;
    ?>
    
</main>

<script>
// Gallery thumbnails
document.querySelectorAll('.thumb-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('main-product-image').src = this.dataset.image;
    });
});

// Quantity buttons
document.querySelectorAll('.qty-minus').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.qty-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });
});

document.querySelectorAll('.qty-plus').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('.qty-input');
        const max = parseInt(input.max) || 99;
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
        }
    });
});

// Tabs
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active');
            b.setAttribute('aria-selected', 'false');
        });
        document.querySelectorAll('.tab-panel').forEach(p => {
            p.classList.remove('active');
            p.hidden = true;
        });
        
        this.classList.add('active');
        this.setAttribute('aria-selected', 'true');
        const panel = document.getElementById(this.getAttribute('aria-controls'));
        panel.classList.add('active');
        panel.hidden = false;
    });
});

// FAQ accordion
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', function() {
        const expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !expanded);
        this.nextElementSibling.classList.toggle('active');
        this.querySelector('.faq-icon').textContent = expanded ? '+' : '−';
    });
});
</script>

<?php
endwhile;
get_footer('shop');
?>
