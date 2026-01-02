<?php
/**
 * Template Name: Waxen Gids
 * Template Post Type: page
 * Description: Interactieve journey pagina voor waxen educatie
 *
 * @package Waxing_Shop
 * @since 5.8
 */

get_header();
?>

<div class="waxen-gids-page">

    <!-- SECTIE 1: HERO -->
    <section class="waxen-hero" id="top">
        <div class="container">
            <h1 class="waxen-hero-title"><?php esc_html_e('Professioneel waxen, thuis', 'waxing-shop'); ?></h1>
            <p class="waxen-hero-subtitle"><?php esc_html_e('20+ jaar salonervaring, nu voor jou beschikbaar', 'waxing-shop'); ?></p>
            <div class="waxen-hero-buttons">
                <a href="<?php echo esc_url(home_url('/product-categorie/pakketten/')); ?>" class="btn btn-sage btn-lg">
                    <?php esc_html_e('Bekijk Startersets', 'waxing-shop'); ?>
                </a>
                <a href="#content" class="btn btn-outline btn-lg">
                    <?php esc_html_e('Ik heb vragen', 'waxing-shop'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTIE 2: TWEE PADEN -->
    <section class="waxen-paths">
        <div class="container">
            <div class="paths-grid">
                <a href="<?php echo esc_url(home_url('/product-categorie/pakketten/')); ?>" class="path-card path-card-start">
                    <span class="path-icon">🚀</span>
                    <h2 class="path-title"><?php esc_html_e('Ik wil starten', 'waxing-shop'); ?></h2>
                    <p class="path-desc"><?php esc_html_e('Direct aan de slag met waxen', 'waxing-shop'); ?></p>
                    <span class="path-link"><?php esc_html_e('Bekijk Startersets →', 'waxing-shop'); ?></span>
                </a>
                <a href="#content" class="path-card path-card-learn">
                    <span class="path-icon">📚</span>
                    <h2 class="path-title"><?php esc_html_e('Ik wil eerst leren', 'waxing-shop'); ?></h2>
                    <p class="path-desc"><?php esc_html_e('Ontdek alles over waxen', 'waxing-shop'); ?></p>
                    <span class="path-link"><?php esc_html_e('Lees verder ↓', 'waxing-shop'); ?></span>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTIE 3: EMAIL CAPTURE -->
    <section class="waxen-email-capture">
        <div class="container">
            <div class="email-capture-grid">
                <div class="email-capture-content">
                    <h2><?php esc_html_e('Gratis: Waxen Checklist voor Beginners', 'waxing-shop'); ?></h2>
                    <ul class="email-capture-benefits">
                        <li><?php esc_html_e('Voorbereiding stappen', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Wat je nodig hebt', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Veelgemaakte fouten vermijden', 'waxing-shop'); ?></li>
                        <li><?php esc_html_e('Nazorg tips', 'waxing-shop'); ?></li>
                    </ul>
                </div>
                <div class="email-capture-form">
                    <form class="email-form" action="#" method="post">
                        <input type="email" name="email" placeholder="<?php esc_attr_e('Je e-mailadres', 'waxing-shop'); ?>" required>
                        <button type="submit" class="btn btn-sage"><?php esc_html_e('Download Gratis', 'waxing-shop'); ?></button>
                    </form>
                    <p class="email-privacy"><?php esc_html_e('We respecteren je privacy. Geen spam.', 'waxing-shop'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTIE 4: CONTENT TABS -->
    <section class="waxen-content" id="content">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Wat wil je weten?', 'waxing-shop'); ?></h2>

            <!-- Tab Navigation -->
            <div class="waxen-tabs">
                <button class="waxen-tab active" data-tab="huidproblemen"><?php esc_html_e('Huidproblemen', 'waxing-shop'); ?></button>
                <button class="waxen-tab" data-tab="vergelijken"><?php esc_html_e('Vergelijken', 'waxing-shop'); ?></button>
                <button class="waxen-tab" data-tab="zones"><?php esc_html_e('Per zone', 'waxing-shop'); ?></button>
                <button class="waxen-tab" data-tab="tips"><?php esc_html_e('Tips & Meer', 'waxing-shop'); ?></button>
            </div>

            <!-- Tab Content: Huidproblemen -->
            <div class="waxen-tab-content active" id="huidproblemen">
                <p class="tab-intro"><?php esc_html_e('Herken je een van deze problemen? Waxen kan helpen.', 'waxing-shop'); ?></p>
                <div class="content-cards-grid">
                    <a href="<?php echo esc_url(home_url('/blog/scheerbultjes-oorzaken-oplossingen/')); ?>" class="content-card">
                        <span class="card-icon">🔴</span>
                        <h3><?php esc_html_e('Scheerbultjes', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Rode bultjes na scheren? Waxen voorkomt dit.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/folliculitis-ingegroeide-haren/')); ?>" class="content-card">
                        <span class="card-icon">⚠️</span>
                        <h3><?php esc_html_e('Ingegroeide haren', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Pijnlijke bultjes door ingegroeide haren?', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/strawberry-legs/')); ?>" class="content-card">
                        <span class="card-icon">🍓</span>
                        <h3><?php esc_html_e('Strawberry Legs', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Donkere puntjes op je benen?', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/keratosis-pilaris-kippenhuid/')); ?>" class="content-card">
                        <span class="card-icon">🐔</span>
                        <h3><?php esc_html_e('Kippenhuid', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Ruwe bultjes op bovenarmen?', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                </div>
            </div>

            <!-- Tab Content: Vergelijken -->
            <div class="waxen-tab-content" id="vergelijken">
                <p class="tab-intro"><?php esc_html_e('Hoe verhoudt waxen zich tot andere methodes?', 'waxing-shop'); ?></p>
                <div class="content-cards-grid">
                    <a href="<?php echo esc_url(home_url('/blog/waxen-vs-scheren/')); ?>" class="content-card">
                        <span class="card-icon">🪒</span>
                        <h3><?php esc_html_e('Waxen vs Scheren', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Welke methode is beter voor jou?', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Vergelijk →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/epileren-vs-waxen/')); ?>" class="content-card">
                        <span class="card-icon">⚡</span>
                        <h3><?php esc_html_e('Epileren vs Waxen', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('De voor- en nadelen vergeleken.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Vergelijk →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/ipl-vs-waxen/')); ?>" class="content-card">
                        <span class="card-icon">💡</span>
                        <h3><?php esc_html_e('IPL vs Waxen', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Laser of toch liever waxen?', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Vergelijk →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/ontharingscreme-nadelen/')); ?>" class="content-card">
                        <span class="card-icon">🧴</span>
                        <h3><?php esc_html_e('Ontharingscrème', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Waarom waxen een betere keuze is.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/sugaring-vs-waxen/')); ?>" class="content-card">
                        <span class="card-icon">🍯</span>
                        <h3><?php esc_html_e('Sugaring vs Waxen', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Suiker of hars - wat werkt beter?', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Vergelijk →', 'waxing-shop'); ?></span>
                    </a>
                </div>
            </div>

            <!-- Tab Content: Per Zone -->
            <div class="waxen-tab-content" id="zones">
                <p class="tab-intro"><?php esc_html_e('Kies de zone die je wilt behandelen.', 'waxing-shop'); ?></p>
                <div class="content-cards-grid zones-grid">
                    <a href="<?php echo esc_url(home_url('/blog/benen-waxen/')); ?>" class="content-card zone-card">
                        <span class="card-icon">🦵</span>
                        <h3><?php esc_html_e('Benen', 'waxing-shop'); ?></h3>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/bikinilijn-waxen-thuis/')); ?>" class="content-card zone-card">
                        <span class="card-icon">👙</span>
                        <h3><?php esc_html_e('Bikinilijn', 'waxing-shop'); ?></h3>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/brazilian-wax-thuis/')); ?>" class="content-card zone-card">
                        <span class="card-icon">🔥</span>
                        <h3><?php esc_html_e('Brazilian', 'waxing-shop'); ?></h3>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/oksels-waxen/')); ?>" class="content-card zone-card">
                        <span class="card-icon">💪</span>
                        <h3><?php esc_html_e('Oksels', 'waxing-shop'); ?></h3>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/gezicht-waxen-bovenlip-wenkbrauwen/')); ?>" class="content-card zone-card">
                        <span class="card-icon">😊</span>
                        <h3><?php esc_html_e('Gezicht', 'waxing-shop'); ?></h3>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/rug-waxen-mannen/')); ?>" class="content-card zone-card">
                        <span class="card-icon">🧔</span>
                        <h3><?php esc_html_e('Rug (mannen)', 'waxing-shop'); ?></h3>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/borst-waxen-mannen/')); ?>" class="content-card zone-card">
                        <span class="card-icon">👔</span>
                        <h3><?php esc_html_e('Borst (mannen)', 'waxing-shop'); ?></h3>
                    </a>
                </div>
            </div>

            <!-- Tab Content: Tips & Meer -->
            <div class="waxen-tab-content" id="tips">
                <p class="tab-intro"><?php esc_html_e('Alles om je wax-ervaring te verbeteren.', 'waxing-shop'); ?></p>
                <div class="content-cards-grid">
                    <a href="<?php echo esc_url(home_url('/blog/zelf-waxen-beginners-gids/')); ?>" class="content-card">
                        <span class="card-icon">🚀</span>
                        <h3><?php esc_html_e('Beginnersgids', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Stap voor stap zelf leren waxen.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/nazorg-na-waxen/')); ?>" class="content-card">
                        <span class="card-icon">💆</span>
                        <h3><?php esc_html_e('Nazorg', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Zo verzorg je je huid na het waxen.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/welke-wax-past-bij-mij/')); ?>" class="content-card">
                        <span class="card-icon">🎯</span>
                        <h3><?php esc_html_e('Welke wax kiezen', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Vind de perfecte wax voor jouw huid.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/waxsoorten-vergeleken/')); ?>" class="content-card">
                        <span class="card-icon">📊</span>
                        <h3><?php esc_html_e('Waxsoorten', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Alle waxsoorten uitgelegd.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/blog/waxen-tijdens-zwangerschap/')); ?>" class="content-card">
                        <span class="card-icon">🤰</span>
                        <h3><?php esc_html_e('Zwangerschap', 'waxing-shop'); ?></h3>
                        <p><?php esc_html_e('Veilig waxen tijdens de zwangerschap.', 'waxing-shop'); ?></p>
                        <span class="card-link"><?php esc_html_e('Lees meer →', 'waxing-shop'); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTIE 5: ACADEMY -->
    <section class="waxen-academy" id="academy">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Video Tutorials', 'waxing-shop'); ?></h2>
            <p class="section-subtitle"><?php esc_html_e('Leer van onze experts', 'waxing-shop'); ?></p>

            <div class="academy-videos">
                <div class="video-card">
                    <div class="video-placeholder">
                        <span class="play-icon">▶</span>
                        <span class="video-title"><?php esc_html_e('Eerste keer waxen', 'waxing-shop'); ?></span>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-placeholder">
                        <span class="play-icon">▶</span>
                        <span class="video-title"><?php esc_html_e('Hot wax aanbrengen', 'waxing-shop'); ?></span>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-placeholder">
                        <span class="play-icon">▶</span>
                        <span class="video-title"><?php esc_html_e('Nazorg tips', 'waxing-shop'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTIE 6: FAQ -->
    <section class="waxen-faq" id="faq">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e('Veelgestelde vragen', 'waxing-shop'); ?></h2>

            <div class="faq-accordion">
                <div class="faq-item">
                    <button class="faq-question">
                        <?php esc_html_e('Doet waxen pijn?', 'waxing-shop'); ?>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('De eerste keer kan waxen wat oncomfortabel zijn, maar de meeste mensen wennen er snel aan. Na een paar behandelingen wordt het haar fijner en de behandeling minder pijnlijk.', 'waxing-shop'); ?></p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <?php esc_html_e('Hoe lang blijft het resultaat?', 'waxing-shop'); ?>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Gemiddeld 3-4 weken, afhankelijk van je haargroei. Regelmatig waxen kan de haargroei verminderen.', 'waxing-shop'); ?></p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <?php esc_html_e('Welke wax is het beste voor beginners?', 'waxing-shop'); ?>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Voor beginners raden we de Nacree Blanche aan - een veelzijdige wax die geschikt is voor alle huidtypes en makkelijk te gebruiken is.', 'waxing-shop'); ?></p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <?php esc_html_e('Kan ik waxen met gevoelige huid?', 'waxing-shop'); ?>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Ja! Kies dan voor een hypoallergene wax zoals onze Sunset. Doe altijd eerst een kleine test op je arm.', 'waxing-shop'); ?></p>
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">
                        <?php esc_html_e('Hoe lang moeten de haartjes zijn?', 'waxing-shop'); ?>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p><?php esc_html_e('Minimaal 0,5 cm (ongeveer 2 weken haargroei). Te kort haar pakt de wax niet goed vast.', 'waxing-shop'); ?></p>
                    </div>
                </div>
            </div>

            <p class="faq-more">
                <a href="<?php echo esc_url(home_url('/blog/waxen-faq/')); ?>" class="text-link">
                    <?php esc_html_e('Alle vragen bekijken →', 'waxing-shop'); ?>
                </a>
            </p>
        </div>
    </section>

    <!-- SECTIE 7: CTA BANNER -->
    <section class="waxen-cta">
        <div class="container">
            <h2 class="cta-title"><?php esc_html_e('Klaar om te starten?', 'waxing-shop'); ?></h2>

            <div class="cta-cards">
                <div class="cta-card">
                    <h3><?php esc_html_e('Complete Starterset', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Alles wat je nodig hebt in één pakket', 'waxing-shop'); ?></p>
                    <span class="cta-price"><?php esc_html_e('Vanaf €27', 'waxing-shop'); ?></span>
                    <a href="<?php echo esc_url(home_url('/product-categorie/pakketten/')); ?>" class="btn btn-sage">
                        <?php esc_html_e('Bekijk Startersets', 'waxing-shop'); ?>
                    </a>
                </div>
                <div class="cta-card cta-card-alt">
                    <h3><?php esc_html_e('Niet zeker welke?', 'waxing-shop'); ?></h3>
                    <p><?php esc_html_e('Stel je eigen set samen', 'waxing-shop'); ?></p>
                    <span class="cta-time"><?php esc_html_e('In 3 stappen klaar', 'waxing-shop'); ?></span>
                    <button class="btn btn-outline open-configurator">
                        <?php esc_html_e('Stel Samen', 'waxing-shop'); ?>
                    </button>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
