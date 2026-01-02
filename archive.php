<?php
/**
 * Blog Archive Template
 * 
 * Displays list of blog posts
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();

// Get current category if on category archive
$current_cat = get_queried_object();
$is_category = is_category();
?>

<main id="primary" class="blog-archive">
    
    <!-- Blog Header -->
    <section class="blog-header">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo home_url(); ?>"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <?php if ($is_category) : ?>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><span itemprop="name">Blog</span></a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name"><?php echo esc_html($current_cat->name); ?></span>
                        <meta itemprop="position" content="3" />
                    </li>
                    <?php else : ?>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name">Blog</span>
                        <meta itemprop="position" content="2" />
                    </li>
                    <?php endif; ?>
                </ol>
            </nav>
            
            <div class="blog-header-content">
                <p class="hero-eyebrow">Waxing Academy</p>
                <?php if ($is_category) : ?>
                    <h1 class="page-title"><?php echo esc_html($current_cat->name); ?></h1>
                    <?php if ($current_cat->description) : ?>
                        <p class="page-intro"><?php echo esc_html($current_cat->description); ?></p>
                    <?php endif; ?>
                <?php else : ?>
                    <h1 class="page-title">Tips, tutorials & meer</h1>
                    <p class="page-intro">Alles wat je moet weten over waxen, huidverzorging en de beste resultaten. Geschreven door experts met meer dan 20 jaar ervaring.</p>
                <?php endif; ?>
            </div>
            
            <!-- Category Filter -->
            <div class="blog-categories">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="category-tag <?php echo !$is_category ? 'active' : ''; ?>">
                    Alles
                </a>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'number' => 6,
                    'hide_empty' => true
                ));
                foreach ($categories as $cat) :
                    $active = ($is_category && $current_cat->term_id === $cat->term_id) ? 'active' : '';
                ?>
                <a href="<?php echo get_category_link($cat->term_id); ?>" class="category-tag <?php echo $active; ?>">
                    <?php echo esc_html($cat->name); ?>
                    <span class="category-count"><?php echo $cat->count; ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Blog Posts Grid -->
    <section class="blog-posts-section">
        <div class="container">
            
            <?php if (have_posts()) : ?>
            
                <!-- Featured Post (first post on first page) -->
                <?php if (!is_paged() && !$is_category) : ?>
                    <?php 
                    the_post();
                    $featured_id = get_the_ID();
                    ?>
                    <article class="featured-post" itemscope itemtype="https://schema.org/BlogPosting">
                        <a href="<?php the_permalink(); ?>" class="featured-post-link">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-post-image">
                                <?php the_post_thumbnail('large', array('itemprop' => 'image')); ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="featured-post-content">
                                <div class="post-meta">
                                    <?php 
                                    $cats = get_the_category();
                                    if (!empty($cats)) : 
                                    ?>
                                    <span class="post-category"><?php echo esc_html($cats[0]->name); ?></span>
                                    <?php endif; ?>
                                    <span class="post-date">
                                        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                            <?php echo get_the_date('j F Y'); ?>
                                        </time>
                                    </span>
                                </div>
                                
                                <h2 class="featured-post-title" itemprop="headline"><?php the_title(); ?></h2>
                                
                                <p class="featured-post-excerpt" itemprop="description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                                </p>
                                
                                <span class="read-more">Lees artikel →</span>
                            </div>
                        </a>
                    </article>
                <?php endif; ?>
                
                <!-- Posts Grid -->
                <div class="blog-grid">
                    <?php 
                    while (have_posts()) : the_post();
                        // Skip featured post
                        if (isset($featured_id) && get_the_ID() === $featured_id) continue;
                    ?>
                    
                    <article class="blog-card" itemscope itemtype="https://schema.org/BlogPosting">
                        <a href="<?php the_permalink(); ?>" class="blog-card-link">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-card-image">
                                <?php the_post_thumbnail('medium_large', array('itemprop' => 'image', 'loading' => 'lazy')); ?>
                            </div>
                            <?php else : ?>
                            <div class="blog-card-image blog-card-image-placeholder">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21,15 16,10 5,21"></polyline>
                                </svg>
                            </div>
                            <?php endif; ?>
                            
                            <div class="blog-card-content">
                                <div class="post-meta">
                                    <?php 
                                    $cats = get_the_category();
                                    if (!empty($cats)) : 
                                    ?>
                                    <span class="post-category"><?php echo esc_html($cats[0]->name); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <h3 class="blog-card-title" itemprop="headline"><?php the_title(); ?></h3>
                                
                                <p class="blog-card-excerpt" itemprop="description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                                </p>
                                
                                <div class="blog-card-footer">
                                    <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                        <?php echo get_the_date('j M Y'); ?>
                                    </time>
                                    <span class="read-time">
                                        <?php echo waxing_get_reading_time_int(); ?> min
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                    
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <nav class="blog-pagination" aria-label="Paginatie">
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
                
                <div class="no-posts">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M14,2 L6,2 C4.9,2 4,2.9 4,4 L4,20 C4,21.1 4.9,22 6,22 L18,22 C19.1,22 20,21.1 20,20 L20,8 L14,2 Z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                    </svg>
                    <h2>Geen artikelen gevonden</h2>
                    <p>Er zijn nog geen artikelen in deze categorie.</p>
                    <a href="<?php echo home_url('/blog/'); ?>" class="btn btn-sage">Bekijk alle artikelen</a>
                </div>
                
            <?php endif; ?>
            
        </div>
    </section>
    
    <!-- Newsletter Section -->
    <section class="blog-newsletter">
        <div class="container">
            <div class="newsletter-box">
                <div class="newsletter-content">
                    <h2>Blijf op de hoogte</h2>
                    <p>Ontvang tips, tutorials en exclusieve aanbiedingen in je inbox.</p>
                </div>
                <form class="newsletter-form" action="#" method="post">
                    <input type="email" name="email" placeholder="Je e-mailadres" required>
                    <button type="submit" class="btn btn-sage">Aanmelden</button>
                </form>
            </div>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>
