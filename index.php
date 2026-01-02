<?php get_header(); ?>

<div class="container" style="padding: 80px 0;">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header><h1><?php the_title(); ?></h1></header>
                <div class="entry-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>Geen content gevonden.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
