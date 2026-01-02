<?php
/**
 * WooCommerce Shop Archive
 */
get_header();
?>

<section class="shop-hero">
    <div class="hero-background">
        <div class="hero-gradient hero-gradient-1"></div>
        <div class="hero-gradient hero-gradient-2"></div>
    </div>
    <div class="hero-content">
        <p class="hero-eyebrow">Premium Collection</p>
        <h1 class="hero-title">Smooth <em>Perfection</em></h1>
        <p class="hero-subtitle">Professionele wax voor thuis. Ontdek de perfecte formule voor jouw huid.</p>
    </div>
</section>

<!-- Shop Categories Section -->
<?php
// Define which categories to show and their order
$visible_categories = array(
    'hot-wax' => '🔥',
    'striphars' => '📋',
    'apparatuur' => '⚡',
    'accessoires' => '🧴',
    'verzorging' => '✨',
    'pakketten' => '🎁',
);

// Categories where skin type filter applies
$wax_categories = array('hot-wax', 'striphars', 'intimi', 'vegan', 'blik');

// Check if current category is a wax category
$current_category = get_queried_object();
$is_wax_category = false;
if (is_product_category() && isset($current_category->slug)) {
    $is_wax_category = in_array($current_category->slug, $wax_categories);
    // Also check if parent is hot-wax
    if (!$is_wax_category && $current_category->parent) {
        $parent = get_term($current_category->parent, 'product_cat');
        if ($parent && $parent->slug === 'hot-wax') {
            $is_wax_category = true;
        }
    }
}
// On main shop page, show skin type filter
if (is_shop() && !is_product_category()) {
    $is_wax_category = true;
}
?>
<section class="shop-categories">
    <div class="shop-categories-inner">
        <h2 class="sr-only">Productcategorieën</h2>
        <div class="categories-grid">
            <!-- All Products -->
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="category-card <?php echo is_shop() && !is_product_category() ? 'active' : ''; ?>">
                <span class="category-icon">🛒</span>
                <span class="category-name">Alles</span>
            </a>

            <?php foreach ($visible_categories as $slug => $icon) :
                $category = get_term_by('slug', $slug, 'product_cat');
                if (!$category) continue;
                $is_current = is_product_category($slug);
            ?>
            <a href="<?php echo get_term_link($category); ?>" class="category-card <?php echo $is_current ? 'active' : ''; ?>">
                <span class="category-icon"><?php echo $icon; ?></span>
                <span class="category-name"><?php echo esc_html($category->name); ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="shop-toolbar">
    <div class="toolbar-filters">
        <?php if ($is_wax_category) : ?>
        <button class="filter-btn active" data-filter="all">Alles</button>
        <button class="filter-btn" data-filter="rose"><span class="filter-color" style="background:#F5E4E6;"></span>Rose</button>
        <button class="filter-btn" data-filter="gold"><span class="filter-color" style="background:#F2E8D5;"></span>Gold</button>
        <button class="filter-btn" data-filter="sunset"><span class="filter-color" style="background:#F7DFD0;"></span>Sunset</button>
        <button class="filter-btn" data-filter="nacree"><span class="filter-color" style="background:#F9F9F7;border:1px solid #ddd;"></span>Nacrée</button>
        <?php else : ?>
        <span class="toolbar-category-title"><?php
            if (is_product_category()) {
                single_term_title();
            } else {
                echo 'Alle producten';
            }
        ?></span>
        <?php endif; ?>
    </div>
    <div class="toolbar-right">
        <span class="results-count"><?php global $wp_query; echo $wp_query->found_posts; ?> producten</span>
        <select class="sort-select" id="shopSort">
            <option value="popularity">Populair</option>
            <option value="price-asc">Prijs: laag → hoog</option>
            <option value="price-desc">Prijs: hoog → laag</option>
            <option value="date">Nieuwste</option>
            <option value="rating">Best beoordeeld</option>
        </select>
    </div>
</div>

