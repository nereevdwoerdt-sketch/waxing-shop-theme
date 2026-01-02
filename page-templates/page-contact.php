<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 * 
 * Contact page
 * URL: /contact/
 * 
 * @package Waxing_Shop
 * @since 5.0
 */

get_header();
?>

<main id="primary" class="contact-page">
    
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li>Contact</li>
                </ol>
            </nav>
            
            <div class="contact-hero-content">
                <p class="hero-eyebrow">Neem contact op</p>
                <h1 class="page-title">Hoe kunnen we je helpen?</h1>
                <p class="page-intro">Vragen over producten, je bestelling of advies nodig? We helpen je graag!</p>
            </div>
        </div>
    </section>
    
    <!-- Contact Options -->
    <section class="contact-options section">
        <div class="container">
            <div class="contact-grid">
                
                <!-- Contact Methods -->
                <div class="contact-methods">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4,4 L20,4 C21.1,4 22,4.9 22,6 L22,18 C22,19.1 21.1,20 20,20 L4,20 C2.9,20 2,19.1 2,18 L2,6 C2,4.9 2.9,4 4,4 Z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h3>E-mail</h3>
                            <p>We reageren binnen 24 uur</p>
                            <a href="mailto:info@waxing-shop.nl" class="contact-link">info@waxing-shop.nl</a>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22,16.92 L22,19.92 C22,20.48 21.56,20.95 21,20.99 C20.5,21.03 20.02,21.01 19.56,20.93 C16.18,20.28 12.97,18.78 10.29,16.54 C7.78,14.46 5.73,11.9 4.29,9 C3.03,6.32 2.47,3.35 2.94,0.47 C3,0.19 3.21,0 3.5,0 L6.5,0 C6.74,0 6.95,0.16 7,0.39 C7.26,1.54 7.65,2.66 8.15,3.72 C8.26,3.96 8.2,4.24 8,4.42 L6.09,6.33 C7.36,8.92 9.08,11.14 11.25,12.91 C13.03,14.35 15.08,15.46 17.29,16.17 L19.21,14.25 C19.38,14.08 19.63,14.01 19.86,14.09 C20.96,14.47 22.11,14.73 23.28,14.86 C23.54,14.89 23.74,15.11 23.74,15.38 L23.74,18.38"></path>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h3>Telefoon</h3>
                            <p>Ma-Vr 9:00 - 17:00</p>
                            <a href="tel:0636092340" class="contact-link">06 360 923 40</a>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21,10 C21,17 12,23 12,23 C12,23 3,17 3,10 C3,5.03 7.03,1 12,1 C16.97,1 21,5.03 21,10 Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h3>Adres</h3>
                            <p>Bezoek alleen op afspraak</p>
                            <address>
                                Waxing Shop<br>
                                Nederland
                            </address>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="contact-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <div class="contact-card-content">
                            <h3>Openingstijden</h3>
                            <p>Webshop: 24/7</p>
                            <p>Klantenservice:<br>Ma-Vr 9:00 - 17:00</p>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <h2>Stuur een bericht</h2>
                    <p>Vul het formulier in en we nemen zo snel mogelijk contact met je op.</p>
                    
                    <form class="contact-form" action="#" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Naam *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mailadres *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefoonnummer</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Onderwerp *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Selecteer een onderwerp</option>
                                <option value="product">Vraag over een product</option>
                                <option value="order">Vraag over mijn bestelling</option>
                                <option value="advice">Advies nodig</option>
                                <option value="wholesale">Zakelijke aanvraag / Groothandel</option>
                                <option value="other">Anders</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="order_number">Bestelnummer (indien van toepassing)</label>
                            <input type="text" id="order_number" name="order_number" placeholder="Bijv. #12345">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Bericht *</label>
                            <textarea id="message" name="message" rows="5" required placeholder="Hoe kunnen we je helpen?"></textarea>
                        </div>
                        
                        <div class="form-group form-checkbox">
                            <input type="checkbox" id="privacy" name="privacy" required>
                            <label for="privacy">Ik ga akkoord met het <a href="<?php echo home_url('/privacy-policy-2/'); ?>">privacybeleid</a> *</label>
                        </div>
                        
                        <button type="submit" class="btn btn-sage btn-lg">
                            Verstuur bericht
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22,2 15,22 11,13 2,9"></polygon>
                            </svg>
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="contact-faq section" style="background: var(--cream-dark);">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 48px;">
                <p class="section-eyebrow" style="justify-content: center;">Veelgestelde vragen</p>
                <h2 class="section-title">Misschien vind je hier al je antwoord</h2>
            </div>
            
            <div class="faq-grid">
                <div class="faq-item-simple">
                    <h3>Hoe kan ik mijn bestelling volgen?</h3>
                    <p>Na verzending ontvang je een e-mail met een track & trace code. Hiermee kun je je pakket volgen via de website van de bezorgdienst.</p>
                </div>
                
                <div class="faq-item-simple">
                    <h3>Wat zijn de verzendkosten?</h3>
                    <p>Verzending binnen Nederland is gratis vanaf €35. Onder dit bedrag betaal je €4,95 verzendkosten.</p>
                </div>
                
                <div class="faq-item-simple">
                    <h3>Kan ik mijn bestelling retourneren?</h3>
                    <p>Ja, je hebt 14 dagen bedenktijd. Stuur het product ongeopend terug in de originele verpakking. Neem eerst contact met ons op voor de retourprocedure.</p>
                </div>
                
                <div class="faq-item-simple">
                    <h3>Leveren jullie ook aan salons?</h3>
                    <p>Ja! We hebben speciale groothandelsprijzen voor professionals. <a href="<?php echo home_url('/wax-kopen-groothandel/'); ?>">Bekijk onze B2B pagina</a> voor meer informatie.</p>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 40px;">
                <a href="<?php echo home_url('/faq/'); ?>" class="btn btn-secondary">Bekijk alle FAQ's →</a>
            </div>
        </div>
    </section>
    
