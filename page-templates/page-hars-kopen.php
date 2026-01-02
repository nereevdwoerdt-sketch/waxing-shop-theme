<?php
/**
 * Template Name: Hars Kopen Gids
 * Template Post Type: page
 * 
 * Buying guide for wax products
 * URL: /hars-kopen/
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();
?>

<main id="primary" class="content-page buying-guide">
    
    <!-- Hero Section -->
    <section class="page-hero">
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
                        <span itemprop="name">Hars kopen</span>
                        <meta itemprop="position" content="2" />
                    </li>
                </ol>
            </nav>
            
            <div class="page-hero-content">
                <p class="hero-eyebrow">Koopgids</p>
                <h1 id="page-title" class="page-title">Hars kopen: waar let je op?</h1>
                <p class="page-intro">Niet alle wax is hetzelfde. Ontdek welke wax het beste past bij jouw huid, haartype en behandelgebied.</p>
            </div>
        </div>
    </section>
    
    <!-- Quick Decision -->
    <section class="quick-decision section">
        <div class="container">
            <div class="decision-grid">
                <div class="decision-card">
                    <div class="decision-icon" style="background: var(--wax-rose);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12,6 C12,6 8,10 8,13 C8,15.21 9.79,17 12,17 C14.21,17 16,15.21 16,13 C16,10 12,6 12,6 Z"></path>
                        </svg>
                    </div>
                    <h3>Bikinilijn of gezicht?</h3>
                    <p>Kies <strong>hotwax</strong> — zachter voor gevoelige zones, plakt niet aan de huid.</p>
                    <a href="#hotwax" class="decision-link">Bekijk hotwax opties →</a>
                </div>
                
                <div class="decision-card">
                    <div class="decision-icon" style="background: var(--wax-gold);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="9" y1="3" x2="9" y2="21"></line>
                        </svg>
                    </div>
                    <h3>Benen of armen?</h3>
                    <p>Kies <strong>stripwax</strong> — sneller werken op grote oppervlakten.</p>
                    <a href="#stripwax" class="decision-link">Bekijk stripwax opties →</a>
                </div>
                
                <div class="decision-card">
                    <div class="decision-icon" style="background: var(--sage-light);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--sage)" stroke-width="2">
                            <path d="M12,2 L2,7 L12,12 L22,7 L12,2 Z"></path>
                            <path d="M2,17 L12,22 L22,17"></path>
                            <path d="M2,12 L12,17 L22,12"></path>
                        </svg>
                    </div>
                    <h3>Net beginnen?</h3>
                    <p>Kies een <strong>starterset</strong> — alles wat je nodig hebt in één pakket.</p>
                    <a href="<?php echo home_url('/#sets'); ?>" class="decision-link">Bekijk startersets →</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main Content -->
    <article class="guide-content">
        <div class="container">
            <div class="content-layout content-layout-narrow">
                
                <div class="content-main">
                    
                    <!-- Hotwax Section -->
                    <section id="hotwax" class="content-section">
                        <h2>Hotwax (striploze wax)</h2>
                        
                        <p class="lead">Hotwax is ideaal voor gevoelige zones. De wax omkapselt alleen het haar en plakt niet aan de huid, waardoor het minder pijnlijk is dan stripwax.</p>
                        
                        <div class="product-comparison">
                            
                            <div class="product-option">
                                <div class="product-option-header" style="background: linear-gradient(135deg, #F5E4E6 0%, #EDD5D8 100%);">
                                    <h3>Rose Hotwax</h3>
                                    <span class="product-tag">Bestseller</span>
                                </div>
                                <div class="product-option-body">
                                    <p><strong>Beste voor:</strong> Bikinilijn, oksels, bovenlip</p>
                                    <p><strong>Huidtype:</strong> Alle huidtypes</p>
                                    <p><strong>Kenmerk:</strong> Zachte rozenformule, aangename geur</p>
                                    <ul class="check-list">
                                        <li>Zeer flexibel, breekt niet</li>
                                        <li>Geschikt voor kort haar (3mm+)</li>
                                        <li>Kalmerend voor de huid</li>
                                    </ul>
                                    <a href="<?php echo home_url('/product/rose-hotwax/'); ?>" class="btn btn-sage btn-block">Bekijk Rose Hotwax</a>
                                </div>
                            </div>
                            
                            <div class="product-option">
                                <div class="product-option-header" style="background: linear-gradient(135deg, #F7DFD0 0%, #EAD0BF 100%);">
                                    <h3>Intimicire / Sunset</h3>
                                    <span class="product-tag">Gevoelige huid</span>
                                </div>
                                <div class="product-option-body">
                                    <p><strong>Beste voor:</strong> Brazilian, intieme zones</p>
                                    <p><strong>Huidtype:</strong> Gevoelige en reactieve huid</p>
                                    <p><strong>Kenmerk:</strong> Extra lage temperatuur</p>
                                    <ul class="check-list">
                                        <li>Hypoallergeen</li>
                                        <li>Minimale roodheid na behandeling</li>
                                        <li>Premium Portugese formule</li>
                                    </ul>
                                    <a href="<?php echo home_url('/product/intimicire/'); ?>" class="btn btn-sage btn-block">Bekijk Intimicire</a>
                                </div>
                            </div>
                            
                            <div class="product-option">
                                <div class="product-option-header" style="background: linear-gradient(135deg, #F2E8D5 0%, #E5D9C4 100%);">
                                    <h3>Gold Hotwax</h3>
                                    <span class="product-tag">Gezicht</span>
                                </div>
                                <div class="product-option-body">
                                    <p><strong>Beste voor:</strong> Wenkbrauwen, bovenlip, kin</p>
                                    <p><strong>Huidtype:</strong> Normale tot gevoelige huid</p>
                                    <p><strong>Kenmerk:</strong> Zacht voor delicate gezichtshuid</p>
                                    <ul class="check-list">
                                        <li>Precies werken mogelijk</li>
                                        <li>Trekt fijne haartjes mee</li>
                                        <li>Luxe uitstraling</li>
                                    </ul>
                                    <a href="<?php echo home_url('/product/gold-hotwax/'); ?>" class="btn btn-sage btn-block">Bekijk Gold Hotwax</a>
                                </div>
                            </div>
                            
                            <div class="product-option">
                                <div class="product-option-header" style="background: linear-gradient(135deg, #F9F9F7 0%, #EEEEEB 100%);">
                                    <h3>Nacree Blanche</h3>
                                    <span class="product-tag">All-rounder</span>
                                </div>
                                <div class="product-option-body">
                                    <p><strong>Beste voor:</strong> Alle lichaamsdelen</p>
                                    <p><strong>Huidtype:</strong> Alle huidtypes</p>
                                    <p><strong>Kenmerk:</strong> Veelzijdig en betrouwbaar</p>
                                    <ul class="check-list">
                                        <li>Goede grip op alle haartypes</li>
                                        <li>Parelmoer glans</li>
                                        <li>Favoriet bij professionals</li>
                                    </ul>
                                    <a href="<?php echo home_url('/product/nacree-blanche/'); ?>" class="btn btn-sage btn-block">Bekijk Nacree Blanche</a>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                    
                    <!-- Stripwax Section -->
                    <section id="stripwax" class="content-section">
                        <h2>Stripwax (zachte wax)</h2>
                        
                        <p class="lead">Stripwax is ideaal voor grote oppervlakten zoals benen en armen. Je brengt de wax aan, legt er een strip op en trekt deze van de huid.</p>
                        
                        <div class="info-box info-box-sage">
                            <div class="info-box-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                            </div>
                            <div class="info-box-content">
                                <strong>Harspatronen vs. blik</strong>
                                <p>Harspatronen zijn handig voor thuis — schoon en gecontroleerd doseren. Blikken zijn voordeliger voor professionals die veel behandelingen doen.</p>
                            </div>
                        </div>
                        
                        <div class="product-comparison product-comparison-2col">
                            
                            <div class="product-option">
                                <div class="product-option-header" style="background: var(--sage-light);">
                                    <h3>Harspatronen</h3>
                                    <span class="product-tag">Thuisgebruik</span>
                                </div>
                                <div class="product-option-body">
                                    <p><strong>Beste voor:</strong> Benen, armen thuis</p>
                                    <p><strong>Formaten:</strong> Rose, Chloro, Naturel</p>
                                    <ul class="check-list">
                                        <li>Makkelijk in gebruik</li>
                                        <li>Geen knoeien</li>
                                        <li>Hygiënisch</li>
                                    </ul>
                                    <a href="<?php echo home_url('/product-categorie/harspatronen/'); ?>" class="btn btn-sage btn-block">Bekijk harspatronen</a>
                                </div>
                            </div>
                            
                            <div class="product-option">
                                <div class="product-option-header" style="background: var(--cream-dark);">
                                    <h3>Stripwax blik</h3>
                                    <span class="product-tag">Professionals</span>
                                </div>
                                <div class="product-option-body">
                                    <p><strong>Beste voor:</strong> Salons, veel behandelingen</p>
                                    <p><strong>Formaten:</strong> 400ml en 800ml</p>
                                    <ul class="check-list">
                                        <li>Voordeliger per behandeling</li>
                                        <li>Grote hoeveelheden</li>
                                        <li>Professioneel resultaat</li>
                                    </ul>
                                    <a href="<?php echo home_url('/product-categorie/striphars/'); ?>" class="btn btn-primary btn-block">Bekijk stripwax blikken</a>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                    
                    <!-- Checklist Section -->
                    <section id="checklist" class="content-section">
                        <h2>Waar let je op bij het kopen van wax?</h2>
                        
                        <div class="checklist-detailed">
                            
                            <div class="checklist-item-large">
                                <div class="checklist-number">1</div>
                                <div class="checklist-content">
                                    <h4>Behandelgebied</h4>
                                    <p>Gevoelige zones (bikinilijn, oksels, gezicht) → Hotwax<br>
                                    Grote oppervlakten (benen, armen, rug) → Stripwax</p>
                                </div>
                            </div>
                            
                            <div class="checklist-item-large">
                                <div class="checklist-number">2</div>
                                <div class="checklist-content">
                                    <h4>Huidtype</h4>
                                    <p>Gevoelige of reactieve huid? Kies een lage-temperatuur variant zoals Intimicire of Sunset. Deze zijn hypoallergeen en veroorzaken minimale irritatie.</p>
                                </div>
                            </div>
                            
                            <div class="checklist-item-large">
                                <div class="checklist-number">3</div>
                                <div class="checklist-content">
                                    <h4>Ervaring</h4>
                                    <p>Net beginnen? Start met een complete set inclusief verwarmer, wax en accessoires. Zo weet je zeker dat alles op elkaar is afgestemd.</p>
                                </div>
                            </div>
                            
                            <div class="checklist-item-large">
                                <div class="checklist-number">4</div>
                                <div class="checklist-content">
                                    <h4>Kwaliteit</h4>
                                    <p>Goedkope wax kan aan de huid plakken, breken of irritatie veroorzaken. Investeer in kwaliteit — je huid zal je dankbaar zijn.</p>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                    
                    <!-- CTA -->
                    <section class="content-section">
                        <div class="cta-box">
                            <h3>Nog twijfels?</h3>
                            <p>Doe onze quiz en ontdek in 1 minuut welke wax perfect bij jou past.</p>
                            <div class="cta-buttons">
                                <a href="<?php echo home_url('/#quiz'); ?>" class="btn btn-primary">Start de quiz →</a>
                                <a href="<?php echo home_url('/#sets'); ?>" class="btn btn-secondary">Bekijk startersets</a>
                            </div>
                        </div>
                    </section>
                    
                </div>
                
                <!-- Sidebar -->
                <aside class="content-sidebar">
                    <div class="sidebar-sticky">
                        
                        <div class="sidebar-widget">
                            <h4 class="sidebar-title">Snel naar</h4>
                            <nav class="sidebar-nav">
                                <ul>
                                    <li><a href="#hotwax">Hotwax</a></li>
                                    <li><a href="#stripwax">Stripwax</a></li>
                                    <li><a href="#checklist">Checklist</a></li>
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="sidebar-widget sidebar-help">
                            <h4>Advies nodig?</h4>
                            <p>We helpen je graag met de juiste keuze.</p>
                            <a href="mailto:info@waxing-shop.nl" class="btn btn-secondary btn-sm btn-block">
                                Stel je vraag
                            </a>
                        </div>
                        
                    </div>
                </aside>
                
            </div>
        </div>
    </article>
    
    <!-- Related -->
    <section class="related-section section">
        <div class="container">
            <div class="section-header" style="text-align:center;margin-bottom:48px;">
                <p class="section-eyebrow" style="justify-content:center;">Meer informatie</p>
                <h2 class="section-title">Lees verder</h2>
            </div>
            
            <div class="related-grid">
                <a href="<?php echo home_url('/waxen/'); ?>" class="related-card">
                    <div class="related-card-content">
                        <h3>Complete waxing gids</h3>
                        <p>Alles over waxen: van voorbereiding tot nazorg. Stap voor stap uitgelegd.</p>
                        <span class="related-link">Lees de gids →</span>
                    </div>
                </a>
                
                <a href="<?php echo home_url('/wax-kopen-groothandel/'); ?>" class="related-card">
                    <div class="related-card-content">
                        <h3>Voor salons</h3>
                        <p>Professionele wax tegen groothandelsprijzen. Tot 40% korting voor zakelijke klanten.</p>
                        <span class="related-link">Bekijk B2B →</span>
                    </div>
                </a>
                
                <a href="<?php echo home_url('/#sets'); ?>" class="related-card">
                    <div class="related-card-content">
                        <h3>Startersets</h3>
                        <p>Complete sets met alles wat je nodig hebt. Direct beginnen, geen gedoe.</p>
                        <span class="related-link">Bekijk sets →</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>