<div class="shop-layout">
    <aside class="shop-sidebar" data-wax-category="<?php echo $is_wax_category ? 'true' : 'false'; ?>">
        <?php if ($is_wax_category) : ?>
        <div class="sidebar-section">
            <h3 class="sidebar-title">Wax Variant</h3>
            <div class="color-options">
                <div class="color-option" data-filter="rose" style="background:#F5E4E6;" title="Rose"></div>
                <div class="color-option" data-filter="gold" style="background:#F2E8D5;" title="Gold"></div>
                <div class="color-option" data-filter="sunset" style="background:#F7DFD0;" title="Sunset"></div>
                <div class="color-option" data-filter="nacree" style="background:#F9F9F7;border:1px solid #ddd;" title="Nacrée"></div>
            </div>
        </div>
        <?php endif; ?>

        <div class="sidebar-section">
            <h3 class="sidebar-title">Prijs</h3>
            <div class="price-filter" id="priceFilter">
                <div class="price-filter-label">
                    <span id="priceMinLabel">€0</span>
                    <span id="priceMaxLabel">€150</span>
                </div>
                <div class="price-slider" id="priceSlider">
                    <div class="price-slider-track" id="priceTrack"></div>
                    <div class="price-slider-handle min" id="priceHandleMin" tabindex="0" role="slider" aria-label="<?php esc_attr_e('Minimum prijs', 'waxing-shop'); ?>" aria-valuemin="0" aria-valuemax="150" aria-valuenow="0"></div>
                    <div class="price-slider-handle max" id="priceHandleMax" tabindex="0" role="slider" aria-label="<?php esc_attr_e('Maximum prijs', 'waxing-shop'); ?>" aria-valuemin="0" aria-valuemax="150" aria-valuenow="150"></div>
                </div>
                <div class="price-inputs">
                    <div class="price-input-group">
                        <label for="priceInputMin">Min</label>
                        <input type="text" id="priceInputMin" class="price-input" value="€0">
                    </div>
                    <div class="price-input-group">
                        <label for="priceInputMax">Max</label>
                        <input type="text" id="priceInputMax" class="price-input" value="€150">
                    </div>
                </div>
            </div>
        </div>

        <?php if ($is_wax_category) : ?>
        <div class="sidebar-section">
            <h3 class="sidebar-title">Huidtype</h3>
            <div class="sidebar-options" id="skinTypeFilter">
                <label class="sidebar-option" data-skintype="sensitive">
                    <input type="checkbox" name="skintype" value="sensitive" hidden>
                    <span class="sidebar-checkbox">✓</span>Gevoelige huid
                </label>
                <label class="sidebar-option" data-skintype="normal">
                    <input type="checkbox" name="skintype" value="normal" hidden>
                    <span class="sidebar-checkbox">✓</span>Normale huid
                </label>
                <label class="sidebar-option" data-skintype="all">
                    <input type="checkbox" name="skintype" value="all" hidden>
                    <span class="sidebar-checkbox">✓</span>Alle huidtypes
                </label>
            </div>
        </div>
        <?php endif; ?>
    </aside>

    <main class="shop-content">
        <?php if (woocommerce_product_loop()) : ?>
        <div class="products-grid" role="list">
            <?php
            $first = true;
            while (have_posts()) : the_post();
                global $product;
                $product = wc_get_product(get_the_ID());

                get_template_part('template-parts/product-card', null, array(
                    'featured' => $first,
                ));
                $first = false;
            endwhile;
            ?>
        </div>
        
        <div class="pagination">
            <?php
            $total_pages = $wp_query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));
            
            for ($i = 1; $i <= min($total_pages, 5); $i++) :
                $active = ($i == $current_page) ? 'active' : '';
            ?>
                <a href="<?php echo get_pagenum_link($i); ?>" class="page-btn <?php echo $active; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <?php if ($current_page < $total_pages) : ?>
                <a href="<?php echo get_pagenum_link($current_page + 1); ?>" class="page-btn">→</a>
            <?php endif; ?>
        </div>
        
        <?php else : ?>
        <div class="no-products">
            <div class="no-products-icon">🔍</div>
            <h3 class="no-products-title">Geen producten gevonden</h3>
            <p class="no-products-text">Probeer andere filters of bekijk alle producten.</p>
        </div>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
