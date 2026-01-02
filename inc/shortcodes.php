<?php
/**
 * Shortcodes
 * 
 * @package Waxing_Shop
 * @since 3.1
 */

// =============================================
// STARTER SETS
// =============================================

/**
 * Starter Sets Shortcode
 * Displays the three product sets with wax selection and WooCommerce integration
 */
function waxing_starter_sets_shortcode() {
    // Get wax options from admin settings
    $wax_400g = waxing_get_wax_options('400g');
    $wax_1kg = waxing_get_wax_options('1kg');

    // Set configurations with wax choices
    $sets = array(
        'starter' => array(
            'name'       => __('Starter Set', 'waxing-shop'),
            'tagline'    => __('Perfect om te beginnen', 'waxing-shop'),
            'badge'      => __('Populair', 'waxing-shop'),
            'color'      => '#E8E2D9',
            'featured'   => false,
            'items'      => array(
                __('Harsverwarmer 400ml', 'waxing-shop'),
                __('400g Hotwax naar keuze', 'waxing-shop'),
                __('50 spatels', 'waxing-shop'),
                __('Handleiding', 'waxing-shop'),
            ),
            'highlights' => array(
                __('✓ Inclusief handleiding', 'waxing-shop'),
            ),
            'wax_choices' => array(
                array('size' => '400g', 'label' => __('Kies je wax (400g)', 'waxing-shop')),
            ),
        ),
        'complete' => array(
            'name'       => __('Complete Set', 'waxing-shop'),
            'tagline'    => __('Onze bestseller', 'waxing-shop'),
            'badge'      => __('Meest gekozen', 'waxing-shop'),
            'color'      => '#D4CFC6',
            'featured'   => true,
            'items'      => array(
                __('Harsverwarmer Pro 800ml', 'waxing-shop'),
                __('400g + 1kg Hotwax naar keuze', 'waxing-shop'),
                __('100 spatels', 'waxing-shop'),
                __('Pre & after lotion', 'waxing-shop'),
                __('Handleiding', 'waxing-shop'),
            ),
            'highlights' => array(
                __('✓ Inclusief handleiding', 'waxing-shop'),
                __('✓ Gratis video tutorials', 'waxing-shop'),
            ),
            'wax_choices' => array(
                array('size' => '400g', 'label' => __('Kies je wax #1 (400g)', 'waxing-shop')),
                array('size' => '1kg', 'label' => __('Kies je wax #2 (1kg)', 'waxing-shop')),
            ),
        ),
        'pro' => array(
            'name'       => __('Pro Set', 'waxing-shop'),
            'tagline'    => __('Salonkwaliteit thuis', 'waxing-shop'),
            'badge'      => __('Beste waarde', 'waxing-shop'),
            'color'      => '#C4BDB3',
            'featured'   => false,
            'items'      => array(
                __('Dubbele verwarmer 2x800ml', 'waxing-shop'),
                __('2x 1kg Hotwax naar keuze', 'waxing-shop'),
                __('200 spatels', 'waxing-shop'),
                __('Complete verzorgingsset', 'waxing-shop'),
                __('Video training', 'waxing-shop'),
            ),
            'highlights' => array(
                __('✓ Inclusief handleiding', 'waxing-shop'),
                __('✓ Gratis video tutorials', 'waxing-shop'),
                __('✓ Persoonlijk advies', 'waxing-shop'),
            ),
            'wax_choices' => array(
                array('size' => '1kg', 'label' => __('Kies je wax #1 (1kg)', 'waxing-shop')),
                array('size' => '1kg', 'label' => __('Kies je wax #2 (1kg)', 'waxing-shop')),
            ),
        ),
    );

    // Get WooCommerce data for each set
    foreach (array_keys($sets) as $set_key) {
        $set_data = waxing_get_starter_set($set_key);
        if ($set_data) {
            $sets[$set_key]['product_id'] = $set_data['id'];
            $sets[$set_key]['price'] = floatval($set_data['price']);
            $sets[$set_key]['regular_price'] = floatval($set_data['regular_price']);
            $sets[$set_key]['in_stock'] = $set_data['in_stock'];
            // Calculate savings percentage
            if ($set_data['regular_price'] > 0) {
                $sets[$set_key]['save'] = round((($set_data['regular_price'] - $set_data['price']) / $set_data['regular_price']) * 100);
            } else {
                $sets[$set_key]['save'] = 0;
            }
        } else {
            // Fallback values if not configured
            $sets[$set_key]['product_id'] = 0;
            $sets[$set_key]['price'] = 0;
            $sets[$set_key]['regular_price'] = 0;
            $sets[$set_key]['in_stock'] = false;
            $sets[$set_key]['save'] = 0;
        }
    }

    ob_start(); ?>
    <div class="sets-grid" role="list">
        <?php foreach ($sets as $set_id => $set) : ?>
        <article class="set-card <?php echo $set['featured'] ? 'featured' : ''; ?>" role="listitem" data-set-id="<?php echo esc_attr($set_id); ?>">
            <?php if ($set['featured']) : ?>
            <span class="set-recommended"><?php esc_html_e('Aanbevolen', 'waxing-shop'); ?></span>
            <?php endif; ?>
            <span class="set-badge"><?php echo esc_html($set['badge']); ?></span>
            <div class="set-visual" style="background:<?php echo esc_attr($set['color']); ?>">
                <div class="set-pellets" aria-hidden="true">
                    <?php for ($i = 0; $i < 12; $i++) : ?>
                    <div class="set-pellet" style="background:rgba(255,255,255,<?php echo 0.4 + ($i % 3) * 0.2; ?>)"></div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="set-content">
                <p class="set-tagline"><?php echo esc_html($set['tagline']); ?></p>
                <h3 class="set-title"><?php echo esc_html($set['name']); ?></h3>
                <ul class="set-includes" aria-label="<?php esc_attr_e('Inhoud van de set', 'waxing-shop'); ?>">
                    <?php foreach ($set['items'] as $item) : ?>
                    <li><span class="check" aria-hidden="true">✓</span> <?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php if (!empty($set['highlights'])) : ?>
                <div class="set-highlights">
                    <?php foreach ($set['highlights'] as $highlight) : ?>
                    <span class="set-highlight"><?php echo esc_html($highlight); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Wax Selection Dropdowns -->
                <div class="set-wax-selection">
                    <?php foreach ($set['wax_choices'] as $index => $choice) :
                        $options = $choice['size'] === '400g' ? $wax_400g : $wax_1kg;
                    ?>
                    <div class="wax-select-group">
                        <label for="wax-<?php echo esc_attr($set_id . '-' . $index); ?>"><?php echo esc_html($choice['label']); ?></label>
                        <select id="wax-<?php echo esc_attr($set_id . '-' . $index); ?>"
                                name="wax_choice_<?php echo $index; ?>"
                                class="wax-select"
                                data-size="<?php echo esc_attr($choice['size']); ?>"
                                required>
                            <option value=""><?php esc_html_e('-- Selecteer --', 'waxing-shop'); ?></option>
                            <?php foreach ($options as $opt) : ?>
                            <option value="<?php echo esc_attr($opt['id']); ?>" data-price="<?php echo esc_attr($opt['price']); ?>">
                                <?php echo esc_html($opt['display']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="set-footer">
                    <div class="set-price">
                        <?php if ($set['regular_price'] > $set['price'] && $set['regular_price'] > 0) : ?>
                        <span class="price-old">
                            <span class="sr-only"><?php esc_html_e('Was', 'waxing-shop'); ?></span>
                            €<?php echo number_format($set['regular_price'], 2, ',', '.'); ?>
                        </span>
                        <?php endif; ?>
                        <span class="price-current" data-base-price="<?php echo esc_attr($set['price']); ?>">
                            <?php if ($set['price'] > 0) : ?>
                                €<?php echo number_format($set['price'], 2, ',', '.'); ?>
                            <?php else : ?>
                                <?php esc_html_e('Prijs niet beschikbaar', 'waxing-shop'); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if ($set['save'] > 0) : ?>
                    <span class="set-savings">
                        <?php
                        /* translators: %d: discount percentage */
                        printf(esc_html__('Bespaar %d%%', 'waxing-shop'), $set['save']);
                        ?>
                    </span>
                    <?php endif; ?>
                </div>

                <?php if ($set['product_id'] && $set['in_stock']) : ?>
                <button class="btn <?php echo $set['featured'] ? 'btn-sage' : 'btn-primary'; ?> btn-block set-add-to-cart"
                        data-set-id="<?php echo esc_attr($set_id); ?>"
                        data-product-id="<?php echo esc_attr($set['product_id']); ?>"
                        data-set-name="<?php echo esc_attr($set['name']); ?>"
                        style="margin-top:16px">
                    <span class="btn-text"><?php esc_html_e('In Winkelwagen', 'waxing-shop'); ?></span>
                    <span class="btn-loading" style="display:none;">
                        <svg class="spinner" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" stroke-dasharray="60" stroke-dashoffset="20"/>
                        </svg>
                        <?php esc_html_e('Toevoegen...', 'waxing-shop'); ?>
                    </span>
                </button>
                <?php elseif ($set['product_id'] && !$set['in_stock']) : ?>
                <button class="btn btn-secondary btn-block" disabled style="margin-top:16px">
                    <?php esc_html_e('Uitverkocht', 'waxing-shop'); ?>
                </button>
                <?php else : ?>
                <button class="btn btn-secondary btn-block" disabled style="margin-top:16px">
                    <?php esc_html_e('Niet beschikbaar', 'waxing-shop'); ?>
                </button>
                <?php endif; ?>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <!-- Custom Set Builder Option -->
    <div class="custom-set-option reveal" style="text-align:center;margin-top:40px;padding:32px;background:var(--cream);border-radius:16px;">
        <p class="custom-set-text" style="font-size:16px;color:var(--dark-soft);margin-bottom:16px;">
            <?php esc_html_e('Of stel je eigen set samen met precies wat jij nodig hebt', 'waxing-shop'); ?>
        </p>
        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;">
                <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
            </svg>
            <?php esc_html_e('Bekijk alle producten', 'waxing-shop'); ?>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('starter_sets', 'waxing_starter_sets_shortcode');

// =============================================
// PRODUCTS GRID
// =============================================

/**
 * Products Grid Shortcode
 * 
 * @param array $atts Shortcode attributes
 */
function waxing_products_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count'          => 4,
        'category'       => '',
        'featured_first' => true,
    ), $atts);
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $atts['count'],
        'post_status'    => 'publish',
    );
    
    if ($atts['category']) {
        $args['tax_query'] = array(array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $atts['category'],
        ));
    }
    
    $products = new WP_Query($args);
    
    if (!$products->have_posts()) {
        return '<p>' . esc_html__('Geen producten gevonden.', 'waxing-shop') . '</p>';
    }
    
    $first = $atts['featured_first'];
    ob_start(); ?>
    <div class="products-grid" role="list">
        <?php while ($products->have_posts()) : $products->the_post(); 
            global $product;
            $colors = waxing_get_product_color(get_the_ID());
            $featured = $first ? 'featured' : '';
            $first = false;
            $live_visitors = waxing_get_live_visitors(get_the_ID());
        ?>
        <article class="product-card <?php echo $featured; ?>" data-product-id="<?php echo get_the_ID(); ?>" role="listitem">
            <div class="product-card-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('product-card', array(
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
                
                <button class="product-wishlist" aria-label="<?php esc_attr_e('Toevoegen aan favorieten', 'waxing-shop'); ?>" aria-pressed="false">♡</button>
                
                <div class="product-actions">
                    <button class="btn-quick-view" data-product-id="<?php echo get_the_ID(); ?>">
                        <?php esc_html_e('Quick View', 'waxing-shop'); ?>
                    </button>
                    <button class="btn-add-cart" data-product-id="<?php echo get_the_ID(); ?>">
                        + <?php esc_html_e('Toevoegen', 'waxing-shop'); ?>
                    </button>
                </div>
            </div>
            
            <a href="<?php the_permalink(); ?>" class="product-card-info">
                <p class="product-card-category"><?php echo wp_kses_post(wc_get_product_category_list(get_the_ID(), ' • ')); ?></p>
                <h3 class="product-card-name"><?php the_title(); ?></h3>
                
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
                    <?php $review_count = $product->get_review_count(); if ($review_count > 0) : ?>
                    <div class="product-card-rating">
                        <span class="stars" aria-hidden="true">★★★★★</span>
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
            </a>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('waxing_products', 'waxing_products_shortcode');