</main>

<style>
/* Contact Page Styles */
.contact-hero {
    padding: 120px 0 80px;
    background: var(--cream-dark);
}

.contact-hero-content {
    max-width: 700px;
}

.contact-hero .hero-eyebrow {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--sage);
    margin-bottom: 16px;
}

.contact-hero .page-title {
    font-size: clamp(36px, 5vw, 56px);
    margin-bottom: 20px;
}

.contact-hero .page-intro {
    font-size: 18px;
    color: #555;
    line-height: 1.7;
}

/* Contact Grid */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 80px;
    align-items: start;
}

@media (max-width: 900px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 48px;
    }
}

/* Contact Methods */
.contact-methods {
    display: grid;
    gap: 20px;
}

.contact-card {
    display: flex;
    gap: 20px;
    padding: 24px;
    background: var(--cream-dark);
    border-radius: var(--radius-md);
    transition: all var(--transition-fast);
}

.contact-card:hover {
    background: var(--sage-light);
}

.contact-icon {
    flex-shrink: 0;
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    border-radius: 50%;
    color: var(--sage);
}

.contact-card-content h3 {
    font-size: 18px;
    margin: 0 0 4px;
}

.contact-card-content p {
    font-size: 14px;
    color: #666;
    margin: 0 0 8px;
}

.contact-link {
    font-size: 16px;
    font-weight: 600;
    color: var(--sage);
}

.contact-card-content address {
    font-style: normal;
    font-size: 15px;
    color: #444;
    line-height: 1.6;
}

/* Contact Form */
.contact-form-wrapper {
    background: white;
    padding: 40px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
}

.contact-form-wrapper h2 {
    font-size: 28px;
    margin-bottom: 8px;
}

.contact-form-wrapper > p {
    color: #666;
    margin-bottom: 32px;
}

.contact-form .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 600px) {
    .contact-form .form-row {
        grid-template-columns: 1fr;
    }
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--dark);
}

.contact-form input,
.contact-form select,
.contact-form textarea {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    font-size: 15px;
    font-family: inherit;
    transition: border-color var(--transition-fast);
}

.contact-form input:focus,
.contact-form select:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: var(--sage);
}

.contact-form textarea {
    resize: vertical;
    min-height: 120px;
}

.form-checkbox {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.form-checkbox input {
    width: auto;
    margin-top: 3px;
}

.form-checkbox label {
    font-weight: 400;
    margin-bottom: 0;
}

.form-checkbox a {
    color: var(--sage);
}

.contact-form .btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-top: 8px;
}

/* FAQ Grid */
.faq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    max-width: 1000px;
    margin: 0 auto;
}

.faq-item-simple {
    background: white;
    padding: 24px;
    border-radius: var(--radius-md);
}

.faq-item-simple h3 {
    font-size: 17px;
    margin-bottom: 8px;
    color: var(--dark);
}

.faq-item-simple p {
    font-size: 15px;
    color: #666;
    line-height: 1.6;
    margin: 0;
}

.faq-item-simple a {
    color: var(--sage);
    font-weight: 500;
}
</style>

<?php get_footer(); ?>
