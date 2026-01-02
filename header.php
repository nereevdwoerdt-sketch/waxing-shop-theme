<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    
    <?php // Open Graph & Twitter Cards ?>
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta property="og:locale" content="<?php echo esc_attr(get_locale()); ?>">
    <?php if (is_front_page()) : ?>
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo esc_attr(get_bloginfo('name')); ?> - <?php echo esc_attr(get_bloginfo('description')); ?>">
        <meta property="og:description" content="<?php esc_attr_e('Premium hotwax voor professionele resultaten thuis. Ontwikkeld met 20 jaar salonervaring.', 'waxing-shop'); ?>">
        <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <?php elseif (function_exists('is_product') && is_product()) :
        global $product;
        $product_obj = is_a($product, 'WC_Product') ? $product : wc_get_product(get_the_ID()); ?>
        <?php if ($product_obj) : ?>
        <meta property="og:type" content="product">
        <meta property="og:title" content="<?php the_title_attribute(); ?>">
        <meta property="og:description" content="<?php echo esc_attr(wp_strip_all_tags($product_obj->get_short_description())); ?>">
        <meta property="og:url" content="<?php the_permalink(); ?>">
        <meta property="product:price:amount" content="<?php echo esc_attr($product_obj->get_price()); ?>">
        <meta property="product:price:currency" content="EUR">
        <?php if (has_post_thumbnail()) : ?>
            <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>">
        <?php endif; ?>
        <?php endif; ?>
    <?php else : ?>
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>">
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <?php endif; ?>
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo is_front_page() ? esc_attr(get_bloginfo('name')) : get_the_title(); ?>">
    
    <?php // Canonical URL ?>
    <link rel="canonical" href="<?php echo esc_url(is_front_page() ? home_url('/') : get_permalink()); ?>">
    
    <?php wp_head(); ?>
    
    <?php // Schema.org Organization ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "<?php echo esc_js(get_bloginfo('name')); ?>",
        "url": "<?php echo esc_url(home_url('/')); ?>",
        "logo": "<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo.png",
        "description": "<?php esc_html_e('Premium hotwax voor professionele resultaten thuis', 'waxing-shop'); ?>",
        "foundingDate": "2004",
        "areaServed": "NL"
    }
    </script>
    
    <?php // Schema.org Product (single product pages) ?>
    <?php if (function_exists('is_product') && is_product()) :
        global $product;
        $product_schema = is_a($product, 'WC_Product') ? $product : wc_get_product(get_the_ID());
        if ($product_schema) :
            $review_count = $product_schema->get_review_count();
            $avg_rating = $product_schema->get_average_rating();
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "<?php echo esc_js($product_schema->get_name()); ?>",
        "description": "<?php echo esc_js(wp_strip_all_tags($product_schema->get_short_description())); ?>",
        "image": "<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>",
        "sku": "<?php echo esc_js($product_schema->get_sku()); ?>",
        "brand": {
            "@type": "Brand",
            "name": "Waxing Shop"
        },
        "offers": {
            "@type": "Offer",
            "url": "<?php the_permalink(); ?>",
            "priceCurrency": "EUR",
            "price": "<?php echo esc_attr($product_schema->get_price()); ?>",
            "availability": "<?php echo $product_schema->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'; ?>",
            "seller": {
                "@type": "Organization",
                "name": "<?php echo esc_js(get_bloginfo('name')); ?>"
            }
        }<?php if ($review_count > 0) : ?>,
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "<?php echo esc_attr($avg_rating); ?>",
            "reviewCount": "<?php echo esc_attr($review_count); ?>"
        }<?php endif; ?>
    }
    </script>
    <?php endif; ?>
    <?php endif; ?>
    
    <?php // Schema.org BreadcrumbList ?>
    <?php if (!is_front_page() && function_exists('wc_get_page_permalink')) : ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "<?php esc_html_e('Home', 'waxing-shop'); ?>",
                "item": "<?php echo esc_url(home_url('/')); ?>"
            }<?php if (function_exists('is_product_category') && is_product_category()) : ?>,
            {
                "@type": "ListItem",
                "position": 2,
                "name": "<?php esc_html_e('Shop', 'waxing-shop'); ?>",
                "item": "<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "<?php single_cat_title(); ?>"
            }<?php elseif (function_exists('is_product') && is_product()) : ?>,
            {
                "@type": "ListItem",
                "position": 2,
                "name": "<?php esc_html_e('Shop', 'waxing-shop'); ?>",
                "item": "<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "<?php the_title(); ?>"
            }<?php elseif (function_exists('is_shop') && is_shop()) : ?>,
            {
                "@type": "ListItem",
                "position": 2,
                "name": "<?php esc_html_e('Shop', 'waxing-shop'); ?>"
            }<?php endif; ?>
        ]
    }
    </script>
    <?php endif; ?>
