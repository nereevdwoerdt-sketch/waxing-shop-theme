<?php
/**
 * Template Name: Over Ons
 * Template Post Type: page
 * 
 * About us page
 * URL: /over-ons/
 * 
 * @package Waxing_Shop
 * @since 5.0
 */

get_header();
?>

<main id="primary" class="about-page">
    
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li>Over ons</li>
                </ol>
            </nav>
            
            <div class="about-hero-content">
                <p class="hero-eyebrow">Ons verhaal</p>
                <h1 class="page-title">20+ jaar passie voor waxen</h1>
                <p class="page-intro">Van kleine schoonheidssalon tot dé specialist in professionele waxproducten. Ontdek het verhaal achter Waxing Shop.</p>
            </div>
        </div>
    </section>
    
    <!-- Story Section -->
    <section class="about-story section">
        <div class="container">
            <div class="story-grid">
                <div class="story-image">
                    <!-- FOTO: Plaats hier een foto van de salon of het team -->
                    <!-- In WordPress: gebruik de Featured Image of voeg een afbeelding toe via de editor -->
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                    <?php else : ?>
                        <div class="image-placeholder">
                            <span>Foto: Salon of team</span>
                            <small>Upload via WordPress media</small>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="story-content">
                    <h2>Hoe het begon</h2>
                    <p>Waxing Shop is ontstaan vanuit een schoonheidssalon met meer dan 20 jaar ervaring. Dag in dag uit werkten we met verschillende waxproducten en merkten we enorme kwaliteitsverschillen.</p>
                    
                    <p>Na jaren zoeken vonden we eindelijk de perfecte producten: professionele wax uit Portugal die zacht is voor de huid én effectief tegen elk haartje. Onze klanten waren enthousiast en vroegen of ze de producten ook thuis konden gebruiken.</p>
                    
                    <p>Zo ontstond Waxing Shop: om iedereen toegang te geven tot dezelfde professionele kwaliteit die wij in de salon gebruiken.</p>
                    
                    <div class="story-signature">
                        <p><strong>Hans van der Woerdt</strong></p>
                        <p>Oprichter Waxing Shop</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Values Section -->
    <section class="about-values section" style="background: var(--cream-dark);">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                <p class="section-eyebrow" style="justify-content: center;">Waar we voor staan</p>
                <h2 class="section-title">Onze waarden</h2>
            </div>
            
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12,2 L15.09,8.26 L22,9.27 L17,14.14 L18.18,21.02 L12,17.77 L5.82,21.02 L7,14.14 L2,9.27 L8.91,8.26 Z"></path>
                        </svg>
                    </div>
                    <h3>Kwaliteit boven alles</h3>
                    <p>We verkopen alleen producten die we zelf dagelijks gebruiken in de salon. Geen compromissen.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84,4.61 C19.58,3.35 17.59,3.35 16.34,4.61 L12,8.95 L7.66,4.61 C6.41,3.35 4.42,3.35 3.16,4.61 C1.9,5.87 1.9,7.86 3.16,9.12 L12,18 L20.84,9.12 C22.1,7.86 22.1,5.87 20.84,4.61 Z"></path>
                        </svg>
                    </div>
                    <h3>Eerlijk advies</h3>
                    <p>We helpen je de juiste producten te kiezen, ook als dat betekent dat je minder koopt.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17,21 L17,19 C17,16.79 15.21,15 13,15 L5,15 C2.79,15 1,16.79 1,19 L1,21"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23,21 L23,19 C23,17.34 21.93,15.9 20.5,15.4"></path>
                            <path d="M16,3.13 C17.32,3.55 18.26,4.76 18.26,6.2 C18.26,7.64 17.32,8.85 16,9.27"></path>
                        </svg>
                    </div>
                    <h3>Persoonlijke service</h3>
                    <p>Je krijgt altijd een echt mens aan de lijn. Geen callcenters, gewoon wij.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12,22 C17.52,22 22,17.52 22,12 C22,6.48 17.52,2 12,2 C6.48,2 2,6.48 2,12 C2,17.52 6.48,22 12,22 Z"></path>
                            <path d="M12,6 L12,12 L16,14"></path>
                        </svg>
                    </div>
                    <h3>Snelle levering</h3>
                    <p>Besteld voor 14:00? Morgen in huis. Want niemand wil wachten op gladde benen.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Numbers Section -->
    <section class="about-numbers section">
        <div class="container">
            <div class="numbers-grid">
                <div class="number-item">
                    <span class="number-value">20+</span>
                    <span class="number-label">Jaar ervaring</span>
                </div>
                <div class="number-item">
                    <span class="number-value">9.0</span>
                    <span class="number-label">Bol.com score</span>
                </div>
                <div class="number-item">
                    <span class="number-value">40+</span>
                    <span class="number-label">Tevreden salons</span>
                </div>
                <div class="number-item">
                    <span class="number-value">2000+</span>
                    <span class="number-label">Klanten</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Team Section (optioneel) -->
    <section class="about-team section" style="background: var(--cream-dark);">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                <p class="section-eyebrow" style="justify-content: center;">Het team</p>
                <h2 class="section-title">De mensen achter Waxing Shop</h2>
            </div>
            
            <div class="team-grid">
                <div class="team-member">
                    <!-- FOTO: Upload teamfoto via WordPress -->
                    <div class="team-photo">
                        <div class="image-placeholder">
                            <span>Foto</span>
                        </div>
                    </div>
                    <h3>Hans van der Woerdt</h3>
                    <p class="team-role">Oprichter</p>
                    <p class="team-bio">20+ jaar ervaring in de beauty industrie. Gepassioneerd over kwaliteitsproducten en tevreden klanten.</p>
                </div>
                
                <!-- Voeg meer teamleden toe indien gewenst -->
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="about-cta section" style="background: var(--sage);">
        <div class="container">
            <div class="cta-content" style="text-align: center; color: white;">
                <h2 style="color: white;">Vragen? Neem contact op!</h2>
                <p style="opacity: 0.9; margin-bottom: 32px;">We helpen je graag met advies over producten of je bestelling.</p>
                <div class="cta-buttons" style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary" style="background: white; color: var(--sage);">Neem contact op</a>
                    <a href="<?php echo home_url('/#sets'); ?>" class="btn btn-secondary" style="border-color: white; color: white;">Bekijk producten</a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<style>
