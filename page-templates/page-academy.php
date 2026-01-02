<?php
/**
 * Template Name: Academy
 * Template Post Type: page
 * 
 * Waxing Academy page with tutorials and videos
 * URL: /academy/
 * 
 * @package Waxing_Shop
 * @since 5.0
 */

get_header();
?>

<main id="primary" class="academy-page">
    
    <!-- Hero Section -->
    <section class="academy-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li>Academy</li>
                </ol>
            </nav>
            
            <div class="academy-hero-content">
                <p class="hero-eyebrow">Gratis leren</p>
                <h1 class="page-title">Waxing Academy</h1>
                <p class="page-intro">Leer waxen als een pro met onze gratis handleidingen, video's en tips. Van beginner tot expert.</p>
            </div>
        </div>
    </section>
    
    <!-- Video Tutorials Section -->
    <section class="academy-videos section">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 48px;">
                <p class="section-eyebrow" style="justify-content: center;">Video tutorials</p>
                <h2 class="section-title">Bekijk en leer</h2>
            </div>
            
            <div class="videos-grid">
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <!-- THUMBNAIL: Upload een thumbnail afbeelding -->
                        <div class="image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5,3 19,12 5,21"></polygon>
                            </svg>
                            <span>Video thumbnail</span>
                        </div>
                        <span class="video-duration">5:32</span>
                    </div>
                    <div class="video-content">
                        <span class="video-category">Beginners</span>
                        <h3>Je eerste keer waxen</h3>
                        <p>Stap voor stap uitleg voor als je nog nooit hebt gewaxed.</p>
                    </div>
                </div>
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <div class="image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5,3 19,12 5,21"></polygon>
                            </svg>
                            <span>Video thumbnail</span>
                        </div>
                        <span class="video-duration">7:15</span>
                    </div>
                    <div class="video-content">
                        <span class="video-category">Hotwax</span>
                        <h3>Hotwax aanbrengen</h3>
                        <p>Leer de perfecte techniek voor striploze wax.</p>
                    </div>
                </div>
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <div class="image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5,3 19,12 5,21"></polygon>
                            </svg>
                            <span>Video thumbnail</span>
                        </div>
                        <span class="video-duration">6:45</span>
                    </div>
                    <div class="video-content">
                        <span class="video-category">Bikinilijn</span>
                        <h3>Bikinilijn waxen</h3>
                        <p>Tips voor een pijnloze en effectieve behandeling.</p>
                    </div>
                </div>
                
                <div class="video-card">
                    <div class="video-thumbnail">
                        <div class="image-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5,3 19,12 5,21"></polygon>
                            </svg>
                            <span>Video thumbnail</span>
                        </div>
                        <span class="video-duration">4:20</span>
                    </div>
                    <div class="video-content">
                        <span class="video-category">Nazorg</span>
                        <h3>Huidverzorging na waxen</h3>
                        <p>Voorkom irritatie en ingegroeide haartjes.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Guides Section -->
    <section class="academy-guides section" style="background: var(--cream-dark);">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 48px;">
                <p class="section-eyebrow" style="justify-content: center;">Handleidingen</p>
                <h2 class="section-title">Stap voor stap uitleg</h2>
            </div>
            
            <div class="guides-grid">
                
                <a href="<?php echo home_url('/waxen/'); ?>" class="guide-card">
                    <div class="guide-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14,2 L6,2 C4.9,2 4,2.9 4,4 L4,20 C4,21.1 4.9,22 6,22 L18,22 C19.1,22 20,21.1 20,20 L20,8 L14,2 Z"></path>
                            <polyline points="14,2 14,8 20,8"></polyline>
                        </svg>
                    </div>
                    <div class="guide-content">
                        <h3>Complete waxing gids</h3>
                        <p>Alles wat je moet weten over waxen. Van voorbereiding tot nazorg.</p>
                        <span class="guide-meta">15 min leestijd</span>
                    </div>
                    <span class="guide-arrow">→</span>
                </a>
                
                <a href="<?php echo home_url('/hars-kopen/'); ?>" class="guide-card">
                    <div class="guide-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1,1 L5,1 L7.68,14.39 C7.77,14.83 8.15,15.15 8.6,15.15 L19.4,15.15 C19.82,15.15 20.19,14.87 20.31,14.46 L22,8 L5.5,8"></path>
                        </svg>
                    </div>
                    <div class="guide-content">
                        <h3>Welke wax moet ik kopen?</h3>
                        <p>Hotwax of stripwax? Ontdek welke wax bij jou past.</p>
                        <span class="guide-meta">8 min leestijd</span>
                    </div>
                    <span class="guide-arrow">→</span>
                </a>
                
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09,9 C9.32,8.33 9.81,7.8 10.44,7.52 C11.07,7.24 11.79,7.24 12.42,7.52 C13.05,7.8 13.54,8.33 13.77,9 C14,9.67 13.96,10.42 13.67,11.06 C13.38,11.7 12.86,12.18 12.23,12.39 C12.08,12.44 12,12.59 12,12.75 L12,13"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div class="guide-content">
                        <h3>Veelgestelde vragen</h3>
                        <p>Antwoorden op de meest gestelde vragen over waxen.</p>
                        <span class="guide-meta">5 min leestijd</span>
                    </div>
                    <span class="guide-arrow">→</span>
                </a>
                
                <a href="#" class="guide-card">
                    <div class="guide-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84,4.61 C19.58,3.35 17.59,3.35 16.34,4.61 L12,8.95 L7.66,4.61 C6.41,3.35 4.42,3.35 3.16,4.61 C1.9,5.87 1.9,7.86 3.16,9.12 L12,18 L20.84,9.12 C22.1,7.86 22.1,5.87 20.84,4.61 Z"></path>
                        </svg>
                    </div>
                    <div class="guide-content">
                        <h3>Gevoelige huid tips</h3>
                        <p>Speciale tips voor mensen met een gevoelige of reactieve huid.</p>
                        <span class="guide-meta">6 min leestijd</span>
                    </div>
                    <span class="guide-arrow">→</span>
                </a>
                
            </div>
        </div>
    </section>
    
    <!-- Tips per Body Part -->
    <section class="academy-bodyparts section">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 48px;">
                <p class="section-eyebrow" style="justify-content: center;">Per lichaamsdeel</p>
                <h2 class="section-title">Specifieke tips</h2>
            </div>
            
            <div class="bodyparts-grid">
                
                <div class="bodypart-card">
                    <h3>Benen</h3>
                    <ul>
                        <li>Gebruik stripwax voor sneller werken</li>
                        <li>Werk in lange stroken van enkel naar knie</li>
                        <li>Strek je been voor een strakke huid</li>
                    </ul>
                    <a href="<?php echo home_url('/waxen/#lichaamsdelen'); ?>" class="bodypart-link">Lees meer →</a>
                </div>
                
                <div class="bodypart-card">
                    <h3>Bikinilijn</h3>
                    <ul>
                        <li>Kies altijd voor hotwax</li>
                        <li>Werk in kleine secties</li>
                        <li>Let op de groeirichting</li>
                    </ul>
                    <a href="<?php echo home_url('/waxen/#lichaamsdelen'); ?>" class="bodypart-link">Lees meer →</a>
                </div>
                
                <div class="bodypart-card">
                    <h3>Oksels</h3>
                    <ul>
                        <li>Haar groeit meerdere richtingen</li>
                        <li>Gebruik lage-temperatuur wax</li>
                        <li>Kleine hoeveelheden per keer</li>
                    </ul>
                    <a href="<?php echo home_url('/waxen/#lichaamsdelen'); ?>" class="bodypart-link">Lees meer →</a>
                </div>
                
                <div class="bodypart-card">
                    <h3>Gezicht</h3>
                    <ul>
                        <li>Gold wax is ideaal</li>
                        <li>Precies werken vereist</li>
                        <li>Extra voorzichtig met temperatuur</li>
                    </ul>
                    <a href="<?php echo home_url('/waxen/#lichaamsdelen'); ?>" class="bodypart-link">Lees meer →</a>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Download Section -->
    <section class="academy-downloads section" style="background: var(--sage);">
        <div class="container">
            <div class="downloads-content" style="text-align: center; color: white;">
                <h2 style="color: white;">Download onze gratis handleiding</h2>
                <p style="opacity: 0.9; max-width: 600px; margin: 0 auto 32px;">Ontvang onze complete PDF handleiding met alle tips en tricks voor het perfecte waxresultaat.</p>
                
                <form class="download-form" action="#" method="post">
                    <input type="email" name="email" placeholder="Je e-mailadres" required>
                    <button type="submit" class="btn btn-primary" style="background: white; color: var(--sage);">
                        Download gratis
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21,15 L21,19 C21,20.1 20.1,21 19,21 L5,21 C3.9,21 3,20.1 3,19 L3,15"></path>
                            <polyline points="7,10 12,15 17,10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </button>
                </form>
                
                <p style="font-size: 13px; opacity: 0.7; margin-top: 16px;">We sturen je ook af en toe tips. Je kunt je altijd uitschrijven.</p>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="academy-cta section">
        <div class="container">
            <div class="cta-box" style="background: var(--cream-dark); padding: 60px; border-radius: var(--radius-lg); text-align: center;">
                <h2>Klaar om te beginnen?</h2>
                <p style="color: #666; max-width: 500px; margin: 0 auto 32px;">Met onze startersets heb je alles in huis voor je eerste waxbehandeling.</p>
                <div class="cta-buttons" style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo home_url('/#sets'); ?>" class="btn btn-sage">Bekijk startersets →</a>
                    <a href="<?php echo home_url('/#quiz'); ?>" class="btn btn-secondary">Doe de quiz</a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<style>
