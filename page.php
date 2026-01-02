<?php
/**
 * Default Page Template
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();
?>

<main id="primary" class="default-page">
    
    <?php while (have_posts()) : the_post(); ?>
    
    <!-- Page Header -->
    <section class="page-hero page-hero-compact">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo home_url(); ?>"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <?php
                    // Get parent pages
                    $ancestors = get_post_ancestors($post);
                    if ($ancestors) {
                        $ancestors = array_reverse($ancestors);
                        $position = 2;
                        foreach ($ancestors as $ancestor) {
                            ?>
                            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo get_permalink($ancestor); ?>">
                                    <span itemprop="name"><?php echo get_the_title($ancestor); ?></span>
                                </a>
                                <meta itemprop="position" content="<?php echo $position; ?>" />
                            </li>
                            <?php
                            $position++;
                        }
                    }
                    ?>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name"><?php the_title(); ?></span>
                        <meta itemprop="position" content="<?php echo count($ancestors) + 2; ?>" />
                    </li>
                </ol>
            </nav>
            
            <h1 class="page-title"><?php the_title(); ?></h1>
            
            <?php if (has_excerpt()) : ?>
            <p class="page-intro"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- Page Content -->
    <article class="page-content-wrapper">
        <div class="container">
            <div class="page-content">
                <?php the_content(); ?>
                
                <?php
                // Page links for multi-page content
                wp_link_pages(array(
                    'before' => '<nav class="page-links"><span class="page-links-title">Pagina\'s:</span>',
                    'after' => '</nav>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                ));
                ?>
            </div>
        </div>
    </article>
    
    <?php endwhile; ?>
    
    <!-- Child Pages (if any) -->
    <?php
    $children = get_pages(array(
        'child_of' => get_the_ID(),
        'sort_column' => 'menu_order',
        'number' => 6
    ));
    
    if ($children) :
    ?>
    <section class="child-pages-section section">
        <div class="container">
            <h2 class="section-title" style="margin-bottom:32px;">Gerelateerde pagina's</h2>
            <div class="child-pages-grid">
                <?php foreach ($children as $child) : ?>
                <a href="<?php echo get_permalink($child); ?>" class="child-page-card">
                    <h3><?php echo get_the_title($child); ?></h3>
                    <?php if ($child->post_excerpt) : ?>
                    <p><?php echo $child->post_excerpt; ?></p>
                    <?php else : ?>
                    <p><?php echo wp_trim_words($child->post_content, 15); ?></p>
                    <?php endif; ?>
                    <span class="child-page-link">Lees meer →</span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
</main>

<style>
.default-page .page-hero-compact {
    padding: 100px 0 48px;
}

.default-page .page-title {
    font-size: clamp(32px, 5vw, 48px);
    margin-bottom: 16px;
}

.default-page .page-intro {
    font-size: 18px;
    color: #555;
    max-width: 700px;
}

.page-content-wrapper {
    padding: 48px 0 80px;
}

.page-content {
    max-width: 800px;
    font-size: 17px;
    line-height: 1.8;
}

.page-content h2 {
    font-size: 28px;
    margin-top: 48px;
    margin-bottom: 20px;
}

.page-content h3 {
    font-size: 22px;
    margin-top: 32px;
    margin-bottom: 16px;
}

.page-content p {
    margin-bottom: 20px;
}

.page-content a {
    color: var(--sage);
    text-decoration: underline;
    text-underline-offset: 3px;
}

.page-content ul,
.page-content ol {
    margin: 20px 0;
    padding-left: 24px;
}

.page-content li {
    margin-bottom: 10px;
}

.page-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-md);
    margin: 32px 0;
}

.page-content blockquote {
    margin: 32px 0;
    padding: 24px 32px;
    background: var(--cream-dark);
    border-left: 4px solid var(--sage);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
}

.page-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 32px 0;
}

.page-content th,
.page-content td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

.page-content th {
    background: var(--cream-dark);
    font-weight: 600;
}

/* Page Links */
.page-links {
    margin-top: 48px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}

.page-links-title {
    font-weight: 600;
    margin-right: 12px;
}

.page-links span {
    display: inline-block;
    padding: 8px 14px;
    margin: 0 4px;
    background: var(--cream-dark);
    border-radius: var(--radius-sm);
}

/* Child Pages */
.child-pages-section {
    background: var(--cream-dark);
}

.child-pages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
}

.child-page-card {
    display: block;
    padding: 24px;
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    transition: all var(--transition-fast);
}

.child-page-card:hover {
    border-color: var(--sage);
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.child-page-card h3 {
    font-size: 18px;
    margin-bottom: 8px;
    color: var(--dark);
}

.child-page-card p {
    font-size: 14px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 12px;
}

.child-page-link {
    font-size: 14px;
    font-weight: 600;
    color: var(--sage);
}
</style>

<?php get_footer(); ?>