</head>
<body <?php body_class('loading'); ?>>
<?php wp_body_open(); ?>

<!-- Skip to Content (Accessibility) -->
<a href="#main" class="skip-link"><?php esc_html_e('Ga naar inhoud', 'waxing-shop'); ?></a>

<!-- Site Loader -->
<div class="site-loader" id="siteLoader" aria-hidden="true">
    <div class="loader-logo">
        <?php 
        $logo_text = 'Waxing Shop';
        for ($i = 0; $i < strlen($logo_text); $i++) {
            echo '<span style="animation-delay: ' . (0.05 + ($i * 0.03)) . 's">' . $logo_text[$i] . '</span>';
        }
        ?>
    </div>
    <div class="loader-bar"><div class="loader-bar-fill"></div></div>
</div>

<!-- Trust Bar -->
<?php waxing_trust_bar(); ?>

<!-- Header -->
<header class="site-header" id="siteHeader" role="banner">
    <div class="header-main">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?> - <?php esc_attr_e('Ga naar homepagina', 'waxing-shop'); ?>">
            <?php echo esc_html(get_bloginfo('name')); ?>
        </a>
        
        <nav class="main-nav" role="navigation" aria-label="<?php esc_attr_e('Hoofdnavigatie', 'waxing-shop'); ?>">
            <!-- Shop with Mega Menu -->
            <div class="nav-item">
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="nav-link" aria-haspopup="true" aria-expanded="false">
                    <?php esc_html_e('Shop', 'waxing-shop'); ?> <span class="nav-arrow" aria-hidden="true">▼</span>
                </a>

                <div class="mega-menu" role="menu" aria-label="<?php esc_attr_e('Shop categorieën', 'waxing-shop'); ?>">
                    <div class="mega-menu-grid">
                        <div class="mega-categories">
                            <h4 id="mega-cat-title"><?php esc_html_e('Categorieën', 'waxing-shop'); ?></h4>
                            <div class="mega-category-list" role="menu" aria-labelledby="mega-cat-title">
                                <?php
                                $categories = array(
                                    array('name' => __('Startersets', 'waxing-shop'), 'icon' => '📦', 'color' => '#E8E2D9', 'slug' => 'pakketten'),
                                    array('name' => __('Wax', 'waxing-shop'), 'icon' => '🍯', 'color' => '#F5E4E6', 'slug' => 'hot-wax'),
                                    array('name' => __('Verwarmers', 'waxing-shop'), 'icon' => '🔥', 'color' => '#FFE8D6', 'slug' => 'verwarmers'),
                                    array('name' => __('Verzorging', 'waxing-shop'), 'icon' => '🧴', 'color' => '#E8EAF0', 'slug' => 'verzorging'),
                                    array('name' => __('Accessoires', 'waxing-shop'), 'icon' => '🔧', 'color' => '#E5EAE3', 'slug' => 'accessoires'),
                                );
                                foreach ($categories as $cat) :
                                    $term = get_term_by('slug', $cat['slug'], 'product_cat');
                                    $link = $term ? get_term_link($term) : home_url('/product-categorie/' . $cat['slug'] . '/');
                                ?>
                                <a href="<?php echo esc_url($link); ?>" class="mega-category-link" role="menuitem">
                                    <span class="mega-category-icon" style="background: <?php echo esc_attr($cat['color']); ?>;" aria-hidden="true"><?php echo $cat['icon']; ?></span>
                                    <?php echo esc_html($cat['name']); ?>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="mega-featured">
                            <h4 id="mega-best-title"><?php esc_html_e('Bestsellers', 'waxing-shop'); ?></h4>
                            <div class="mega-products" role="menu" aria-labelledby="mega-best-title">
                                <?php
                                $bestsellers = waxing_get_bestsellers(3);
                                if (!empty($bestsellers)) :
                                    foreach ($bestsellers as $product) :
                                ?>
                                <a href="<?php echo esc_url($product['permalink']); ?>" class="mega-product" role="menuitem">
                                    <div class="mega-product-image" style="background: <?php echo esc_attr($product['color']); ?>;">
                                        <?php if ($product['image']) : ?>
                                            <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['name']); ?>" loading="lazy" width="80" height="80">
                                        <?php else : ?>
                                            <div class="pellets-mini" aria-hidden="true">
                                                <?php for ($i = 0; $i < 6; $i++) : ?><div class="pellet-mini"></div><?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <p class="mega-product-name"><?php echo esc_html($product['name']); ?></p>
                                    <p class="mega-product-price"><?php echo $product['price']; ?></p>
                                </a>
                                <?php
                                    endforeach;
                                else :
                                ?>
                                <p style="color:#888;font-size:13px;"><?php esc_html_e('Producten worden geladen...', 'waxing-shop'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Waxen Gids with Dropdown -->
            <div class="nav-item">
                <a href="<?php echo esc_url(home_url('/waxen/')); ?>" class="nav-link" aria-haspopup="true" aria-expanded="false">
                    <?php esc_html_e('Waxen Gids', 'waxing-shop'); ?> <span class="nav-arrow" aria-hidden="true">▼</span>
                </a>

                <div class="dropdown-menu" role="menu" aria-label="<?php esc_attr_e('Waxen Gids menu', 'waxing-shop'); ?>">
                    <a href="<?php echo esc_url(home_url('/waxen/#huidproblemen')); ?>" class="dropdown-link" role="menuitem">
                        <span class="dropdown-icon">🔴</span>
                        <span class="dropdown-text">
                            <span class="dropdown-title"><?php esc_html_e('Huidproblemen', 'waxing-shop'); ?></span>
                            <span class="dropdown-desc"><?php esc_html_e('Scheerbultjes, ingegroeide haren', 'waxing-shop'); ?></span>
                        </span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/waxen/#content')); ?>" class="dropdown-link" role="menuitem">
                        <span class="dropdown-icon">📚</span>
                        <span class="dropdown-text">
                            <span class="dropdown-title"><?php esc_html_e('Leren waxen', 'waxing-shop'); ?></span>
                            <span class="dropdown-desc"><?php esc_html_e('Stap voor stap beginnen', 'waxing-shop'); ?></span>
                        </span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/waxen/#zones')); ?>" class="dropdown-link" role="menuitem">
                        <span class="dropdown-icon">🎯</span>
                        <span class="dropdown-text">
                            <span class="dropdown-title"><?php esc_html_e('Per zone', 'waxing-shop'); ?></span>
                            <span class="dropdown-desc"><?php esc_html_e('Benen, bikinilijn, gezicht...', 'waxing-shop'); ?></span>
                        </span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/academy/')); ?>" class="dropdown-link" role="menuitem">
                        <span class="dropdown-icon">🎬</span>
                        <span class="dropdown-text">
                            <span class="dropdown-title"><?php esc_html_e('Academy', 'waxing-shop'); ?></span>
                            <span class="dropdown-desc"><?php esc_html_e('Video tutorials', 'waxing-shop'); ?></span>
                        </span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/waxen/#faq')); ?>" class="dropdown-link" role="menuitem">
                        <span class="dropdown-icon">❓</span>
                        <span class="dropdown-text">
                            <span class="dropdown-title"><?php esc_html_e('FAQ', 'waxing-shop'); ?></span>
                            <span class="dropdown-desc"><?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?></span>
                        </span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?php echo esc_url(home_url('/waxen/')); ?>" class="dropdown-link dropdown-link-all" role="menuitem">
                        <?php esc_html_e('Bekijk alles', 'waxing-shop'); ?> →
                    </a>
                </div>
            </div>

            <!-- Blog -->
            <div class="nav-item">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link">
                    <?php esc_html_e('Blog', 'waxing-shop'); ?>
                </a>
            </div>
        </nav>
        
        <div class="header-actions">
            <!-- Search Icon -->
            <button class="header-search header-icon-btn" id="headerSearch" aria-label="<?php esc_attr_e('Zoeken', 'waxing-shop'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
            </button>

            <!-- Wishlist Icon with Counter -->
            <button class="header-wishlist header-icon-btn" id="headerWishlist" aria-label="<?php esc_attr_e('Favorieten', 'waxing-shop'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                <span class="header-count wishlist-count" id="wishlistCount" aria-live="polite"><?php echo count(waxing_get_wishlist()); ?></span>
            </button>

            <!-- Contact Button (sage/green) -->
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-sage btn-sm header-contact-btn">
                <?php esc_html_e('Contact', 'waxing-shop'); ?>
            </a>

            <!-- Cart Icon with Counter -->
            <button class="header-cart header-icon-btn" id="headerCart" aria-label="<?php esc_attr_e('Winkelmand', 'waxing-shop'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                </svg>
                <span class="header-count cart-count" id="cartCount" aria-live="polite"><?php echo esc_html(waxing_cart_count()); ?></span>
            </button>

            <!-- Mobile: Hamburger Menu -->
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="<?php esc_attr_e('Menu openen', 'waxing-shop'); ?>" aria-expanded="false" aria-controls="mobileMenu">
                <span></span>
            </button>
        </div>
    </div>
    
    <!-- Breadcrumbs -->
    <?php if (!is_front_page()) : ?>
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Kruimelpad', 'waxing-shop'); ?>">
        <div class="breadcrumbs-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'waxing-shop'); ?></a>
            <span aria-hidden="true">›</span>
            <?php if (function_exists('is_shop') && is_shop()) : ?>
                <span aria-current="page"><?php esc_html_e('Shop', 'waxing-shop'); ?></span>
            <?php elseif (function_exists('is_product_category') && is_product_category()) : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('Shop', 'waxing-shop'); ?></a>
                <span aria-hidden="true">›</span>
                <span aria-current="page"><?php single_cat_title(); ?></span>
            <?php elseif (function_exists('is_product') && is_product()) : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php esc_html_e('Shop', 'waxing-shop'); ?></a>
                <span aria-hidden="true">›</span>
                <span aria-current="page"><?php the_title(); ?></span>
            <?php elseif (function_exists('is_cart') && is_cart()) : ?>
                <span aria-current="page"><?php esc_html_e('Winkelmand', 'waxing-shop'); ?></span>
            <?php elseif (function_exists('is_checkout') && is_checkout()) : ?>
                <span aria-current="page"><?php esc_html_e('Afrekenen', 'waxing-shop'); ?></span>
            <?php else : ?>
                <span aria-current="page"><?php the_title(); ?></span>
            <?php endif; ?>
        </div>
    </nav>
    <?php endif; ?>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu" role="navigation" aria-label="<?php esc_attr_e('Mobiel menu', 'waxing-shop'); ?>" aria-hidden="true">
    <nav class="mobile-menu-nav">
        <!-- Search Bar -->
        <div class="mobile-search-wrapper">
            <button class="mobile-search-btn" id="mobileSearchBtn" aria-label="<?php esc_attr_e('Zoeken', 'waxing-shop'); ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                <span><?php esc_html_e('Zoeken...', 'waxing-shop'); ?></span>
            </button>
        </div>

        <!-- Menu Links -->
        <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="mobile-menu-link">
            <span class="mobile-menu-icon">🛍️</span>
            <?php esc_html_e('Shop', 'waxing-shop'); ?>
        </a>
        <a href="<?php echo esc_url(home_url('/waxen/')); ?>" class="mobile-menu-link">
            <span class="mobile-menu-icon">📖</span>
            <?php esc_html_e('Waxen Gids', 'waxing-shop'); ?>
        </a>
        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="mobile-menu-link">
            <span class="mobile-menu-icon">📝</span>
            <?php esc_html_e('Blog', 'waxing-shop'); ?>
        </a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mobile-menu-link">
            <span class="mobile-menu-icon">💬</span>
            <?php esc_html_e('Contact', 'waxing-shop'); ?>
        </a>

        <!-- Divider -->
        <div class="mobile-menu-divider"></div>

        <!-- Quick Links -->
        <a href="<?php echo esc_url(home_url('/academy/')); ?>" class="mobile-menu-link mobile-menu-link-secondary">
            <?php esc_html_e('Video Tutorials', 'waxing-shop'); ?>
        </a>
        <a href="<?php echo esc_url(home_url('/waxen/#faq')); ?>" class="mobile-menu-link mobile-menu-link-secondary">
            <?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?>
        </a>
    </nav>
</div>

<!-- Enhanced Quick View Modal -->
<div class="modal-overlay" id="quickViewModal" role="dialog" aria-modal="true" aria-labelledby="quickViewTitle" aria-hidden="true">
    <div class="modal-content quick-view-modal">
        <button class="modal-close" id="quickViewClose" aria-label="<?php esc_attr_e('Sluiten', 'waxing-shop'); ?>">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>
        
        <div class="quick-view-grid">
            <!-- Image Section -->
            <div class="quick-view-image-section">
                <div class="quick-view-image" id="quickViewImage">
                    <div class="quick-view-loader" aria-hidden="true">
                        <div class="loader-spinner"></div>
                    </div>
                </div>
                <div class="quick-view-thumbnails" id="quickViewThumbnails" style="display:none;"></div>
            </div>
            
            <!-- Info Section -->
            <div class="quick-view-info">
                <p class="quick-view-category" id="quickViewCategory"></p>
                <h2 class="quick-view-title" id="quickViewTitle"><?php esc_html_e('Laden...', 'waxing-shop'); ?></h2>
                
                <div class="quick-view-rating" id="quickViewRating" style="display:none;">
                    <span class="stars" aria-hidden="true"></span>
                    <span class="count"></span>
                </div>
                
                <div class="quick-view-price-box">
                    <span class="quick-view-price" id="quickViewPrice"></span>
                    <span class="quick-view-price-old" id="quickViewPriceOld" style="display:none;"></span>
                </div>
                
                <div class="quick-view-desc" id="quickViewDesc"></div>
                
                <!-- Variant Selector (for variable products) -->
                <div class="quick-view-variants" id="quickViewVariants" style="display:none;">
                    <label><?php esc_html_e('Kies variant:', 'waxing-shop'); ?></label>
                    <div class="variant-options" id="variantOptions"></div>
                </div>
                
                <!-- Quantity Selector -->
                <div class="quick-view-quantity">
                    <label for="quickViewQty"><?php esc_html_e('Aantal:', 'waxing-shop'); ?></label>
                    <div class="quantity-selector">
                        <button type="button" class="qty-btn qty-minus" aria-label="<?php esc_attr_e('Verminder aantal', 'waxing-shop'); ?>">−</button>
                        <input type="number" id="quickViewQty" value="1" min="1" max="99" aria-label="<?php esc_attr_e('Aantal', 'waxing-shop'); ?>">
                        <button type="button" class="qty-btn qty-plus" aria-label="<?php esc_attr_e('Verhoog aantal', 'waxing-shop'); ?>">+</button>
                    </div>
                </div>
                
                <!-- Add to Cart -->
                <div class="quick-view-actions">
                    <button class="btn btn-sage btn-block btn-lg" id="quickViewAddCart">
                        <span class="btn-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                            </svg>
                        </span>
                        <span class="btn-text"><?php esc_html_e('Toevoegen aan winkelmand', 'waxing-shop'); ?></span>
                        <span class="btn-price" id="quickViewBtnPrice"></span>
                    </button>
                </div>
                
                <!-- Trust Signals -->
                <div class="quick-view-trust">
                    <div class="trust-item" id="quickViewStock">
                        <span class="stock-dot"></span>
                        <span class="stock-text"><?php esc_html_e('Op voorraad', 'waxing-shop'); ?></span>
                    </div>
                    <div class="trust-item" id="quickViewDelivery">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                        </svg>
                        <span><?php esc_html_e('Morgen in huis', 'waxing-shop'); ?></span>
                    </div>
                    <div class="trust-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                        </svg>
                        <span><?php esc_html_e('30 dagen retour', 'waxing-shop'); ?></span>
                    </div>
                    <div class="trust-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <span><?php esc_html_e('Veilig betalen', 'waxing-shop'); ?></span>
                    </div>
                </div>
                
                <!-- View Full Details Link -->
                <a href="#" class="quick-view-link" id="quickViewLink">
                    <?php esc_html_e('Bekijk volledige productpagina', 'waxing-shop'); ?> →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Mini Cart Slide-in -->
<div class="mini-cart-overlay" id="miniCartOverlay" aria-hidden="true">
    <div class="mini-cart" id="miniCart" role="dialog" aria-modal="true" aria-labelledby="miniCartTitle">
        <div class="mini-cart-header">
            <h3 class="mini-cart-title" id="miniCartTitle">
                <?php esc_html_e('Winkelmand', 'waxing-shop'); ?>
                <span class="mini-cart-count" id="miniCartCount">(<?php echo esc_html(waxing_cart_count()); ?>)</span>
            </h3>
            <button class="mini-cart-close" id="miniCartClose" aria-label="<?php esc_attr_e('Sluiten', 'waxing-shop'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="mini-cart-items" id="miniCartItems">
            <div class="mini-cart-empty">
                <div class="empty-icon" aria-hidden="true">🛒</div>
                <p><?php esc_html_e('Je winkelmand is leeg', 'waxing-shop'); ?></p>
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="btn btn-secondary btn-sm">
                    <?php esc_html_e('Bekijk producten', 'waxing-shop'); ?>
                </a>
            </div>
        </div>

        <!-- Product Suggestions -->
        <div class="mini-cart-suggestions" id="miniCartSuggestions" style="display:none;">
            <h4 class="suggestions-title"><?php esc_html_e('Misschien vergeten?', 'waxing-shop'); ?></h4>
            <div class="suggestions-list" id="suggestionsList"></div>
        </div>

        <div class="mini-cart-footer" id="miniCartFooter" style="display:none;">
            <div class="mini-cart-subtotal">
                <span><?php esc_html_e('Subtotaal:', 'waxing-shop'); ?></span>
                <span class="subtotal-amount" id="miniCartSubtotal">€0,00</span>
            </div>
            <div class="mini-cart-shipping">
                <span id="miniCartShipping"><?php esc_html_e('Gratis verzending vanaf €50', 'waxing-shop'); ?></span>
            </div>
            <div class="mini-cart-buttons">
                <a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : '/cart'); ?>" class="btn btn-secondary btn-block">
                    <?php esc_html_e('Bekijk winkelmand', 'waxing-shop'); ?>
                </a>
                <a href="<?php echo esc_url(function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : '/checkout'); ?>" class="btn btn-sage btn-block">
                    <?php esc_html_e('Afrekenen', 'waxing-shop'); ?> →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Wishlist Slide-in -->
