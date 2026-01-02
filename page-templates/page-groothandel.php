<?php
/**
 * Template Name: Groothandel B2B
 * Template Post Type: page
 * 
 * Professional/Salon wholesale page
 * URL: /wax-kopen-groothandel/
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();
?>

<main id="primary" class="content-page wholesale-page">
    
    <!-- Hero Section -->
    <section class="page-hero wholesale-hero">
        <div class="page-hero-bg" aria-hidden="true">
            <div class="hero-gradient hero-gradient-1"></div>
            <div class="hero-gradient hero-gradient-2"></div>
        </div>
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a itemprop="item" href="<?php echo home_url(); ?>"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name">Groothandel</span>
                        <meta itemprop="position" content="2" />
                    </li>
                </ol>
            </nav>
            
            <div class="page-hero-content">
                <p class="hero-eyebrow">Voor Professionals</p>
                <h1 id="page-title" class="page-title">Wax groothandel voor salons</h1>
                <p class="page-intro">Professionele harsproducten tegen scherpe inkoopprijzen. Registreer je met KvK-nummer en profiteer direct van exclusieve kortingen tot 40%.</p>
                
                <div class="hero-buttons">
                    <a href="#register" class="btn btn-primary">Registreer als salon →</a>
                    <a href="#products" class="btn btn-secondary">Bekijk producten</a>
                </div>
            </div>
            
            <!-- Trust Badges -->
            <div class="wholesale-badges">
                <div class="badge-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 Z"></path>
                        <polyline points="9,12 12,15 16,10"></polyline>
                    </svg>
                    <span>40+ salons vertrouwen op ons</span>
                </div>
                <div class="badge-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 Z"></path>
                        <polyline points="9,12 12,15 16,10"></polyline>
                    </svg>
                    <span>20+ jaar ervaring</span>
                </div>
                <div class="badge-item">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 Z"></path>
                        <polyline points="9,12 12,15 16,10"></polyline>
                    </svg>
                    <span>Gratis verzending vanaf €75</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Benefits Section -->
    <section class="wholesale-benefits section">
        <div class="container">
            <div class="section-header" style="text-align:center;margin-bottom:60px;">
                <p class="section-eyebrow" style="justify-content:center;">Voordelen</p>
                <h2 class="section-title">Waarom salons voor ons kiezen</h2>
            </div>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17,5 L12,1 L7,5"></path>
                            <path d="M17,19 L12,23 L7,19"></path>
                        </svg>
                    </div>
                    <h3>Tot 40% korting</h3>
                    <p>Exclusieve groothandelsprijzen voor geregistreerde salons. Hoe meer je bestelt, hoe voordeliger.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16,8 20,8 23,11 23,16 16,16 16,8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3>Snelle levering</h3>
                    <p>Bestel voor 14:00, morgen in huis. Gratis verzending vanaf €75. Nooit zonder voorraad zitten.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22,12 L18,12 L15,21 L9,3 L6,12 L2,12"></path>
                        </svg>
                    </div>
                    <h3>Premium kwaliteit</h3>
                    <p>Professionele wax uit Portugal. Uitstekende hechting, efficiënt in gebruik, tevreden klanten.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17,21 L17,19 C17,16.79 15.21,15 13,15 L5,15 C2.79,15 1,16.79 1,19 L1,21"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23,21 L23,19 C23,17.34 21.93,15.9 20.5,15.4"></path>
                            <path d="M16,3.13 C17.32,3.55 18.26,4.76 18.26,6.2 C18.26,7.64 17.32,8.85 16,9.27"></path>
                        </svg>
                    </div>
                    <h3>Persoonlijke service</h3>
                    <p>Vast aanspreekpunt voor al je vragen. Advies op maat voor jouw salon. 20+ jaar vakkennis.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4,19.5 C4,18.12 5.12,17 6.5,17 L20,17"></path>
                            <path d="M6.5,2 L20,2 L20,22 L6.5,22 C5.12,22 4,20.88 4,19.5 L4,4.5 C4,3.12 5.12,2 6.5,2 Z"></path>
                        </svg>
                    </div>
                    <h3>Gratis training</h3>
                    <p>Producttraining en handleidingen. Help je team het maximale uit onze producten te halen.</p>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16,21 L16,5 C16,3.9 15.1,3 14,3 L10,3 C8.9,3 8,3.9 8,5 L8,21"></path>
                        </svg>
                    </div>
                    <h3>Lagere kostprijs</h3>
                    <p>Efficiënte wax = minder verbruik per behandeling. Verhoog je winstmarge per klant.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Products Preview Section -->
    <section id="products" class="wholesale-products section" style="background:var(--cream-dark);">
        <div class="container">
            <div class="section-header" style="text-align:center;margin-bottom:60px;">
                <p class="section-eyebrow" style="justify-content:center;">Assortiment</p>
                <h2 class="section-title">Professionele producten</h2>
                <p class="section-subtitle" style="margin:16px auto 0;">Registreer je om de groothandelsprijzen te zien</p>
            </div>
            
            <div class="product-categories-grid">
                <a href="<?php echo home_url('/product-categorie/hot-wax/'); ?>" class="category-preview-card">
                    <div class="category-preview-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12,6 C12,6 8,10 8,13 C8,15.21 9.79,17 12,17 C14.21,17 16,15.21 16,13 C16,10 12,6 12,6 Z"></path>
                        </svg>
                    </div>
                    <h3>Hotwax</h3>
                    <p>Striploze wax voor bikinilijn, oksels en gezicht. 1KG zakken voor professioneel gebruik.</p>
                    <span class="category-link">Bekijk assortiment →</span>
                </a>
                
                <a href="<?php echo home_url('/product-categorie/striphars/'); ?>" class="category-preview-card">
                    <div class="category-preview-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="9" y1="3" x2="9" y2="21"></line>
                        </svg>
                    </div>
                    <h3>Stripwax</h3>
                    <p>Harspatronen en stripwax voor benen en grote oppervlakten. Snel en efficiënt werken.</p>
                    <span class="category-link">Bekijk assortiment →</span>
                </a>
                
                <a href="<?php echo home_url('/product-categorie/apparatuur/'); ?>" class="category-preview-card">
                    <div class="category-preview-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12,2 L2,7 L12,12 L22,7 L12,2 Z"></path>
                            <path d="M2,17 L12,22 L22,17"></path>
                            <path d="M2,12 L12,17 L22,12"></path>
                        </svg>
                    </div>
                    <h3>Apparatuur</h3>
                    <p>Professionele harsverwarmers met nauwkeurige temperatuurregeling. Betrouwbaar en duurzaam.</p>
                    <span class="category-link">Bekijk assortiment →</span>
                </a>
                
                <a href="<?php echo home_url('/product-categorie/accessoires/'); ?>" class="category-preview-card">
                    <div class="category-preview-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.59,13.41 L13.42,20.58 C13.04,20.96 12.53,21.17 12,21.17 C11.47,21.17 10.96,20.96 10.59,20.59 L2,12 L2,2 L12,2 L20.59,10.59 C21.37,11.37 21.37,12.63 20.59,13.41 Z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                    </div>
                    <h3>Accessoires</h3>
                    <p>Spatels, strips, pre- en post-wax lotions. Alles wat je nodig hebt voor een complete behandeling.</p>
                    <span class="category-link">Bekijk assortiment →</span>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Pricing Table -->
    <section class="wholesale-pricing section">
        <div class="container">
            <div class="section-header" style="text-align:center;margin-bottom:60px;">
                <p class="section-eyebrow" style="justify-content:center;">Staffelprijzen</p>
                <h2 class="section-title">Hoe meer je bestelt, hoe voordeliger</h2>
            </div>
            
            <div class="pricing-table-wrapper">
                <table class="pricing-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Consumentenprijs</th>
                            <th>Salon (1-5 stuks)</th>
                            <th>Salon (6-11 stuks)</th>
                            <th>Salon (12+ stuks)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hotwax 1KG (Rose, Nacree, Gold)</td>
                            <td>€25,20</td>
                            <td>€21,42 <span class="discount">-15%</span></td>
                            <td>€19,91 <span class="discount">-21%</span></td>
                            <td>€17,64 <span class="discount">-30%</span></td>
                        </tr>
                        <tr>
                            <td>Intimicire / Sunset 1KG</td>
                            <td>€28,25</td>
                            <td>€24,01 <span class="discount">-15%</span></td>
                            <td>€22,32 <span class="discount">-21%</span></td>
                            <td>€19,78 <span class="discount">-30%</span></td>
                        </tr>
                        <tr>
                            <td>Harspatronen (per 24 stuks)</td>
                            <td>€66,72</td>
                            <td>€56,71 <span class="discount">-15%</span></td>
                            <td>€52,71 <span class="discount">-21%</span></td>
                            <td>€46,70 <span class="discount">-30%</span></td>
                        </tr>
                        <tr>
                            <td>Harsverwarmer Pro 400ml</td>
                            <td>€34,75</td>
                            <td>€29,54 <span class="discount">-15%</span></td>
                            <td>€27,45 <span class="discount">-21%</span></td>
                            <td>€24,33 <span class="discount">-30%</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <p class="pricing-note">* Prijzen exclusief BTW. Staffelkorting geldt per productcategorie. Na registratie zie je automatisch je salonprijzen.</p>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="wholesale-testimonials section" style="background:var(--cream-dark);">
        <div class="container">
            <div class="section-header" style="text-align:center;margin-bottom:60px;">
                <p class="section-eyebrow" style="justify-content:center;">Ervaringen</p>
                <h2 class="section-title">Wat salons zeggen</h2>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars" aria-label="5 sterren">★★★★★</div>
                    <p class="testimonial-text">"Al jaren vaste klant. De wax is van uitstekende kwaliteit en de prijzen zijn zeer scherp. Persoonlijke service is top."</p>
                    <div class="testimonial-author">
                        <strong>Beauty Salon Veldhoven</strong>
                        <span>Klant sinds 2019</span>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars" aria-label="5 sterren">★★★★★</div>
                    <p class="testimonial-text">"Snelle levering en altijd alles op voorraad. De Intimicire is favoriet bij onze klanten voor Brazilian wax behandelingen."</p>
                    <div class="testimonial-author">
                        <strong>Wax Studio Amsterdam</strong>
                        <span>Klant sinds 2021</span>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars" aria-label="5 sterren">★★★★★</div>
                    <p class="testimonial-text">"Eindelijk een leverancier die begrijpt wat salons nodig hebben. Goede producten, faire prijzen, geen gedoe."</p>
                    <div class="testimonial-author">
                        <strong>Schoonheidssalon De Roos</strong>
                        <span>Klant sinds 2020</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Registration Section -->
    <section id="register" class="wholesale-register section">
        <div class="container">
            <div class="register-wrapper">
                <div class="register-content">
                    <p class="hero-eyebrow">Aanmelden</p>
                    <h2>Word zakelijke klant</h2>
                    <p>Registreer je met je KvK-nummer en ontvang direct toegang tot onze groothandelsprijzen. Na goedkeuring kun je inloggen en bestellen.</p>
                    
                    <div class="register-steps">
                        <div class="register-step">
                            <span class="step-number">1</span>
                            <div class="step-content">
                                <strong>Registreer</strong>
                                <p>Vul het formulier in met je salongegevens en KvK-nummer.</p>
                            </div>
                        </div>
                        <div class="register-step">
                            <span class="step-number">2</span>
                            <div class="step-content">
                                <strong>Verificatie</strong>
                                <p>We controleren je gegevens (meestal binnen 24 uur).</p>
                            </div>
                        </div>
                        <div class="register-step">
                            <span class="step-number">3</span>
                            <div class="step-content">
                                <strong>Bestellen</strong>
                                <p>Log in en bestel tegen scherpe groothandelsprijzen.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="register-form-wrapper">
                    <div class="register-form-card">
                        <h3>Registreer nu</h3>
                        <form class="register-form" action="<?php echo home_url('/mijn-account/'); ?>" method="get">
                            <div class="form-group">
                                <label for="salon-name">Salonnaam *</label>
                                <input type="text" id="salon-name" name="salon" required>
                            </div>
                            <div class="form-group">
                                <label for="kvk">KvK-nummer *</label>
                                <input type="text" id="kvk" name="kvk" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mailadres *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefoonnummer</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                            <button type="submit" class="btn btn-sage btn-block">Aanmelden als salon →</button>
                            <p class="form-note">Of <a href="<?php echo home_url('/mijn-account/'); ?>">log direct in</a> als je al een account hebt.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact CTA -->
    <section class="wholesale-contact section" style="background:var(--sage);">
        <div class="container">
            <div class="contact-cta" style="text-align:center;color:white;">
                <h2 style="color:white;">Vragen? Neem contact op</h2>
                <p style="opacity:0.9;margin-bottom:32px;">We helpen je graag met advies over producten of bestellingen.</p>
                <div class="contact-options">
                    <a href="tel:0636092340" class="contact-option">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22,16.92 L22,19.92 C22,20.48 21.56,20.95 21,20.99 C20.5,21.03 20.02,21.01 19.56,20.93 C16.18,20.28 12.97,18.78 10.29,16.54 C7.78,14.46 5.73,11.9 4.29,9 C3.03,6.32 2.47,3.35 2.94,0.47 C3,0.19 3.21,0 3.5,0 L6.5,0 C6.74,0 6.95,0.16 7,0.39 C7.26,1.54 7.65,2.66 8.15,3.72 C8.26,3.96 8.2,4.24 8,4.42 L6.09,6.33 C7.36,8.92 9.08,11.14 11.25,12.91 C13.03,14.35 15.08,15.46 17.29,16.17 L19.21,14.25 C19.38,14.08 19.63,14.01 19.86,14.09 C20.96,14.47 22.11,14.73 23.28,14.86 C23.54,14.89 23.74,15.11 23.74,15.38 L23.74,18.38 C23.74,18.92 23.37,19.39 22.86,19.49"></path>
                        </svg>
                        06 360 923 40
                    </a>
                    <a href="mailto:info@waxing-shop.nl" class="contact-option">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4,4 L20,4 C21.1,4 22,4.9 22,6 L22,18 C22,19.1 21.1,20 20,20 L4,20 C2.9,20 2,19.1 2,18 L2,6 C2,4.9 2.9,4 4,4 Z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        info@waxing-shop.nl
                    </a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>
