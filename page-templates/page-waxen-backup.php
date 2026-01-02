<?php
/**
 * Template Name: Waxen Gids
 * Description: Complete waxen guide with tutorials, tips and FAQ
 */

get_header();
?>

<div class="waxen-gids-page">
    <!-- Hero Section -->
    <section class="waxen-hero">
        <div class="waxen-hero-content">
            <h1 class="waxen-hero-title"><?php esc_html_e('Waxen Gids', 'waxing-shop'); ?></h1>
            <p class="waxen-hero-subtitle"><?php esc_html_e('Alles wat je moet weten over professioneel waxen thuis', 'waxing-shop'); ?></p>
            <div class="waxen-hero-nav">
                <a href="#intro" class="btn btn-sage"><?php esc_html_e('Aan de slag', 'waxing-shop'); ?></a>
                <a href="<?php echo esc_url(home_url('/academy/')); ?>" class="btn btn-outline"><?php esc_html_e('Video Tutorials', 'waxing-shop'); ?></a>
                <a href="#faq" class="btn btn-outline"><?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?></a>
            </div>
        </div>
    </section>

    <!-- Quick Navigation -->
    <nav class="waxen-quick-nav">
        <div class="quick-nav-inner">
            <a href="#intro" class="quick-nav-item">
                <span class="quick-nav-icon">🚀</span>
                <span class="quick-nav-text"><?php esc_html_e('Beginnen', 'waxing-shop'); ?></span>
            </a>
            <a href="#handleidingen" class="quick-nav-item">
                <span class="quick-nav-icon">📖</span>
                <span class="quick-nav-text"><?php esc_html_e('Handleidingen', 'waxing-shop'); ?></span>
            </a>
            <a href="<?php echo esc_url(home_url('/academy/')); ?>" class="quick-nav-item">
                <span class="quick-nav-icon">🎬</span>
                <span class="quick-nav-text"><?php esc_html_e('Academy', 'waxing-shop'); ?></span>
            </a>
            <a href="#tips" class="quick-nav-item">
                <span class="quick-nav-icon">✨</span>
                <span class="quick-nav-text"><?php esc_html_e('Tips', 'waxing-shop'); ?></span>
            </a>
            <a href="#faq" class="quick-nav-item">
                <span class="quick-nav-icon">❓</span>
                <span class="quick-nav-text"><?php esc_html_e('FAQ', 'waxing-shop'); ?></span>
            </a>
        </div>
    </nav>

    <!-- Getting Started Section -->
    <section id="intro" class="waxen-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge"><?php esc_html_e('Stap voor stap', 'waxing-shop'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Aan de slag met waxen', 'waxing-shop'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('In een paar simpele stappen naar professionele resultaten', 'waxing-shop'); ?></p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title"><?php esc_html_e('Voorbereiden', 'waxing-shop'); ?></h3>
                    <p class="step-desc"><?php esc_html_e('Reinig de huid en zorg dat deze droog en vetvrij is. Haartjes moeten minimaal 3-5mm lang zijn.', 'waxing-shop'); ?></p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title"><?php esc_html_e('Wax verwarmen', 'waxing-shop'); ?></h3>
                    <p class="step-desc"><?php esc_html_e('Verwarm de wax tot een stroperige consistentie. Test altijd eerst op je pols voor de juiste temperatuur.', 'waxing-shop'); ?></p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title"><?php esc_html_e('Aanbrengen', 'waxing-shop'); ?></h3>
                    <p class="step-desc"><?php esc_html_e('Breng de wax aan in de groeirichting van het haar met een spatel. Maak een lipje voor het verwijderen.', 'waxing-shop'); ?></p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h3 class="step-title"><?php esc_html_e('Verwijderen', 'waxing-shop'); ?></h3>
                    <p class="step-desc"><?php esc_html_e('Trek de wax snel en resoluut tegen de groeirichting in. Houd de huid strak voor het beste resultaat.', 'waxing-shop'); ?></p>
                </div>
                <div class="step-card">
                    <div class="step-number">5</div>
                    <h3 class="step-title"><?php esc_html_e('Nazorg', 'waxing-shop'); ?></h3>
                    <p class="step-desc"><?php esc_html_e('Verzorg de huid met een kalmerende lotion. Vermijd zonlicht en zware parfums de eerste 24 uur.', 'waxing-shop'); ?></p>
                </div>
            </div>

            <div class="section-cta">
                <a href="<?php echo esc_url(home_url('/product-categorie/pakketten/')); ?>" class="btn btn-sage btn-lg">
                    <?php esc_html_e('Bekijk Startersets', 'waxing-shop'); ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- Handleidingen Section -->
    <section id="handleidingen" class="waxen-section waxen-section-alt">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge"><?php esc_html_e('Wax soorten', 'waxing-shop'); ?></span>
                <h2 class="section-title"><?php esc_html_e('De juiste wax kiezen', 'waxing-shop'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Elk huidtype en lichaamsdeel heeft zijn eigen ideale wax', 'waxing-shop'); ?></p>
            </div>

            <div class="wax-types-grid">
                <div class="wax-type-card">
                    <div class="wax-type-icon" style="background: linear-gradient(135deg, #F5E4E6, #E8D4D6);">🍯</div>
                    <h3 class="wax-type-title"><?php esc_html_e('Film Wax (Hot Wax)', 'waxing-shop'); ?></h3>
                    <p class="wax-type-desc"><?php esc_html_e('Perfect voor gezicht, bikinilijn en oksels. Zacht voor de huid en zeer effectief voor kort haar.', 'waxing-shop'); ?></p>
                    <ul class="wax-type-pros">
                        <li><?php esc_html_e('Geen strips nodig', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Minder pijnlijk', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Geschikt voor gevoelige huid', 'waxing-shop'); ?></li>
                    </ul>
                </div>
                <div class="wax-type-card">
                    <div class="wax-type-icon" style="background: linear-gradient(135deg, #E5EAE3, #D5DAD3);">📜</div>
                    <h3 class="wax-type-title"><?php esc_html_e('Strip Wax', 'waxing-shop'); ?></h3>
                    <p class="wax-type-desc"><?php esc_html_e('Ideaal voor grote oppervlakken zoals benen en armen. Snel en efficiënt voor grotere zones.', 'waxing-shop'); ?></p>
                    <ul class="wax-type-pros">
                        <li><?php esc_html_e('Snelle behandeling', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Grote oppervlakken', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Economisch in gebruik', 'waxing-shop'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Academy CTA -->
    <section class="waxen-section waxen-section-alt waxen-academy-cta">
        <div class="section-container">
            <div class="academy-promo">
                <div class="academy-promo-icon">🎬</div>
                <div class="academy-promo-content">
                    <h2><?php esc_html_e('Leer waxen met video tutorials', 'waxing-shop'); ?></h2>
                    <p><?php esc_html_e('Bekijk onze gratis video tutorials en leer stap voor stap de juiste technieken.', 'waxing-shop'); ?></p>
                </div>
                <a href="<?php echo esc_url(home_url('/academy/')); ?>" class="btn btn-sage btn-lg">
                    <?php esc_html_e('Naar Academy', 'waxing-shop'); ?> →
                </a>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section id="tips" class="waxen-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge"><?php esc_html_e('Pro tips', 'waxing-shop'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Tips voor het beste resultaat', 'waxing-shop'); ?></h2>
            </div>

            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">🌡️</div>
                    <h3 class="tip-title"><?php esc_html_e('Juiste temperatuur', 'waxing-shop'); ?></h3>
                    <p class="tip-desc"><?php esc_html_e('Test de wax altijd op je pols. Het moet warm aanvoelen maar niet branden.', 'waxing-shop'); ?></p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">📏</div>
                    <h3 class="tip-title"><?php esc_html_e('Haarlengte', 'waxing-shop'); ?></h3>
                    <p class="tip-desc"><?php esc_html_e('Ideale haarlengte is 3-5mm. Te kort? Wacht een paar dagen. Te lang? Trim eerst.', 'waxing-shop'); ?></p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">🧴</div>
                    <h3 class="tip-title"><?php esc_html_e('Huidvoorbereiding', 'waxing-shop'); ?></h3>
                    <p class="tip-desc"><?php esc_html_e('Reinig de huid en gebruik geen olie of lotion voor het waxen.', 'waxing-shop'); ?></p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">⚡</div>
                    <h3 class="tip-title"><?php esc_html_e('Snel verwijderen', 'waxing-shop'); ?></h3>
                    <p class="tip-desc"><?php esc_html_e('Trek de wax snel en resoluut af. Aarzel niet - dat doet meer pijn!', 'waxing-shop'); ?></p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">🚿</div>
                    <h3 class="tip-title"><?php esc_html_e('Na het waxen', 'waxing-shop'); ?></h3>
                    <p class="tip-desc"><?php esc_html_e('Vermijd hete douches, zwembaden en zonlicht de eerste 24 uur.', 'waxing-shop'); ?></p>
                </div>
                <div class="tip-card">
                    <div class="tip-icon">🔄</div>
                    <h3 class="tip-title"><?php esc_html_e('Regelmatig scrubben', 'waxing-shop'); ?></h3>
                    <p class="tip-desc"><?php esc_html_e('Scrub 2-3 dagen na het waxen om ingegroeide haren te voorkomen.', 'waxing-shop'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="waxen-section waxen-section-alt waxen-faq">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge"><?php esc_html_e('FAQ', 'waxing-shop'); ?></span>
                <h2 class="section-title"><?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?></h2>
                <p class="section-subtitle"><?php esc_html_e('Antwoorden op de meest gestelde vragen over waxen', 'waxing-shop'); ?></p>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Doet waxen pijn?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('De eerste keer kan waxen wat oncomfortabel zijn, maar dit wordt minder naarmate je vaker waxt. De haartjes worden dunner en de huid went aan de behandeling. Onze film wax is speciaal ontwikkeld om zo pijnloos mogelijk te zijn.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Hoe lang moet mijn haar zijn voor waxen?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Voor het beste resultaat moeten je haartjes minimaal 3-5mm lang zijn (ongeveer zo lang als een rijstkorrel). Te korte haartjes kunnen niet goed door de wax worden vastgepakt.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Hoe vaak moet ik waxen?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('De meeste mensen waxen elke 3-6 weken, afhankelijk van hoe snel het haar groeit. Na verloop van tijd zul je merken dat je minder vaak hoeft te waxen omdat het haar dunner en zachter wordt.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Kan ik waxen als ik een gevoelige huid heb?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Ja! Onze film wax is speciaal geschikt voor gevoelige huid. Test altijd eerst een klein stukje huid. Vermijd waxen op geïrriteerde, verbrande of beschadigde huid.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Wat is het verschil tussen film wax en strip wax?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Film wax (hot wax) wordt direct op de huid aangebracht en verwijderd zonder strips. Het is zachter en geschikt voor gevoelige zones. Strip wax wordt met papieren of stoffen strips verwijderd en is ideaal voor grotere oppervlakken zoals benen.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Hoe voorkom ik ingegroeide haren?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Exfolieer regelmatig (2-3 keer per week) om dode huidcellen te verwijderen. Gebruik onze speciale verzorgingsproducten tegen ingegroeide haren. Draag los zittende kleding na het waxen.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Is waxen beter dan scheren?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Waxen haalt het haar uit de wortel, waardoor het resultaat 3-6 weken aanhoudt in plaats van enkele dagen. Het haar groeit zachter terug en wordt na verloop van tijd dunner. Bovendien heb je geen last van stoppels.', 'waxing-shop'); ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?php esc_html_e('Kan ik de wax hergebruiken?', 'waxing-shop'); ?></span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Nee, om hygiënische redenen raden we aan om wax na gebruik weg te gooien. Gebruikte wax kan bacteriën bevatten en is niet meer even effectief.', 'waxing-shop'); ?></p>
                    </div>
                </div>
            </div>

            <div class="faq-cta">
                <p><?php esc_html_e('Nog vragen? We helpen je graag!', 'waxing-shop'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-sage">
                    <?php esc_html_e('Neem contact op', 'waxing-shop'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="waxen-cta-section">
        <div class="section-container">
            <div class="waxen-cta-content">
                <h2><?php esc_html_e('Klaar om te beginnen?', 'waxing-shop'); ?></h2>
                <p><?php esc_html_e('Ontdek onze startersets met alles wat je nodig hebt voor professionele resultaten thuis.', 'waxing-shop'); ?></p>
                <a href="<?php echo esc_url(home_url('/product-categorie/pakketten/')); ?>" class="btn btn-sage btn-lg">
                    <?php esc_html_e('Bekijk Startersets', 'waxing-shop'); ?> →
                </a>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
