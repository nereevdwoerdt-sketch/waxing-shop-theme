</main><!-- #main -->

<!-- Newsletter Section -->
<section class="newsletter-section" aria-labelledby="newsletter-title">
    <div class="newsletter-content">
        <h3 class="newsletter-title" id="newsletter-title"><?php esc_html_e('10% korting op je eerste bestelling', 'waxing-shop'); ?></h3>
        <p class="newsletter-subtitle"><?php esc_html_e('Schrijf je in voor tips, tutorials en exclusieve aanbiedingen.', 'waxing-shop'); ?></p>
        <form class="newsletter-form" id="newsletterForm">
            <label for="newsletterEmail" class="sr-only"><?php esc_html_e('E-mailadres', 'waxing-shop'); ?></label>
            <input type="email" id="newsletterEmail" class="newsletter-input" placeholder="<?php esc_attr_e('Je e-mailadres', 'waxing-shop'); ?>" required>
            <button type="submit" class="newsletter-btn"><?php esc_html_e('Inschrijven', 'waxing-shop'); ?></button>
        </form>
        <p class="newsletter-message" id="newsletterMessage" style="margin-top:12px;display:none;" aria-live="polite"></p>
    </div>
</section>

<!-- Footer -->
<footer class="site-footer" role="contentinfo">
    <div class="footer-grid footer-grid-4col">
        <!-- Brand Column -->
        <div class="footer-brand">
            <p class="footer-logo">Waxing Shop</p>
            <p class="footer-desc"><?php esc_html_e('Premium hotwax voor professionele resultaten thuis. Ontwikkeld met 20 jaar salonervaring.', 'waxing-shop'); ?></p>

            <!-- Contact info -->
            <div class="footer-contact">
                <p><a href="tel:0636092340">📞 06 360 923 40</a></p>
                <p><a href="mailto:info@waxing-shop.nl">✉️ info@waxing-shop.nl</a></p>
            </div>

            <div class="footer-social">
                <a href="https://instagram.com/waxingshop.nl" aria-label="Instagram" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a href="https://facebook.com/waxingshop.nl" aria-label="Facebook" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Column 1: Shop -->
        <div class="footer-column">
            <h4><?php esc_html_e('Shop', 'waxing-shop'); ?></h4>
            <nav class="footer-links" aria-label="<?php esc_attr_e('Shop links', 'waxing-shop'); ?>">
                <a href="<?php echo esc_url(home_url('/product-categorie/pakketten/')); ?>"><?php esc_html_e('Startersets', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/product-categorie/hot-wax/')); ?>"><?php esc_html_e('Wax', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/product-categorie/apparatuur/')); ?>"><?php esc_html_e('Verwarmers', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/product-categorie/verzorging/')); ?>"><?php esc_html_e('Verzorging', 'waxing-shop'); ?></a>
            </nav>
        </div>

        <!-- Column 2: Hulp -->
        <div class="footer-column">
            <h4><?php esc_html_e('Hulp', 'waxing-shop'); ?></h4>
            <nav class="footer-links" aria-label="<?php esc_attr_e('Hulp links', 'waxing-shop'); ?>">
                <a href="<?php echo esc_url(home_url('/waxen/')); ?>"><?php esc_html_e('Waxen Gids', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/academy/')); ?>"><?php esc_html_e('Academy', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/blog/')); ?>"><?php esc_html_e('Blog', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/waxen/#faq')); ?>"><?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact', 'waxing-shop'); ?></a>
            </nav>
        </div>

        <!-- Column 3: Bedrijf -->
        <div class="footer-column">
            <h4><?php esc_html_e('Bedrijf', 'waxing-shop'); ?></h4>
            <nav class="footer-links" aria-label="<?php esc_attr_e('Bedrijf links', 'waxing-shop'); ?>">
                <a href="<?php echo esc_url(home_url('/over-ons/')); ?>"><?php esc_html_e('Over Ons', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/wax-kopen-groothandel/')); ?>"><?php esc_html_e('Groothandel / B2B', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/verzending-retour/')); ?>"><?php esc_html_e('Verzending', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/algemene-voorwaarden/')); ?>"><?php esc_html_e('Voorwaarden', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/privacy-policy-2/')); ?>"><?php esc_html_e('Privacy', 'waxing-shop'); ?></a>
            </nav>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>
            © <?php echo date('Y'); ?> Waxing Shop. 
            <?php esc_html_e('Alle rechten voorbehouden.', 'waxing-shop'); ?>
        </p>
        <p class="footer-legal">
            KvK: [nummer invullen] | BTW: [nummer invullen]
        </p>
        <div class="footer-payments" aria-label="<?php esc_attr_e('Betaalmethoden', 'waxing-shop'); ?>">
            <span title="iDEAL" aria-label="iDEAL">🏦</span>
            <span title="Creditcard" aria-label="Creditcard">💳</span>
            <span title="PayPal" aria-label="PayPal">📱</span>
        </div>
    </div>
</footer>

<!-- Sticky Add to Cart (Mobile) -->
<div class="sticky-atc" id="stickyAtc" aria-hidden="true">
    <div class="sticky-atc-info">
        <p class="sticky-atc-name" id="stickyAtcName"></p>
        <p class="sticky-atc-price" id="stickyAtcPrice"></p>
    </div>
    <button class="btn btn-sage sticky-atc-btn" id="stickyAtcBtn"><?php esc_html_e('Toevoegen', 'waxing-shop'); ?></button>
</div>

<?php wp_footer(); ?>
</body>
</html>