<div class="wishlist-overlay" id="wishlistOverlay" aria-hidden="true">
    <div class="wishlist-sidebar" id="wishlistSidebar" role="dialog" aria-modal="true" aria-labelledby="wishlistTitle">
        <div class="wishlist-header">
            <h3 class="wishlist-title" id="wishlistTitle">
                <?php esc_html_e('Favorieten', 'waxing-shop'); ?>
                <span class="wishlist-header-count" id="wishlistHeaderCount">(<?php echo count(waxing_get_wishlist()); ?>)</span>
            </h3>
            <button class="wishlist-close" id="wishlistClose" aria-label="<?php esc_attr_e('Sluiten', 'waxing-shop'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="wishlist-items" id="wishlistItems">
            <div class="wishlist-empty" id="wishlistEmpty">
                <div class="empty-icon" aria-hidden="true">♡</div>
                <p><?php esc_html_e('Je hebt nog geen favorieten', 'waxing-shop'); ?></p>
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="btn btn-secondary btn-sm">
                    <?php esc_html_e('Bekijk producten', 'waxing-shop'); ?>
                </a>
            </div>
        </div>

        <div class="wishlist-footer" id="wishlistFooter" style="display:none;">
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="btn btn-sage btn-block">
                <?php esc_html_e('Verder winkelen', 'waxing-shop'); ?>
            </a>
        </div>
    </div>
