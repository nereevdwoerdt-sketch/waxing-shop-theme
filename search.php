<?php
/**
 * Search Results Template
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();

$search_query = get_search_query();
$total_results = $wp_query->found_posts;
?>

<main id="primary" class="search-results">
    
    <!-- Search Header -->
    <section class="search-header">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li>Zoekresultaten</li>
                </ol>
            </nav>
            
            <h1 class="search-title">
                <?php if ($total_results > 0) : ?>
                    <?php echo $total_results; ?> resultaten voor "<?php echo esc_html($search_query); ?>"
                <?php else : ?>
                    Geen resultaten voor "<?php echo esc_html($search_query); ?>"
                <?php endif; ?>
            </h1>
            
            <!-- Search Form -->
            <div class="search-form-wrapper">
                <form role="search" method="get" class="search-form-large" action="<?php echo home_url('/'); ?>">
                    <label for="search-input" class="sr-only">Zoeken</label>
                    <input type="search" 
                           id="search-input"
                           class="search-input" 
                           placeholder="Zoek producten, artikelen..." 
                           value="<?php echo esc_attr($search_query); ?>" 
                           name="s" />
                    <button type="submit" class="btn btn-sage">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Zoeken
                    </button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Search Results -->
    <section class="search-results-section">
        <div class="container">
            
            <?php if (have_posts()) : ?>
            
                <!-- Filter Tabs (Products vs Content) -->
                <?php
                // Count products vs other content
                $product_count = 0;
                $content_count = 0;
                
                // Clone query to count
                $count_query = new WP_Query(array(
                    's' => $search_query,
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'fields' => 'ids'
                ));
                $product_count = $count_query->found_posts;
                
                $count_query = new WP_Query(array(
                    's' => $search_query,
                    'post_type' => array('post', 'page'),
                    'posts_per_page' => -1,
                    'fields' => 'ids'
                ));
                $content_count = $count_query->found_posts;
                wp_reset_postdata();
                ?>
                
                <div class="search-filters">
                    <span class="filter-label">Filteren:</span>
                    <a href="<?php echo esc_url(add_query_arg('post_type', '', home_url('/?s=' . urlencode($search_query)))); ?>" 
                       class="filter-tab <?php echo !isset($_GET['post_type']) ? 'active' : ''; ?>">
                        Alles <span class="count"><?php echo $total_results; ?></span>
                    </a>
                    <?php if ($product_count > 0) : ?>
                    <a href="<?php echo esc_url(home_url('/?s=' . urlencode($search_query) . '&post_type=product')); ?>" 
                       class="filter-tab <?php echo (isset($_GET['post_type']) && $_GET['post_type'] === 'product') ? 'active' : ''; ?>">
                        Producten <span class="count"><?php echo $product_count; ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if ($content_count > 0) : ?>
                    <a href="<?php echo esc_url(home_url('/?s=' . urlencode($search_query) . '&post_type=post')); ?>" 
                       class="filter-tab <?php echo (isset($_GET['post_type']) && $_GET['post_type'] === 'post') ? 'active' : ''; ?>">
                        Artikelen <span class="count"><?php echo $content_count; ?></span>
                    </a>
                    <?php endif; ?>
                </div>
                
                <!-- Results Grid -->
                <div class="search-results-grid">
                    <?php while (have_posts()) : the_post(); ?>
                    
                        <?php if (get_post_type() === 'product') : ?>
                            <!-- Product Result -->
                            <?php 
                            $product = wc_get_product(get_the_ID()); 
                            if ($product) :
                            ?>
                            <article class="search-result search-result-product">
                                <a href="<?php the_permalink(); ?>" class="result-link">
                                    <div class="result-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php else : ?>
                                            <div class="result-image-placeholder">
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21,15 16,10 5,21"></polyline>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="result-content">
                                        <span class="result-type">Product</span>
                                        <h3 class="result-title"><?php the_title(); ?></h3>
                                        <p class="result-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                        <span class="result-price"><?php echo $product->get_price_html(); ?></span>
                                    </div>
                                </a>
                            </article>
                            <?php endif; ?>
                            
                        <?php else : ?>
                            <!-- Content Result -->
                            <article class="search-result search-result-content">
                                <a href="<?php the_permalink(); ?>" class="result-link">
                                    <?php if (has_post_thumbnail()) : ?>
                                    <div class="result-image">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="result-content">
                                        <span class="result-type">
                                            <?php 
                                            if (get_post_type() === 'post') echo 'Artikel';
                                            elseif (get_post_type() === 'page') echo 'Pagina';
                                            else echo get_post_type_object(get_post_type())->labels->singular_name;
                                            ?>
                                        </span>
                                        <h3 class="result-title"><?php the_title(); ?></h3>
                                        <p class="result-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        <span class="result-link-text">Lees meer →</span>
                                    </div>
                                </a>
                            </article>
                        <?php endif; ?>
                        
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <nav class="search-pagination" aria-label="Paginatie">
                    <?php
                    $pagination = paginate_links(array(
                        'prev_text' => '← Vorige',
                        'next_text' => 'Volgende →',
                        'type' => 'array'
                    ));
                    
                    if ($pagination) :
                    ?>
                    <ul class="pagination-list">
                        <?php foreach ($pagination as $page) : ?>
                        <li><?php echo $page; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </nav>
            
            <?php else : ?>
            
                <!-- No Results -->
                <div class="no-results">
                    <div class="no-results-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            <line x1="8" y1="8" x2="14" y2="14"></line>
                            <line x1="14" y1="8" x2="8" y2="14"></line>
                        </svg>
                    </div>
                    <h2>Geen resultaten gevonden</h2>
                    <p>We konden niets vinden voor "<?php echo esc_html($search_query); ?>". Probeer een andere zoekterm of bekijk onze populaire pagina's.</p>
                    
                    <div class="no-results-suggestions">
                        <h3>Suggesties</h3>
                        <ul>
                            <li>Controleer de spelling van je zoekterm</li>
                            <li>Probeer algemenere termen</li>
                            <li>Gebruik minder woorden</li>
                        </ul>
                    </div>
                    
                    <div class="no-results-actions">
                        <a href="<?php echo home_url('/winkel/'); ?>" class="btn btn-sage">Bekijk alle producten</a>
                        <a href="<?php echo home_url('/waxen/'); ?>" class="btn btn-secondary">Lees de waxing gids</a>
                    </div>
                </div>
                
            <?php endif; ?>
            
        </div>
    </section>
    
</main>

<style>
/* Search Header */
.search-header {
    padding: 100px 0 48px;
    background: var(--cream-dark);
}

