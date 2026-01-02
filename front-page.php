<?php
/**
 * Front Page Template
 * 
 * @package Waxing_Shop
 * @since 3.1
 */
get_header();
?>

<!-- Hero Section -->
<section class="hero-section" aria-labelledby="hero-title">
    <div class="hero-background" aria-hidden="true">
        <div class="hero-gradient hero-gradient-1"></div>
        <div class="hero-gradient hero-gradient-2"></div>
        <div class="hero-gradient hero-gradient-3"></div>
    </div>

    <div class="hero-content reveal">
        <p class="hero-eyebrow"><?php esc_html_e('Vertrouwd door 2.500+ salons', 'waxing-shop'); ?></p>
        <h1 class="hero-title" id="hero-title">Salonkwaliteit wax.<br><em>Nu ook voor thuis.</em></h1>
        <p class="hero-subtitle"><?php esc_html_e('De premium wax die professionals gebruiken. Bestel voor jezelf of voor je salon.', 'waxing-shop'); ?></p>

        <!-- CTA Buttons -->
        <div class="hero-buttons">
            <a href="#sets" class="btn btn-sage btn-lg"><?php esc_html_e('Bekijk startersets', 'waxing-shop'); ?></a>
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="btn btn-secondary btn-lg"><?php esc_html_e('Alle producten', 'waxing-shop'); ?></a>
        </div>

        <div class="hero-features" role="list" aria-label="<?php esc_attr_e('Belangrijke cijfers', 'waxing-shop'); ?>">
            <div class="hero-feature" role="listitem">
                <p class="hero-feature-value">9.0</p>
                <p class="hero-feature-label"><?php esc_html_e('Bol.com rating', 'waxing-shop'); ?></p>
            </div>
            <div class="hero-feature" role="listitem">
                <p class="hero-feature-value">4-6</p>
                <p class="hero-feature-label"><?php esc_html_e('Weken glad', 'waxing-shop'); ?></p>
            </div>
            <div class="hero-feature" role="listitem">
                <p class="hero-feature-value">20+</p>
                <p class="hero-feature-label"><?php esc_html_e('Jaar ervaring', 'waxing-shop'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Starter Sets Section -->
<section id="sets" class="sets-section section" aria-labelledby="sets-title">
    <div class="section-header reveal section-header--centered">
        <p class="section-eyebrow section-eyebrow--centered"><?php esc_html_e('Van nul naar zijdezacht', 'waxing-shop'); ?></p>
        <h2 class="section-title" id="sets-title"><?php esc_html_e('Complete startersets', 'waxing-shop'); ?></h2>
        <p class="section-subtitle section-subtitle--centered"><?php esc_html_e('Alles wat je nodig hebt in één pakket. Inclusief handleiding. Direct beginnen.', 'waxing-shop'); ?></p>
    </div>

    <div class="reveal">
        <?php echo do_shortcode('[starter_sets]'); ?>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="section section--cream" aria-labelledby="products-title">
    <div class="section-header section-header--split reveal">
        <div>
            <p class="section-eyebrow"><?php esc_html_e('Losse producten', 'waxing-shop'); ?></p>
            <h2 class="section-title" id="products-title"><?php esc_html_e('Hotwax collectie', 'waxing-shop'); ?></h2>
        </div>
        <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : '/shop'); ?>" class="btn btn-secondary"><?php esc_html_e('Bekijk alles', 'waxing-shop'); ?> →</a>
    </div>

    <div class="reveal section-content--contained">
        <?php echo do_shortcode('[waxing_products count="4"]'); ?>
    </div>
</section>

<!-- Quiz Section -->
<section id="quiz" class="quiz-section section" aria-labelledby="quiz-title">
    <div class="section-header section-header--centered reveal">
        <p class="section-eyebrow section-eyebrow--centered"><?php esc_html_e('Persoonlijk advies', 'waxing-shop'); ?></p>
        <h2 class="section-title" id="quiz-title"><?php esc_html_e('Welke wax past bij jou?', 'waxing-shop'); ?></h2>
        <p class="section-subtitle section-subtitle--centered"><?php esc_html_e('Beantwoord 4 vragen en ontdek jouw perfecte match.', 'waxing-shop'); ?></p>
    </div>

    <div class="reveal">
        <?php echo do_shortcode('[wax_quiz]'); ?>
    </div>
</section>

<!-- Testimonials Section -->
<section id="reviews" class="reviews-section section" aria-labelledby="reviews-title">
    <div class="section-header section-header--centered reveal">
        <p class="section-eyebrow section-eyebrow--centered"><?php esc_html_e('9.0 op Bol.com', 'waxing-shop'); ?></p>
        <h2 class="section-title" id="reviews-title"><?php esc_html_e('Waarom klanten fan zijn', 'waxing-shop'); ?></h2>
    </div>

    <div class="reveal">
        <?php echo do_shortcode('[testimonials]'); ?>
    </div>
</section>


