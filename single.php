<?php
/**
 * Single Post Template
 * 
 * Template for displaying individual blog posts
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();

// Get reading time using theme function
$reading_time = waxing_reading_time();

// Get categories
$categories = get_the_category();
$primary_cat = !empty($categories) ? $categories[0] : null;
?>

<main id="primary" class="single-post" itemscope itemtype="https://schema.org/BlogPosting">
    
    <article>
        <!-- Post Header -->
        <header class="post-header">
            <div class="container">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="<?php echo home_url(); ?>"><span itemprop="name">Home</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="<?php echo home_url('/blog/'); ?>"><span itemprop="name">Blog</span></a>
                            <meta itemprop="position" content="2" />
                        </li>
                        <?php if ($primary_cat) : ?>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="<?php echo get_category_link($primary_cat->term_id); ?>">
                                <span itemprop="name"><?php echo esc_html($primary_cat->name); ?></span>
                            </a>
                            <meta itemprop="position" content="3" />
                        </li>
                        <?php endif; ?>
                    </ol>
                </nav>
                
                <div class="post-header-content">
                    <?php if ($primary_cat) : ?>
                    <a href="<?php echo get_category_link($primary_cat->term_id); ?>" class="post-category-link">
                        <?php echo esc_html($primary_cat->name); ?>
                    </a>
                    <?php endif; ?>
                    
                    <h1 class="post-title" itemprop="headline"><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                    <p class="post-excerpt" itemprop="description"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                    
                    <div class="post-meta-bar">
                        <div class="post-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <?php echo get_avatar(get_the_author_meta('ID'), 40); ?>
                            <div class="author-info">
                                <span class="author-name" itemprop="name"><?php the_author(); ?></span>
                                <span class="author-title">Waxing Expert</span>
                            </div>
                        </div>
                        
                        <div class="post-details">
                            <span class="post-date">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                                    <?php echo get_the_date('j F Y'); ?>
                                </time>
                            </span>
                            <span class="post-reading-time">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                <?php echo esc_html($reading_time); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
        <figure class="post-featured-image">
            <div class="container">
                <?php the_post_thumbnail('full', array('itemprop' => 'image')); ?>
                <?php 
                $caption = get_the_post_thumbnail_caption();
                if ($caption) : 
                ?>
                <figcaption><?php echo esc_html($caption); ?></figcaption>
                <?php endif; ?>
            </div>
        </figure>
        <?php endif; ?>
        
        <!-- Post Content -->
        <div class="post-content-wrapper">
            <div class="container">
                <div class="post-layout">
                    
                    <!-- Share Sidebar (sticky) -->
                    <aside class="share-sidebar" aria-label="Delen">
                        <div class="share-sticky">
                            <span class="share-label">Delen</span>
                            <div class="share-buttons">
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="share-btn share-twitter"
                                   aria-label="Deel op Twitter">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="share-btn share-facebook"
                                   aria-label="Deel op Facebook">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="share-btn share-linkedin"
                                   aria-label="Deel op LinkedIn">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_the_excerpt() . "\n\n" . get_permalink()); ?>" 
                                   class="share-btn share-email"
                                   aria-label="Deel via e-mail">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4,4 L20,4 C21.1,4 22,4.9 22,6 L22,18 C22,19.1 21.1,20 20,20 L4,20 C2.9,20 2,19.1 2,18 L2,6 C2,4.9 2.9,4 4,4 Z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </a>
                                <button class="share-btn share-copy" onclick="navigator.clipboard.writeText('<?php echo get_permalink(); ?>')" aria-label="Kopieer link">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10,13 C10.4295,13.5741 10.9774,14.0491 11.6066,14.3929 C12.2357,14.7367 12.9315,14.9411 13.6467,14.9923 C14.3618,15.0435 15.0796,14.9403 15.7513,14.6897 C16.4231,14.4392 17.0331,14.047 17.54,13.54 L20.54,10.54 C21.4508,9.59695 21.9548,8.33394 21.9434,7.02296 C21.932,5.71198 21.4061,4.45791 20.479,3.52082 C19.552,2.58373 18.298,2.05787 16.987,2.04647 C15.676,2.03507 14.413,2.53905 13.47,3.44995 L11.75,5.16995"></path>
                                        <path d="M14,11 C13.5705,10.4259 13.0226,9.9508 12.3934,9.60707 C11.7642,9.26334 11.0685,9.05886 10.3533,9.00769 C9.63816,8.95652 8.92037,9.05969 8.24861,9.31025 C7.57685,9.5608 6.96684,9.95294 6.45996,10.46 L3.45996,13.46 C2.54917,14.403 2.04519,15.666 2.05659,16.977 C2.06799,18.288 2.59385,19.5421 3.52094,20.4791 C4.44803,21.4162 5.7021,21.9421 7.01308,21.9535 C8.32406,21.9649 9.58704,21.4609 10.53,20.55 L12.24,18.84"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </aside>
                    
                    <!-- Main Content -->
                    <div class="post-content" itemprop="articleBody">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Sidebar -->
                    <aside class="post-sidebar">
                        <div class="sidebar-sticky">
                            
                            <!-- Table of Contents (auto-generated) -->
                            <div class="sidebar-widget toc-widget">
                                <h4 class="sidebar-title">In dit artikel</h4>
                                <nav class="post-toc" id="post-toc">
                                    <!-- Generated by JS -->
                                </nav>
                            </div>
                            
                            <!-- Related Products -->
                            <div class="sidebar-widget">
                                <h4 class="sidebar-title">Aanbevolen</h4>
                                <?php echo do_shortcode('[starter_sets count="1" compact="true"]'); ?>
                            </div>
                            
                        </div>
                    </aside>
                    
                </div>
            </div>
        </div>
        
        <!-- Post Footer -->
        <footer class="post-footer">
            <div class="container">
                
                <!-- Tags -->
                <?php 
                $tags = get_the_tags();
                if ($tags) : 
                ?>
                <div class="post-tags">
                    <span class="tags-label">Tags:</span>
                    <div class="tags-list">
                        <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-link">
                            <?php echo esc_html($tag->name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Author Box -->
                <div class="author-box">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="author-content">
                        <span class="author-label">Geschreven door</span>
                        <h3 class="author-name"><?php the_author(); ?></h3>
                        <p class="author-bio">
                            <?php 
                            $bio = get_the_author_meta('description');
                            echo $bio ? $bio : 'Waxing expert met jarenlange ervaring in het adviseren van zowel professionals als thuisgebruikers.';
                            ?>
                        </p>
                    </div>
                </div>
                
                <!-- Post Navigation -->
                <nav class="post-navigation" aria-label="Artikelen">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post); ?>" class="post-nav-link post-nav-prev">
                        <span class="post-nav-label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12,19 5,12 12,5"></polyline>
                            </svg>
                            Vorig artikel
                        </span>
                        <span class="post-nav-title"><?php echo get_the_title($prev_post); ?></span>
                    </a>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post); ?>" class="post-nav-link post-nav-next">
                        <span class="post-nav-label">
                            Volgend artikel
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12,5 19,12 12,19"></polyline>
                            </svg>
                        </span>
                        <span class="post-nav-title"><?php echo get_the_title($next_post); ?></span>
                    </a>
                    <?php endif; ?>
                </nav>
                
            </div>
        </footer>
        
    </article>
    
    <!-- Related Posts -->
    <section class="related-posts-section">
        <div class="container">
            <div class="section-header" style="text-align:center;margin-bottom:48px;">
                <p class="section-eyebrow" style="justify-content:center;">Meer lezen</p>
                <h2 class="section-title">Gerelateerde artikelen</h2>
            </div>
            
            <div class="related-posts-grid">
                <?php
                $related_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
                );
                
                if ($primary_cat) {
                    $related_args['cat'] = $primary_cat->term_id;
                }
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) : $related_query->the_post();
                ?>
                
                <article class="blog-card">
                    <a href="<?php the_permalink(); ?>" class="blog-card-link">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="blog-card-image">
                            <?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?>
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
                            
                            <h3 class="blog-card-title"><?php the_title(); ?></h3>
                            
                            <p class="blog-card-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            
                            <div class="blog-card-footer">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('j M Y'); ?>
                                </time>
                            </div>
                        </div>
                    </a>
                </article>
                
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="post-cta-section">
        <div class="container">
            <div class="cta-box">
                <h2>Klaar om te beginnen met waxen?</h2>
                <p>Ontdek onze startersets met alles wat je nodig hebt voor professionele resultaten thuis.</p>
                <div class="cta-buttons">
                    <a href="<?php echo home_url('/#sets'); ?>" class="btn btn-primary">Bekijk startersets →</a>
                    <a href="<?php echo home_url('/waxen/'); ?>" class="btn btn-secondary">Lees de complete gids</a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<script>
// Generate Table of Contents from H2 headings
document.addEventListener('DOMContentLoaded', function() {
    const content = document.querySelector('.post-content');
    const toc = document.getElementById('post-toc');
    const headings = content.querySelectorAll('h2');
    
    if (headings.length > 0 && toc) {
        const list = document.createElement('ul');
        
        headings.forEach((heading, index) => {
            // Add ID to heading if not exists
            if (!heading.id) {
                heading.id = 'section-' + index;
            }
            
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = '#' + heading.id;
            a.textContent = heading.textContent;
            li.appendChild(a);
            list.appendChild(li);
        });
        
        toc.appendChild(list);
    }
});
</script>

<?php get_footer(); ?>