</div>

<!-- Newsletter Popup -->
<div class="newsletter-popup" id="newsletterPopup" role="dialog" aria-modal="true" aria-labelledby="newsletterPopupTitle" aria-hidden="true">
    <div class="newsletter-popup-content">
        <button class="newsletter-popup-close" id="newsletterPopupClose" aria-label="<?php esc_attr_e('Sluiten', 'waxing-shop'); ?>">×</button>
        <div class="newsletter-popup-icon" aria-hidden="true">✨</div>
        <h3 class="newsletter-popup-title" id="newsletterPopupTitle"><?php esc_html_e('Welkom!', 'waxing-shop'); ?></h3>
        <span class="newsletter-popup-discount"><?php esc_html_e('10% KORTING', 'waxing-shop'); ?></span>
        <p class="newsletter-popup-text"><?php esc_html_e('Schrijf je in voor onze nieuwsbrief en ontvang 10% korting op je eerste bestelling.', 'waxing-shop'); ?></p>
        <form class="newsletter-popup-form" id="newsletterPopupForm">
            <label for="newsletterPopupEmail" class="sr-only"><?php esc_html_e('E-mailadres', 'waxing-shop'); ?></label>
            <input type="email" id="newsletterPopupEmail" class="newsletter-popup-input" placeholder="<?php esc_attr_e('Je e-mailadres', 'waxing-shop'); ?>" required>
            <button type="submit" class="btn btn-sage btn-block"><?php esc_html_e('Ontvang mijn korting', 'waxing-shop'); ?></button>
        </form>
        <p class="newsletter-popup-privacy"><?php esc_html_e('Je gegevens zijn veilig. Geen spam, beloofd.', 'waxing-shop'); ?></p>
    </div>