.search-title {
    font-size: clamp(28px, 4vw, 40px);
    margin-bottom: 32px;
}

.search-form-wrapper {
    max-width: 600px;
}

.search-form-large {
    display: flex;
    gap: 12px;
}

.search-form-large .search-input {
    flex: 1;
    padding: 16px 24px;
    border: 1px solid var(--border);
    border-radius: var(--radius-full);
    font-size: 16px;
    background: white;
}

.search-form-large .search-input:focus {
    outline: none;
    border-color: var(--sage);
}

.search-form-large .btn {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Search Results Section */
.search-results-section {
    padding: 48px 0 80px;
}

/* Filters */
.search-filters {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.filter-label {
    font-size: 14px;
    font-weight: 600;
    color: #666;
}

.filter-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-full);
    font-size: 14px;
    color: var(--dark);
    transition: all var(--transition-fast);
}

.filter-tab:hover {
    border-color: var(--sage);
}

.filter-tab.active {
    background: var(--sage);
    border-color: var(--sage);
    color: white;
}

.filter-tab .count {
    font-size: 12px;
    opacity: 0.7;
}

/* Results Grid */
.search-results-grid {
    display: grid;
    gap: 24px;
}

.search-result {
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    overflow: hidden;
    transition: all var(--transition-fast);
}

.search-result:hover {
    border-color: var(--sage);
    box-shadow: var(--shadow-md);
}

.result-link {
    display: flex;
    gap: 24px;
    padding: 24px;
}

.result-image {
    flex-shrink: 0;
    width: 120px;
    height: 120px;
    border-radius: var(--radius-sm);
    overflow: hidden;
    background: var(--cream-dark);
}

.result-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.result-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ccc;
}

.result-content {
    flex: 1;
    min-width: 0;
}

.result-type {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--sage);
    margin-bottom: 8px;
}

.result-title {
    font-size: 18px;
    margin-bottom: 8px;
    color: var(--dark);
    line-height: 1.3;
}

.result-excerpt {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 12px;
}

.result-price {
    font-size: 16px;
    font-weight: 600;
    color: var(--dark);
}

.result-link-text {
    font-size: 14px;
    font-weight: 600;
    color: var(--sage);
}

/* Pagination */
.search-pagination {
    margin-top: 48px;
    display: flex;
    justify-content: center;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 60px 20px;
    max-width: 500px;
    margin: 0 auto;
}

.no-results-icon {
    color: #ccc;
    margin-bottom: 24px;
}

.no-results h2 {
    font-size: 28px;
    margin-bottom: 12px;
}

.no-results > p {
    color: #666;
    margin-bottom: 32px;
}

.no-results-suggestions {
    background: var(--cream-dark);
    padding: 24px;
    border-radius: var(--radius-md);
    text-align: left;
    margin-bottom: 32px;
}

.no-results-suggestions h3 {
    font-size: 16px;
    margin-bottom: 12px;
}

.no-results-suggestions ul {
    list-style: disc;
    padding-left: 20px;
    color: #666;
    font-size: 14px;
}

.no-results-suggestions li {
    margin-bottom: 8px;
}

.no-results-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 600px) {
    .result-link {
        flex-direction: column;
        gap: 16px;
    }
    
    .result-image {
        width: 100%;
        height: 180px;
    }
    
    .search-form-large {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>