/* About Page Styles */
.about-hero {
    padding: 120px 0 80px;
    background: var(--cream-dark);
}

.about-hero-content {
    max-width: 700px;
}

.about-hero .hero-eyebrow {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--sage);
    margin-bottom: 16px;
}

.about-hero .page-title {
    font-size: clamp(36px, 5vw, 56px);
    margin-bottom: 20px;
}

.about-hero .page-intro {
    font-size: 18px;
    color: #555;
    line-height: 1.7;
}

/* Story Section */
.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}

.story-image img {
    width: 100%;
    border-radius: var(--radius-lg);
}

.image-placeholder {
    aspect-ratio: 4/3;
    background: var(--cream-dark);
    border: 2px dashed var(--border);
    border-radius: var(--radius-lg);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: 16px;
}

.image-placeholder small {
    font-size: 12px;
    margin-top: 8px;
}

.story-content h2 {
    font-size: 32px;
    margin-bottom: 24px;
}

.story-content p {
    font-size: 17px;
    line-height: 1.8;
    margin-bottom: 20px;
    color: #444;
}

.story-signature {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
}

.story-signature p {
    margin-bottom: 4px;
}

@media (max-width: 900px) {
    .story-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}

/* Values Grid */
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 32px;
}

.value-card {
    background: white;
    padding: 32px;
    border-radius: var(--radius-lg);
    text-align: center;
}

.value-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--sage-light);
    border-radius: 50%;
    margin: 0 auto 20px;
    color: var(--sage);
}

.value-card h3 {
    font-size: 20px;
    margin-bottom: 12px;
}

.value-card p {
    font-size: 15px;
    color: #666;
    line-height: 1.6;
}

/* Numbers Grid */
.numbers-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    text-align: center;
}

.number-value {
    display: block;
    font-family: var(--font-serif);
    font-size: clamp(40px, 6vw, 64px);
    color: var(--sage);
    line-height: 1;
    margin-bottom: 8px;
}

.number-label {
    font-size: 16px;
    color: #666;
}

@media (max-width: 768px) {
    .numbers-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Team Grid */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 40px;
    max-width: 900px;
    margin: 0 auto;
}

.team-member {
    text-align: center;
}

.team-photo {
    width: 180px;
    height: 180px;
    margin: 0 auto 20px;
    border-radius: 50%;
    overflow: hidden;
}

.team-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-photo .image-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    aspect-ratio: auto;
}

.team-member h3 {
    font-size: 22px;
    margin-bottom: 4px;
}

.team-role {
    color: var(--sage);
    font-weight: 600;
    margin-bottom: 12px;
}

.team-bio {
    font-size: 15px;
    color: #666;
    line-height: 1.6;
}
</style>

<?php get_footer(); ?>