/* Academy Page Styles */
.academy-hero {
    padding: 120px 0 80px;
    background: linear-gradient(135deg, var(--dark) 0%, #2a2a2a 100%);
    color: white;
}

.academy-hero .breadcrumb a,
.academy-hero .breadcrumb li {
    color: rgba(255,255,255,0.7);
}

.academy-hero .hero-eyebrow {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--gold);
    margin-bottom: 16px;
}

.academy-hero .page-title {
    font-size: clamp(36px, 5vw, 56px);
    margin-bottom: 20px;
    color: white;
}

.academy-hero .page-intro {
    font-size: 18px;
    color: rgba(255,255,255,0.8);
    line-height: 1.7;
    max-width: 600px;
}

/* Videos Grid */
.videos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
}

.video-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.video-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.video-thumbnail {
    position: relative;
    aspect-ratio: 16/9;
    background: var(--dark);
}

.video-thumbnail .image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--dark) 0%, #3a3a3a 100%);
    border: none;
    border-radius: 0;
    color: white;
}

.video-thumbnail .image-placeholder svg {
    opacity: 0.5;
}

.video-thumbnail .image-placeholder span {
    font-size: 12px;
    opacity: 0.5;
    margin-top: 8px;
}

.video-duration {
    position: absolute;
    bottom: 12px;
    right: 12px;
    padding: 4px 8px;
    background: rgba(0,0,0,0.8);
    color: white;
    font-size: 12px;
    font-weight: 600;
    border-radius: 4px;
}