</div>

<!-- ARIA Live Region for Announcements -->
<div id="liveAnnouncements" class="sr-only" aria-live="polite" aria-atomic="true"></div>

<!-- Search Modal -->
<div class="search-modal" id="searchModal" role="dialog" aria-modal="true" aria-labelledby="searchModalTitle" aria-hidden="true">
    <div class="search-modal-content">
        <div class="search-form">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
            <label for="searchInput" class="sr-only"><?php esc_html_e('Zoeken', 'waxing-shop'); ?></label>
            <input type="search" id="searchInput" class="search-input" placeholder="<?php esc_attr_e('Zoek producten...', 'waxing-shop'); ?>" autocomplete="off">
            <button class="search-close" id="searchClose" aria-label="<?php esc_attr_e('Sluiten', 'waxing-shop'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="search-results" id="searchResults">
            <div class="search-popular">
                <p class="search-popular-title"><?php esc_html_e('Populaire zoekopdrachten', 'waxing-shop'); ?></p>
                <div class="search-popular-tags">
                    <a href="<?php echo esc_url(home_url('/?s=hotwax')); ?>" class="search-tag">Hotwax</a>
                    <a href="<?php echo esc_url(home_url('/?s=starterset')); ?>" class="search-tag">Startersets</a>
                    <a href="<?php echo esc_url(home_url('/?s=rose')); ?>" class="search-tag">Rose</a>
                    <a href="<?php echo esc_url(home_url('/?s=gold')); ?>" class="search-tag">Gold</a>
                    <a href="<?php echo esc_url(home_url('/?s=verwarmer')); ?>" class="search-tag">Verwarmers</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Set Configurator Modal -->