<!-- Savings Calculator Section -->
<section id="calculator" class="calculator-section section section--cream" aria-labelledby="calculator-title">
    <div class="section-header section-header--centered reveal">
        <p class="section-eyebrow section-eyebrow--centered"><?php esc_html_e('Bespaar honderden euro\'s', 'waxing-shop'); ?></p>
        <h2 class="section-title" id="calculator-title"><?php esc_html_e('Salon vs. Thuis', 'waxing-shop'); ?></h2>
        <p class="section-subtitle section-subtitle--centered"><?php esc_html_e('Ontdek hoeveel je bespaart door zelf te waxen', 'waxing-shop'); ?></p>
    </div>

    <div class="reveal">
        <div class="calculator-box">
            <div class="calc-row">
                <label class="calc-label"><?php esc_html_e('Welke zones wax je? (meerdere mogelijk)', 'waxing-shop'); ?></label>
                <div class="calc-zones" id="calcZones">
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="45" data-name="Brazilian / Intiem" checked>
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Brazilian / Intiem', 'waxing-shop'); ?></span>
                            <span class="zone-price">€45/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="35" data-name="Bikinilijn">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Bikinilijn', 'waxing-shop'); ?></span>
                            <span class="zone-price">€35/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="40" data-name="Volledige benen">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Volledige benen', 'waxing-shop'); ?></span>
                            <span class="zone-price">€40/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="25" data-name="Onderbenen">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Onderbenen', 'waxing-shop'); ?></span>
                            <span class="zone-price">€25/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="20" data-name="Oksels">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Oksels', 'waxing-shop'); ?></span>
                            <span class="zone-price">€20/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="15" data-name="Bovenlip">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Bovenlip', 'waxing-shop'); ?></span>
                            <span class="zone-price">€15/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="25" data-name="Armen">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Armen', 'waxing-shop'); ?></span>
                            <span class="zone-price">€25/behandeling</span>
                        </span>
                    </label>
                    <label class="calc-zone-option">
                        <input type="checkbox" name="zone" value="30" data-name="Rug (man)">
                        <span class="zone-checkbox"></span>
                        <span class="zone-text">
                            <span class="zone-name"><?php esc_html_e('Rug (man)', 'waxing-shop'); ?></span>
                            <span class="zone-price">€30/behandeling</span>
                        </span>
                    </label>
                </div>
            </div>

            <div class="calc-row">
                <label class="calc-label" for="calcFreq"><?php esc_html_e('Hoe vaak per jaar?', 'waxing-shop'); ?></label>
                <select id="calcFreq" class="calc-select">
                    <option value="12"><?php esc_html_e('Elke maand (12x per jaar)', 'waxing-shop'); ?></option>
                    <option value="8" selected><?php esc_html_e('Elke 6 weken (8x per jaar)', 'waxing-shop'); ?></option>
                    <option value="6"><?php esc_html_e('Elke 2 maanden (6x per jaar)', 'waxing-shop'); ?></option>
                    <option value="4"><?php esc_html_e('Elk kwartaal (4x per jaar)', 'waxing-shop'); ?></option>
                </select>
            </div>

            <div class="calc-result">
                <div class="calc-comparison">
                    <div class="calc-column calc-salon">
                        <p class="calc-column-label"><?php esc_html_e('Salon kosten/jaar', 'waxing-shop'); ?></p>
                        <p class="calc-column-value" id="calcSalon">€360</p>
                    </div>
                    <div class="calc-vs">vs</div>
                    <div class="calc-column calc-home">
                        <p class="calc-column-label"><?php esc_html_e('Thuis met Waxing Shop', 'waxing-shop'); ?></p>
                        <p class="calc-column-value" id="calcHome">€132</p>
                    </div>
                </div>
                <div class="calc-saving-row">
                    <p class="calc-saving-label"><?php esc_html_e('Jouw besparing per jaar', 'waxing-shop'); ?></p>
                    <p class="calc-saving-value" id="calcSaving">€228</p>
                </div>
                <div class="calc-saving-row calc-saving-row-5year">
                    <p class="calc-saving-label"><?php esc_html_e('In 5 jaar bespaar je', 'waxing-shop'); ?></p>
                    <p class="calc-saving-value calc-saving-value-5year" id="calcSaving5Year">€1.540</p>
                </div>
            </div>

            <a href="#sets" class="btn btn-sage btn-block"><?php esc_html_e('Bekijk startersets', 'waxing-shop'); ?> →</a>

            <p class="calc-note">
                * <?php esc_html_e('Berekening inclusief jaarlijkse navullingen', 'waxing-shop'); ?>
            </p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="faq-section section" aria-labelledby="faq-title">
    <div class="section-header section-header--centered reveal">
        <p class="section-eyebrow section-eyebrow--centered"><?php esc_html_e('Antwoorden op je vragen', 'waxing-shop'); ?></p>
        <h2 class="section-title" id="faq-title"><?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?></h2>
    </div>

    <div class="reveal">
        <?php echo do_shortcode('[faq]'); ?>
    </div>
</section>

<?php get_footer(); ?>