.video-content {
    padding: 24px;
}

.video-category {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--sage);
    margin-bottom: 8px;
}

.video-card h3 {
    font-size: 18px;
    margin-bottom: 8px;
}

.video-card p {
    font-size: 14px;
    color: #666;
    line-height: 1.5;
}

/* Guides Grid */
.guides-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

.guide-card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 24px;
    background: white;
    border-radius: var(--radius-md);
    transition: all var(--transition-fast);
}

.guide-card:hover {
    transform: translateX(8px);
    box-shadow: var(--shadow-md);
}

.guide-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--sage-light);
    border-radius: var(--radius-md);
    color: var(--sage);
}

.guide-content {
    flex: 1;
}

.guide-content h3 {
    font-size: 17px;
    margin-bottom: 4px;
    color: var(--dark);
}

.guide-content p {
    font-size: 14px;
    color: #666;
    margin-bottom: 8px;
    line-height: 1.5;
}

.guide-meta {
    font-size: 12px;
    color: #999;
}

.guide-arrow {
    font-size: 20px;
    color: var(--sage);
    transition: transform var(--transition-fast);
}

.guide-card:hover .guide-arrow {
    transform: translateX(4px);
}

/* Bodyparts Grid */
.bodyparts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
}

.bodypart-card {
    padding: 28px;
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
}

.bodypart-card h3 {
    font-size: 20px;
    margin-bottom: 16px;
    color: var(--dark);
}

.bodypart-card ul {
    list-style: none;
    margin: 0 0 20px;
    padding: 0;
}

.bodypart-card li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 10px;
    font-size: 14px;
    color: #555;
    line-height: 1.5;
}

.bodypart-card li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--sage);
    font-weight: bold;
}

.bodypart-link {
    font-size: 14px;
    font-weight: 600;
    color: var(--sage);
}

/* Download Form */
.download-form {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    max-width: 500px;
    margin: 0 auto;
}

.download-form input {
    flex: 1;
    min-width: 250px;
    padding: 16px 20px;
    border: none;
    border-radius: var(--radius-full);
    font-size: 15px;
}

.download-form .btn {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Image Placeholder */
.image-placeholder {
    aspect-ratio: 16/9;
    background: var(--cream-dark);
    border: 2px dashed var(--border);
    border-radius: var(--radius-md);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: 14px;
}
</style>

<?php get_footer(); ?>
