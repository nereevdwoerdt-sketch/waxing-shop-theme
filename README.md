# Waxing Shop Theme v4.0

Premium WooCommerce theme voor waxing-shop.nl met conversion-optimized homepage, pillar pages voor SEO, blog templates, en B2B groothandel functionaliteit.

## 🆕 Nieuw in v4.0

### Page Templates
- **page-waxen.php** - Uitgebreide pillar page voor `/waxen/` (12+ min leestijd, complete waxing gids)
- **page-hars-kopen.php** - Korte koopgids voor `/hars-kopen/`
- **page-groothandel.php** - B2B pagina voor salons met pricing table en registratie

### Blog Templates
- **archive.php** - Blog overzicht met featured post, category filters, grid layout
- **single.php** - Blog posts met share sidebar, auto-generated TOC, author box

### Utility Templates
- **page.php** - Standaard pagina template met breadcrumbs en child pages
- **404.php** - Styled 404 pagina met zoekfunctie en suggesties
- **search.php** - Zoekresultaten met filters (producten/artikelen)

### CSS Files
- **content-pages.css** - Styling voor pillar pages (TOC, accordions, steps, FAQ, benefits)
- **blog.css** - Complete blog styling (cards, pagination, newsletter)
- **wholesale.css** - B2B pagina styling (pricing tables, testimonials, forms)

## 📁 Structuur

```
waxing-shop-theme-v4/
├── style.css                 # Main stylesheet met CSS variables
├── functions.php             # Theme setup, scripts, WooCommerce
├── header.php                # Site header met trust bar, nav, cart
├── footer.php                # Site footer met links, newsletter
├── front-page.php            # Homepage met hero, sets, quiz, reviews
├── index.php                 # Fallback template
│
├── page.php                  # Default page template
├── archive.php               # Blog archive
├── single.php                # Single blog post
├── search.php                # Search results
├── 404.php                   # 404 error page
│
├── page-templates/
│   ├── page-waxen.php        # Pillar page: /waxen/
│   ├── page-hars-kopen.php   # Buying guide: /hars-kopen/
│   └── page-groothandel.php  # B2B: /wax-kopen-groothandel/
│
├── woocommerce/
│   └── archive-product.php   # Shop page
│
├── css/
│   ├── components.css        # Buttons, cards, modals
│   ├── sections.css          # Hero, sets, quiz sections
│   ├── shop.css              # WooCommerce shop styling
│   ├── content-pages.css     # Pillar pages styling
│   ├── blog.css              # Blog styling
│   └── wholesale.css         # B2B styling
│
├── js/
│   └── main.js               # All JavaScript functionality
│
└── inc/
    ├── setup.php             # Theme configuration
    ├── ajax.php              # AJAX handlers
    ├── shortcodes.php        # [starter_sets], [wax_quiz], etc.
    └── helpers.php           # Utility functions
```

## 🎨 Design System

### Kleuren
```css
--sage: #7D8B75        /* Primary accent */
--sage-dark: #5C6B54   /* Hover states */
--dark: #1a1a1a        /* Text */
--cream: #FAFAF8       /* Background */
--gold: #C4A484        /* Secondary accent */
```

### Typography
- **Headings:** DM Serif Display
- **Body:** DM Sans

## 📄 Page Templates Gebruiken

### Pillar Page (/waxen/)
1. Maak nieuwe pagina aan in WordPress
2. Selecteer "Waxen Gids" template
3. Stel slug in op `waxen`

### Koopgids (/hars-kopen/)
1. Maak nieuwe pagina aan
2. Selecteer "Hars Kopen Gids" template
3. Stel slug in op `hars-kopen`

### Groothandel (/wax-kopen-groothandel/)
1. Maak nieuwe pagina aan
2. Selecteer "Groothandel B2B" template
3. Stel slug in op `wax-kopen-groothandel`

## 📝 Shortcodes

```php
[starter_sets count="3"]           // Startersets grid
[starter_sets compact="true"]      // Compacte versie
[waxing_products count="4"]        // Producten grid
[wax_quiz]                         // Interactieve quiz
[testimonials]                     // Reviews carousel
[faq]                              // FAQ accordion
[academy]                          // Academy cards
```

## ⚙️ Installatie

1. Upload theme naar `/wp-content/themes/`
2. Activeer in WordPress admin
3. Installeer WooCommerce
4. Importeer producten
5. Maak pagina's aan met juiste templates

## 🔧 Vereisten

- WordPress 6.0+
- WooCommerce 8.0+
- PHP 8.0+

## 📱 Responsive & Accessibility

- Mobile-first design
- WCAG 2.1 AA compliant
- Skip links & focus states
- Reduced motion support
- Semantic HTML

---

Waxing Shop Theme © 2024
