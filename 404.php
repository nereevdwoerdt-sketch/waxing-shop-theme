<?php
/**
 * 404 Error Page Template
 * 
 * @package Waxing_Shop
 * @since 4.0
 */

get_header();
?>

<main id="primary" class="error-404">
    
    <div class="error-container">
        <div class="error-content">
            
            <div class="error-illustration" aria-hidden="true">
                <svg width="200" height="200" viewBox="0 0 200 200" fill="none">
                    <!-- Wax drop illustration -->
                    <circle cx="100" cy="100" r="80" fill="var(--cream-dark)" stroke="var(--border)" stroke-width="2"/>
                    <path d="M100 40 C100 40 60 80 60 110 C60 132 78 150 100 150 C122 150 140 132 140 110 C140 80 100 40 100 40Z" fill="var(--sage-light)" stroke="var(--sage)" stroke-width="2"/>
                    <circle cx="85" cy="95" r="8" fill="white" opacity="0.6"/>
                    <!-- Sad face -->
                    <circle cx="85" cy="105" r="4" fill="var(--sage)"/>
                    <circle cx="115" cy="105" r="4" fill="var(--sage)"/>
                    <path d="M90 125 Q100 118 110 125" stroke="var(--sage)" stroke-width="3" fill="none" stroke-linecap="round"/>
                </svg>
            </div>
            
            <h1 class="error-title">404</h1>
            <h2 class="error-subtitle">Oeps, deze pagina bestaat niet</h2>
            <p class="error-text">De pagina die je zoekt is verplaatst, verwijderd of heeft nooit bestaan. Geen zorgen, we helpen je op weg.</p>
            
            <div class="error-actions">
                <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3,9 L12,2 L21,9 L21,20 C21,21.1 20.1,22 19,22 L5,22 C3.9,22 3,21.1 3,20 L3,9 Z"></path>
                        <polyline points="9,22 9,12 15,12 15,22"></polyline>
                    </svg>
                    Naar homepage
                </a>
                <a href="<?php echo home_url('/winkel/'); ?>" class="btn btn-secondary">
                    Bekijk producten
                </a>
            </div>
            
            <!-- Search -->
            <div class="error-search">
                <p>Of zoek naar wat je nodig hebt:</p>
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <label for="error-search-input" class="sr-only">Zoeken</label>
                    <input type="search" 
                           id="error-search-input"
                           class="search-input" 
                           placeholder="Zoek producten, artikelen..." 
                           value="" 
                           name="s" />
                    <button type="submit" class="search-submit btn btn-sage">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Zoeken
                    </button>
                </form>
            </div>
            
        </div>
        
        <!-- Popular Links -->
        <div class="error-suggestions">
            <h3>Populaire pagina's</h3>
            <div class="suggestions-grid">
                <a href="<?php echo home_url('/#sets'); ?>" class="suggestion-card">
                    <span class="suggestion-icon">📦</span>
                    <span class="suggestion-title">Startersets</span>
                    <span class="suggestion-desc">Alles om te beginnen</span>
                </a>
                <a href="<?php echo home_url('/waxen/'); ?>" class="suggestion-card">
                    <span class="suggestion-icon">📖</span>
                    <span class="suggestion-title">Waxing gids</span>
                    <span class="suggestion-desc">Leer zelf waxen</span>
                </a>
                <a href="<?php echo home_url('/product-categorie/hot-wax/'); ?>" class="suggestion-card">
                    <span class="suggestion-icon">🍯</span>
                    <span class="suggestion-title">Hotwax</span>
                    <span class="suggestion-desc">Voor gevoelige zones</span>
                </a>
                <a href="<?php echo home_url('/contact/'); ?>" class="suggestion-card">
                    <span class="suggestion-icon">💬</span>
                    <span class="suggestion-title">Contact</span>
                    <span class="suggestion-desc">Stel je vraag</span>
                </a>
            </div>
        </div>
        
    </div>
    
</main>

<style>
.error-404 {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    background: var(--cream);
}

.error-container {
    max-width: 700px;
    text-align: center;
}

.error-content {
    margin-bottom: 60px;
}

.error-illustration {
    margin-bottom: 32px;
}

.error-title {
    font-size: clamp(80px, 15vw, 140px);
    font-weight: 400;
    color: var(--sage);
    line-height: 1;
    margin-bottom: 8px;
}

.error-subtitle {
    font-size: clamp(24px, 4vw, 32px);
    margin-bottom: 16px;
    color: var(--dark);
}

.error-text {
    font-size: 17px;
    color: #666;
    max-width: 500px;
    margin: 0 auto 32px;
    line-height: 1.7;
}

.error-actions {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 48px;
}

.error-actions .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.error-search {
    max-width: 500px;
    margin: 0 auto;
}

.error-search p {
    font-size: 14px;
    color: #888;
    margin-bottom: 12px;
}

.error-search .search-form {
    display: flex;
    gap: 8px;
}

.error-search .search-input {
    flex: 1;
    padding: 14px 20px;
    border: 1px solid var(--border);
    border-radius: var(--radius-full);
    font-size: 15px;
    background: white;
}

.error-search .search-input:focus {
    outline: none;
    border-color: var(--sage);
}

.error-search .search-submit {
    display: flex;
    align-items: center;
    gap: 8px;
}

.error-suggestions h3 {
    font-size: 18px;
    margin-bottom: 24px;
    color: var(--dark);
}

.suggestions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 16px;
}

.suggestion-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 24px 16px;
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    transition: all var(--transition-fast);
}

.suggestion-card:hover {
    border-color: var(--sage);
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.suggestion-icon {
    font-size: 32px;
    margin-bottom: 12px;
}

.suggestion-title {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 4px;
}

.suggestion-desc {
    font-size: 13px;
    color: #888;
}

@media (max-width: 600px) {
    .error-search .search-form {
        flex-direction: column;
    }
    
    .suggestions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<?php get_footer(); ?>