// =============================================
// TESTIMONIALS
// =============================================

/**
 * Testimonials Shortcode
 */
function waxing_testimonials_shortcode() {
    $testimonials = array(
        array(
            'text'   => __('Beste wax die ik ooit heb gebruikt. Breekt niet en pakt elk haartje mee. Resultaat houdt weken aan!', 'waxing-shop'),
            'author' => 'Lucy D.',
            'role'   => __('Salon eigenaar', 'waxing-shop'),
        ),
        array(
            'text'   => __('Eindelijk een wax die werkt op korte haartjes. De Rose variant is super zacht voor mijn gevoelige huid.', 'waxing-shop'),
            'author' => 'Wendy B.',
            'role'   => __('Klant sinds 2023', 'waxing-shop'),
        ),
        array(
            'text'   => __('Snelle levering, top kwaliteit. De Complete Set is echt alles wat je nodig hebt om te beginnen.', 'waxing-shop'),
            'author' => 'Janine R.',
            'role'   => __('Schoonheidsspecialist', 'waxing-shop'),
        ),
    );
    
    ob_start(); ?>
    <div class="reviews-grid" role="list" aria-label="<?php esc_attr_e('Klant ervaringen', 'waxing-shop'); ?>">
        <?php foreach ($testimonials as $t) : ?>
        <blockquote class="review-card" role="listitem">
            <div class="review-stars" aria-label="<?php esc_attr_e('5 van 5 sterren', 'waxing-shop'); ?>">★★★★★</div>
            <p class="review-text">"<?php echo esc_html($t['text']); ?>"</p>
            <footer>
                <cite class="review-author"><?php echo esc_html($t['author']); ?></cite>
                <p class="review-role"><?php echo esc_html($t['role']); ?></p>
            </footer>
        </blockquote>
        <?php endforeach; ?>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('reviews', 'waxing_testimonials_shortcode');
add_shortcode('testimonials', 'waxing_testimonials_shortcode');

// =============================================
// FAQ
// =============================================

/**
 * FAQ Shortcode
 */
function waxing_faq_shortcode() {
    $faqs = array(
        array(
            'q' => __('Hoe lang moet mijn haar zijn voor waxen?', 'waxing-shop'),
            'a' => __('Minimaal 1-2mm bij hotwax. Dat is ongeveer 2-3 weken haargroei na scheren. Te kort haar wordt niet goed meegenomen.', 'waxing-shop'),
        ),
        array(
            'q' => __('Doet waxen veel pijn?', 'waxing-shop'),
            'a' => __('Met premium hotwax is de pijn significant minder dan met striphars. De wax krimpt rond het haar, niet de huid. De meeste klanten zeggen dat het na de eerste keer al veel minder is.', 'waxing-shop'),
        ),
        array(
            'q' => __('Hoe lang blijft mijn huid glad?', 'waxing-shop'),
            'a' => __('Gemiddeld 3-6 weken, afhankelijk van je haargroei. Bij regelmatig waxen wordt het haar dunner en groeit het minder snel terug.', 'waxing-shop'),
        ),
        array(
            'q' => __('Welke wax is geschikt voor gevoelige huid?', 'waxing-shop'),
            'a' => __('De Rose variant is speciaal ontwikkeld voor gevoelige huid, met verzorgende ingrediënten zoals rozenextract en vitamine E.', 'waxing-shop'),
        ),
        array(
            'q' => __('Wat is het verschil tussen hotwax en striphars?', 'waxing-shop'),
            'a' => __('Hotwax hardt uit en wordt zonder strip verwijderd - ideaal voor gevoelige zones zoals bikinilijn en gezicht. Striphars wordt met strips verwijderd en is geschikt voor grotere vlakken zoals benen.', 'waxing-shop'),
        ),
    );
    
    ob_start(); ?>
    <div class="faq-list" role="list">
        <?php foreach ($faqs as $i => $faq) : ?>
        <div class="faq-item" role="listitem">
            <button class="faq-question" aria-expanded="false" aria-controls="faq-answer-<?php echo $i; ?>">
                <?php echo esc_html($faq['q']); ?>
                <span class="faq-icon" aria-hidden="true">▼</span>
            </button>
            <div class="faq-answer" id="faq-answer-<?php echo $i; ?>" role="region">
                <?php echo esc_html($faq['a']); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('faq', 'waxing_faq_shortcode');

// =============================================
// QUIZ
// =============================================

/**
 * Quiz Shortcode
 */
function waxing_quiz_shortcode() {
    ob_start(); ?>
    <div class="quiz-container">
        <div class="quiz-card" id="waxQuiz" role="form" aria-label="<?php esc_attr_e('Wax advies quiz', 'waxing-shop'); ?>">
            <div class="quiz-progress" role="progressbar" aria-valuemin="1" aria-valuemax="4" aria-valuenow="1">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                <div class="quiz-progress-step <?php echo $i === 1 ? 'active' : ''; ?>" data-step="<?php echo $i; ?>"></div>
                <?php endfor; ?>
            </div>
            
            <div class="quiz-step active" data-step="1" aria-hidden="false">
                <h3 class="quiz-question"><?php esc_html_e('Hoe zou je jouw huidtype omschrijven?', 'waxing-shop'); ?></h3>
                <div class="quiz-options" role="radiogroup" aria-label="<?php esc_attr_e('Huidtype opties', 'waxing-shop'); ?>">
                    <div class="quiz-option" data-key="skin" data-value="sensitive" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">🌸</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Gevoelig', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Snel geïrriteerd of rood', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="skin" data-value="normal" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">✨</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Normaal', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Geen speciale aandacht nodig', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="skin" data-value="dry" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">💧</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Droog', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Vaak strak of schilferig', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                </div>
            </div>
            
            <div class="quiz-step" data-step="2" aria-hidden="true">
                <h3 class="quiz-question"><?php esc_html_e('Hoe zou je jouw haargroei omschrijven?', 'waxing-shop'); ?></h3>
                <div class="quiz-options" role="radiogroup">
                    <div class="quiz-option" data-key="hair" data-value="fine" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">🪶</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Fijn', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Dun en licht gekleurd', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="hair" data-value="medium" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">〰️</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Normaal', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Gemiddelde dikte', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="hair" data-value="coarse" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">💪</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Sterk/Dik', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Grof en donker gekleurd', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                </div>
            </div>
            
            <div class="quiz-step" data-step="3" aria-hidden="true">
                <h3 class="quiz-question"><?php esc_html_e('Welk gebied wil je vooral waxen?', 'waxing-shop'); ?></h3>
                <div class="quiz-options" role="radiogroup">
                    <div class="quiz-option" data-key="area" data-value="face" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">😊</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Gezicht', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Wenkbrauwen, bovenlip', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="area" data-value="body" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">🦵</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Lichaam', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Benen, armen, oksels', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="area" data-value="bikini" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">👙</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Bikinilijn', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Intieme zone', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                </div>
            </div>
            
            <div class="quiz-step" data-step="4" aria-hidden="true">
                <h3 class="quiz-question"><?php esc_html_e('Heb je al ervaring met waxen?', 'waxing-shop'); ?></h3>
                <div class="quiz-options" role="radiogroup">
                    <div class="quiz-option" data-key="exp" data-value="beginner" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">🌱</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Beginner', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Eerste keer of weinig ervaring', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="exp" data-value="some" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">🌿</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Enige ervaring', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Af en toe gewaxed', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                    <div class="quiz-option" data-key="exp" data-value="expert" tabindex="0" role="radio" aria-checked="false">
                        <span class="quiz-option-icon" aria-hidden="true">🌳</span>
                        <div class="quiz-option-text">
                            <p class="quiz-option-title"><?php esc_html_e('Ervaren', 'waxing-shop'); ?></p>
                            <p class="quiz-option-desc"><?php esc_html_e('Wax regelmatig zelf', 'waxing-shop'); ?></p>
                        </div>
                        <div class="quiz-option-check" aria-hidden="true">✓</div>
                    </div>
                </div>
            </div>
            
            <div class="quiz-result" data-step="result" aria-hidden="true" aria-live="polite"></div>
            
            <div class="quiz-nav">
                <button class="btn btn-secondary quiz-prev" style="visibility:hidden">← <?php esc_html_e('Vorige', 'waxing-shop'); ?></button>
                <button class="btn btn-primary quiz-next" disabled><?php esc_html_e('Volgende', 'waxing-shop'); ?> →</button>
            </div>
        </div>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('wax_quiz', 'waxing_quiz_shortcode');

// =============================================
// ACADEMY
// =============================================

/**
 * Academy Shortcode
 */
function waxing_academy_shortcode() {
    $items = array(
        array(
            'icon'  => '📚',
            'title' => __('Beginners Guide', 'waxing-shop'),
            'desc'  => __('Stap voor stap leren waxen met onze complete handleiding voor beginners.', 'waxing-shop'),
        ),
        array(
            'icon'  => '🎥',
            'title' => __('Video Tutorials', 'waxing-shop'),
            'desc'  => __('Bekijk onze professionele video\'s voor de beste wax technieken.', 'waxing-shop'),
        ),
        array(
            'icon'  => '💡',
            'title' => __('Tips & Tricks', 'waxing-shop'),
            'desc'  => __('Insider tips van professionals voor het beste resultaat thuis.', 'waxing-shop'),
        ),
    );
    
    ob_start(); ?>
    <div class="academy-grid" role="list">
        <?php foreach ($items as $item) : ?>
        <article class="academy-card" role="listitem">
            <div class="academy-icon" aria-hidden="true"><?php echo $item['icon']; ?></div>
            <h4 class="academy-title"><?php echo esc_html($item['title']); ?></h4>
            <p class="academy-desc"><?php echo esc_html($item['desc']); ?></p>
        </article>
        <?php endforeach; ?>
    </div>
    <?php 
    return ob_get_clean();
}
add_shortcode('academy', 'waxing_academy_shortcode');