<div class="configurator-modal" id="configuratorModal" role="dialog" aria-modal="true" aria-labelledby="configuratorTitle" aria-hidden="true">
    <div class="configurator-overlay"></div>
    <div class="configurator-content">
        <button class="configurator-close" id="configuratorClose" aria-label="<?php esc_attr_e('Sluiten', 'waxing-shop'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"/>
            </svg>
        </button>

        <div class="configurator-header">
            <h2 class="configurator-title" id="configuratorTitle"><?php esc_html_e('Stel je set samen', 'waxing-shop'); ?></h2>
            <p class="configurator-subtitle"><?php esc_html_e('Kies de producten die bij jou passen', 'waxing-shop'); ?></p>
        </div>

        <div class="configurator-body">
            <!-- Step 1: Warmer -->
            <div class="configurator-step" data-step="1">
                <h3 class="step-title">
                    <span class="step-number">1</span>
                    <?php esc_html_e('Kies je verwarmer', 'waxing-shop'); ?>
                </h3>
                <div class="step-options warmer-options">
                    <label class="option-card">
                        <input type="radio" name="warmer" value="none" data-price="0">
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Geen verwarmer', 'waxing-shop'); ?></span>
                            <span class="option-desc"><?php esc_html_e('Ik heb er al een', 'waxing-shop'); ?></span>
                            <span class="option-price">€0,00</span>
                        </div>
                    </label>
                    <label class="option-card">
                        <input type="radio" name="warmer" value="400ml" data-price="24.95" checked>
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Verwarmer 400ml', 'waxing-shop'); ?></span>
                            <span class="option-desc"><?php esc_html_e('Ideaal voor beginners', 'waxing-shop'); ?></span>
                            <span class="option-price">€24,95</span>
                        </div>
                    </label>
                    <label class="option-card recommended">
                        <span class="option-badge"><?php esc_html_e('Populair', 'waxing-shop'); ?></span>
                        <input type="radio" name="warmer" value="800ml" data-price="34.95">
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Verwarmer Pro 800ml', 'waxing-shop'); ?></span>
                            <span class="option-desc"><?php esc_html_e('Voor grotere zones', 'waxing-shop'); ?></span>
                            <span class="option-price">€34,95</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Step 2: Wax Types -->
            <div class="configurator-step" data-step="2">
                <h3 class="step-title">
                    <span class="step-number">2</span>
                    <?php esc_html_e('Kies je wax', 'waxing-shop'); ?>
                    <span class="step-hint"><?php esc_html_e('(max. 3 soorten)', 'waxing-shop'); ?></span>
                </h3>
                <div class="step-options wax-options">
                    <label class="option-card wax-card">
                        <input type="checkbox" name="wax[]" value="rose" data-price="25.20" data-name="Hot Wax Rose">
                        <div class="option-content">
                            <span class="option-color" style="background:#f5d0d0"></span>
                            <span class="option-name">Hot Wax Rose</span>
                            <span class="option-desc"><?php esc_html_e('Gevoelige huid', 'waxing-shop'); ?></span>
                            <span class="option-price">€25,20</span>
                        </div>
                    </label>
                    <label class="option-card wax-card">
                        <input type="checkbox" name="wax[]" value="nacree" data-price="25.20" data-name="Hot Wax Nacree Blanche" checked>
                        <div class="option-content">
                            <span class="option-color" style="background:#f5f0e6"></span>
                            <span class="option-name">Hot Wax Nacree Blanche</span>
                            <span class="option-desc"><?php esc_html_e('Alle huidtypes', 'waxing-shop'); ?></span>
                            <span class="option-price">€25,20</span>
                        </div>
                    </label>
                    <label class="option-card wax-card">
                        <input type="checkbox" name="wax[]" value="gold" data-price="28.75" data-name="Hot Wax Gold">
                        <div class="option-content">
                            <span class="option-color" style="background:#d4af37"></span>
                            <span class="option-name">Hot Wax Gold</span>
                            <span class="option-desc"><?php esc_html_e('Luxe hardwax', 'waxing-shop'); ?></span>
                            <span class="option-price">€28,75</span>
                        </div>
                    </label>
                    <label class="option-card wax-card">
                        <input type="checkbox" name="wax[]" value="brazilian" data-price="28.25" data-name="Brazilian Wax">
                        <div class="option-content">
                            <span class="option-color" style="background:#e8d4b0"></span>
                            <span class="option-name">Brazilian Wax</span>
                            <span class="option-desc"><?php esc_html_e('Intieme zone', 'waxing-shop'); ?></span>
                            <span class="option-price">€28,25</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Step 3: Accessories -->
            <div class="configurator-step" data-step="3">
                <h3 class="step-title">
                    <span class="step-number">3</span>
                    <?php esc_html_e('Accessoires', 'waxing-shop'); ?>
                    <span class="step-hint"><?php esc_html_e('(optioneel)', 'waxing-shop'); ?></span>
                </h3>
                <div class="step-options accessory-options">
                    <label class="option-card accessory-card">
                        <input type="checkbox" name="accessory[]" value="spatels50" data-price="6.95" data-name="50 Spatels" checked>
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Houten spatels', 'waxing-shop'); ?> (50x)</span>
                            <span class="option-price">€6,95</span>
                        </div>
                    </label>
                    <label class="option-card accessory-card">
                        <input type="checkbox" name="accessory[]" value="spatels100" data-price="11.25" data-name="100 Spatels">
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Houten spatels', 'waxing-shop'); ?> (100x)</span>
                            <span class="option-price">€11,25</span>
                        </div>
                    </label>
                    <label class="option-card accessory-card">
                        <input type="checkbox" name="accessory[]" value="preoil" data-price="12.95" data-name="Pre-Wax Olie">
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Pre-Wax Olie', 'waxing-shop'); ?></span>
                            <span class="option-price">€12,95</span>
                        </div>
                    </label>
                    <label class="option-card accessory-card">
                        <input type="checkbox" name="accessory[]" value="afterlotion" data-price="14.95" data-name="After-Wax Lotion">
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('After-Wax Lotion', 'waxing-shop'); ?></span>
                            <span class="option-price">€14,95</span>
                        </div>
                    </label>
                    <label class="option-card accessory-card">
                        <input type="checkbox" name="accessory[]" value="strips" data-price="11.50" data-name="Harsstrips 250x">
                        <div class="option-content">
                            <span class="option-name"><?php esc_html_e('Harsstrips', 'waxing-shop'); ?> (250x)</span>
                            <span class="option-price">€11,50</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Configurator Footer with Price Comparison -->
        <div class="configurator-footer">
            <div class="price-comparison">
                <div class="your-selection">
                    <span class="selection-label"><?php esc_html_e('Jouw selectie', 'waxing-shop'); ?></span>
                    <span class="selection-price" id="configTotalPrice">€0,00</span>
                </div>
                <div class="vs-divider"><?php esc_html_e('vs', 'waxing-shop'); ?></div>
                <div class="starter-set-comparison">
                    <span class="comparison-label"><?php esc_html_e('Complete Set', 'waxing-shop'); ?></span>
                    <span class="comparison-price">€79,95</span>
                    <span class="comparison-savings" id="configSavings"></span>
                </div>
            </div>

            <div class="configurator-summary" id="configSummary">
                <!-- Summary items will be added via JS -->
            </div>

            <button class="btn btn-sage btn-lg btn-block" id="configAddToCart" disabled>
                <?php esc_html_e('Toevoegen aan winkelmand', 'waxing-shop'); ?>
                <span class="btn-total" id="configBtnTotal">€0,00</span>
            </button>

            <p class="configurator-hint">
                <?php esc_html_e('💡 Tip: De Complete Set bevat al deze items met korting!', 'waxing-shop'); ?>
            </p>
        </div>
    </div>
</div>

<main id="main" class="site-main" role="main">
