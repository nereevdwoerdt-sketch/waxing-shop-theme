<?php
/**
 * Template Name: Groothandel (Waxclusive)
 * Description: Landing page voor B2B/salons met doorverwijzing naar Waxclusive
 *
 * @package Waxing_Shop
 * @since 5.8
 */

get_header();
?>

<main class="groothandel-page">

    <!-- Hero -->
    <section class="groothandel-hero">
        <div class="container">
            <p class="hero-eyebrow"><?php esc_html_e('Voor salons & professionals', 'waxing-shop'); ?></p>
            <h1 class="page-title">Waxclusive<br><em><?php esc_html_e('Groothandel', 'waxing-shop'); ?></em></h1>
            <p class="page-intro"><?php esc_html_e('Dezelfde premium wax die je kent van Waxing Shop, nu met groothandelsprijzen voor professionals.', 'waxing-shop'); ?></p>
        </div>
    </section>

    <!-- Voordelen -->
    <section class="groothandel-benefits">
        <div class="container">
            <div class="benefits-grid">
                <div class="benefit-card">
                    <span class="benefit-icon">💰</span>
                    <h3><?php esc_html_e('Groothandelsprijzen', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Tot 40% korting op alle producten. Hoe meer je bestelt, hoe voordeliger.', 'waxing-shop'); ?></p>
                </div>
                <div class="benefit-card">
                    <span class="benefit-icon">📦</span>
                    <h3><?php esc_html_e('Flexibele afname', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Minimale afname vanaf 10 stuks. Geen gedoe met grote voorraden.', 'waxing-shop'); ?></p>
                </div>
                <div class="benefit-card">
                    <span class="benefit-icon">🚚</span>
                    <h3><?php esc_html_e('Snelle levering', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Vandaag besteld, morgen in huis. Altijd op voorraad.', 'waxing-shop'); ?></p>
                </div>
                <div class="benefit-card">
                    <span class="benefit-icon">👤</span>
                    <h3><?php esc_html_e('Persoonlijk contact', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Direct contact met Hans, 20+ jaar ervaring in de waxbranche.', 'waxing-shop'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Producten preview -->
    <section class="groothandel-products">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Ons assortiment', 'waxing-shop'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Portugese premium kwaliteit, vertrouwd door 2.500+ salons', 'waxing-shop'); ?></p>

            <div class="product-categories">
                <div class="product-cat">
                    <span class="cat-icon">🍯</span>
                    <h4><?php esc_html_e('Hot Wax', 'waxing-shop'); ?></h4>
                    <p><?php esc_html_e('7 varianten voor elke huidtype', 'waxing-shop'); ?></p>
                </div>
                <div class="product-cat">
                    <span class="cat-icon">🔥</span>
                    <h4><?php esc_html_e('Verwarmers', 'waxing-shop'); ?></h4>
                    <p><?php esc_html_e('Professionele apparatuur', 'waxing-shop'); ?></p>
                </div>
                <div class="product-cat">
                    <span class="cat-icon">🧴</span>
                    <h4><?php esc_html_e('Verzorging', 'waxing-shop'); ?></h4>
                    <p><?php esc_html_e('Pre & post wax producten', 'waxing-shop'); ?></p>
                </div>
                <div class="product-cat">
                    <span class="cat-icon">🔧</span>
                    <h4><?php esc_html_e('Accessoires', 'waxing-shop'); ?></h4>
                    <p><?php esc_html_e('Spatels, strips, meer', 'waxing-shop'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Sectie -->
    <section class="groothandel-cta">
        <div class="container">
            <div class="cta-grid">

                <!-- Optie 1: Lead capture -->
                <div class="cta-card cta-card-lead">
                    <h3><?php esc_html_e('Vrijblijvende offerte', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Ontvang een offerte op maat voor jouw salon.', 'waxing-shop'); ?></p>

                    <form class="lead-form" action="#" method="post">
                        <input type="text" name="salon_name" placeholder="<?php esc_attr_e('Naam salon', 'waxing-shop'); ?>" required>
                        <input type="email" name="email" placeholder="<?php esc_attr_e('E-mailadres', 'waxing-shop'); ?>" required>
                        <input type="tel" name="phone" placeholder="<?php esc_attr_e('Telefoonnummer', 'waxing-shop'); ?>">
                        <button type="submit" class="btn btn-sage btn-block">
                            <?php esc_html_e('Vraag offerte aan', 'waxing-shop'); ?>
                        </button>
                    </form>
                    <p class="form-note"><?php esc_html_e('Reactie binnen 24 uur', 'waxing-shop'); ?></p>
                </div>

                <!-- Optie 2: Direct naar Waxclusive -->
                <div class="cta-card cta-card-direct">
                    <h3><?php esc_html_e('Direct bestellen?', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Ga naar de Waxclusive webshop voor het volledige B2B assortiment en prijzen.', 'waxing-shop'); ?></p>

                    <a href="https://waxclusive.nl" target="_blank" rel="noopener" class="btn btn-outline btn-block">
                        <?php esc_html_e('Naar Waxclusive.nl', 'waxing-shop'); ?> →
                    </a>

                    <ul class="direct-benefits">
                        <li><?php esc_html_e('KvK verificatie voor B2B prijzen', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Bestel 24/7 online', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Factuur achteraf mogelijk', 'waxing-shop'); ?></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Trust signals -->
    <section class="groothandel-trust">
        <div class="container">
            <div class="trust-stats">
                <div class="trust-stat">
                    <span class="stat-value">2.500+</span>
                    <span class="stat-label"><?php esc_html_e('Salons vertrouwen ons', 'waxing-shop'); ?></span>
                </div>
                <div class="trust-stat">
                    <span class="stat-value">20+</span>
                    <span class="stat-label"><?php esc_html_e('Jaar ervaring', 'waxing-shop'); ?></span>
                </div>
                <div class="trust-stat">
                    <span class="stat-value">9.0</span>
                    <span class="stat-label"><?php esc_html_e('Klantwaardering', 'waxing-shop'); ?></span>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
