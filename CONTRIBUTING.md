# Contributing to Waxing Shop Theme

Bedankt voor je interesse in bijdragen aan dit project! 🎉

## 📋 Getting Started

### Vereisten
- WordPress 6.0+
- WooCommerce 8.0+
- PHP 8.0+
- Node.js 18+ (voor build tools)

### Lokale setup
```bash
# Clone naar themes folder
cd wp-content/themes
git clone [repo-url] waxing-shop-theme

# Installeer dev dependencies (optioneel)
npm install

# Build minified assets
npm run build
```

---

## 🎨 Code Style

### PHP
Volg [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/):

```php
// ✅ Goed
function waxing_get_product_color( $product_id ) {
    if ( ! $product_id ) {
        return array();
    }
    // ...
}

// ❌ Fout
function waxing_get_product_color($product_id) {
    if (!$product_id) return array();
}
```

### CSS
Gebruik CSS variabelen en BEM-achtige naming:

```css
/* ✅ Goed */
.product-card { }
.product-card-image { }
.product-card-image--featured { }
.product-card__badge { }

/* ❌ Fout */
.productCard { }
#product-image { }
.product .card .image { }
```

### JavaScript
ES6+ met jQuery wrapper:

```javascript
// ✅ Goed
(function($) {
    'use strict';
    
    function initFeature() {
        const $element = $('#myElement');
        // ...
    }
    
    $(document).ready(initFeature);
})(jQuery);

// ❌ Fout
var element = document.getElementById('myElement');
```

---

## 🌐 Internationalization (i18n)

**Alle user-facing strings MOETEN vertaalbaar zijn.**

```php
// ✅ Goed
__( 'Toevoegen aan winkelmand', 'waxing-shop' )
_e( 'Lees meer', 'waxing-shop' )
sprintf( __( '%d producten gevonden', 'waxing-shop' ), $count )

// ❌ Fout
'Toevoegen aan winkelmand'
echo 'Lees meer';
$count . ' producten gevonden'
```

### Placeholders
```php
// ✅ Met placeholder
printf( 
    /* translators: %s: product name */
    __( '%s toegevoegd aan winkelmand', 'waxing-shop' ), 
    $product_name 
);

// ✅ Meerdere placeholders
printf(
    /* translators: %1$d: hours, %2$d: minutes */
    __( 'Bestel binnen %1$d:%2$02d uur', 'waxing-shop' ),
    $hours,
    $minutes
);
```

---

## ♿ Accessibility

### Vereist voor alle nieuwe features:

1. **Keyboard navigatie**
   - Alle interactieve elementen focusbaar
   - Tab order logisch
   - Enter/Space activeert knoppen
   - Escape sluit modals

2. **ARIA labels**
   ```html
   <!-- ✅ Goed -->
   <button aria-label="Sluiten">×</button>
   <div role="dialog" aria-modal="true" aria-labelledby="title">
   
   <!-- ❌ Fout -->
   <button>×</button>
   <div class="modal">
   ```

3. **Screen reader support**
   ```php
   // Verborgen tekst voor context
   <span class="sr-only"><?php esc_html_e( 'Was', 'waxing-shop' ); ?></span>
   
   // Live regions voor updates
   <div aria-live="polite">...</div>
   ```

4. **Focus management**
   ```javascript
   // In modals
   trapFocus($modal);
   releaseFocus($modal);
   ```

---

## 📝 Commit Messages

Gebruik [Conventional Commits](https://www.conventionalcommits.org/):

```
feat: Add shipping countdown timer
fix: Resolve focus trap in quick view modal
docs: Update README with new shortcodes
style: Format CSS according to guidelines
refactor: Extract helper functions
perf: Cache bestseller query
a11y: Add ARIA labels to product cards
i18n: Wrap remaining hardcoded strings
```

### Types
| Type | Beschrijving |
|------|-------------|
| `feat` | Nieuwe feature |
| `fix` | Bug fix |
| `docs` | Documentatie |
| `style` | Formatting, CSS |
| `refactor` | Code restructure |
| `perf` | Performance |
| `a11y` | Accessibility |
| `i18n` | Internationalization |
| `test` | Tests |
| `chore` | Maintenance |

---

## ✅ Pull Request Checklist

Voordat je een PR indient:

- [ ] Code volgt WordPress Coding Standards
- [ ] Alle strings zijn i18n-ready
- [ ] Accessibility getest (keyboard, screen reader)
- [ ] Geen console errors
- [ ] Werkt op mobiel (320px+)
- [ ] Werkt zonder WooCommerce actief
- [ ] README bijgewerkt indien nodig
- [ ] Changelog entry toegevoegd

---

## 🧪 Testing

### Handmatige tests
1. **Keyboard**: Tab door alle interactieve elementen
2. **Screen reader**: Test met VoiceOver (Mac) of NVDA (Windows)
3. **Mobile**: Test op echte device of Chrome DevTools
4. **Reduced motion**: Test met `prefers-reduced-motion: reduce`
5. **Dark mode**: Test met `prefers-color-scheme: dark`

### Browser support
- Chrome (laatste 2 versies)
- Firefox (laatste 2 versies)
- Safari (laatste 2 versies)
- Edge (laatste 2 versies)
- iOS Safari
- Chrome for Android

---

## 📁 File Organization

```
Nieuwe feature toevoegen:

1. PHP helper → inc/helpers.php
2. AJAX handler → inc/ajax.php  
3. Shortcode → inc/shortcodes.php
4. CSS → css/components.css of nieuwe file
5. JS → js/main.js (in juiste sectie)
```

---

## 🔒 Security

- Gebruik `check_ajax_referer()` voor AJAX
- Escape alle output: `esc_html()`, `esc_attr()`, `esc_url()`
- Sanitize alle input: `sanitize_text_field()`, `absint()`, etc.
- Geen directe database queries waar mogelijk

```php
// ✅ Goed
check_ajax_referer( 'waxing_nonce', 'nonce' );
$email = sanitize_email( $_POST['email'] );
echo esc_html( $user_input );

// ❌ Fout
$email = $_POST['email'];
echo $user_input;
```

---

## 💬 Vragen?

Open een issue of neem contact op via het team kanaal.
