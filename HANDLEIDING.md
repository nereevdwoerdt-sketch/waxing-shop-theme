# 📘 HANDLEIDING: Waxing Shop Theme v5

## Inhoudsopgave
1. [Theme installeren](#1-theme-installeren)
2. [Pagina's aanmaken](#2-paginas-aanmaken)
3. [Menu instellen](#3-menu-instellen)
4. [Foto's toevoegen](#4-fotos-toevoegen)
5. [Producten aanmaken](#5-producten-aanmaken)
6. [Blog posts schrijven](#6-blog-posts-schrijven)

---

## 1. Theme installeren

### Stap 1: Upload het theme
1. Ga naar **WordPress Admin** → **Weergave** → **Thema's**
2. Klik op **"Nieuwe toevoegen"**
3. Klik op **"Thema uploaden"**
4. Kies het ZIP bestand `waxing-shop-theme-v5.zip`
5. Klik op **"Nu installeren"**
6. Klik op **"Activeren"**

---

## 2. Pagina's aanmaken

Je moet deze pagina's handmatig aanmaken en de juiste template kiezen:

### Overzicht van alle pagina's:

| Pagina naam | URL (slug) | Template kiezen | Prioriteit |
|-------------|------------|-----------------|------------|
| Home | `/` | Front Page (automatisch) | ⭐⭐⭐ |
| Shop | `/shop/` | WooCommerce (automatisch) | ⭐⭐⭐ |
| Over Ons | `/over-ons/` | **Over Ons** | ⭐⭐⭐ |
| Contact | `/contact/` | **Contact** | ⭐⭐⭐ |
| Academy | `/academy/` | **Academy** | ⭐⭐ |
| Waxen Gids | `/waxen/` | **Waxen Gids** | ⭐⭐ |
| Hars Kopen | `/hars-kopen/` | **Hars Kopen Gids** | ⭐⭐ |
| Groothandel | `/wax-kopen-groothandel/` | **Groothandel B2B** | ⭐ |
| Blog | `/blog/` | Standaard | ⭐ |

### Hoe maak je een pagina aan:

1. Ga naar **WordPress Admin** → **Pagina's** → **Nieuwe toevoegen**
2. Vul de **titel** in (bijv. "Over Ons")
3. In de rechter kolom, klik op **"Pagina"** tab
4. Bij **"Template"** → kies de juiste template (bijv. "Over Ons")
5. Klik op **"Publiceren"**

### De slug (URL) aanpassen:
1. Klik op de pagina titel
2. Klik op **"Bewerken"** naast de URL
3. Typ de gewenste slug (bijv. `over-ons`)
4. Klik op **"Opslaan"**

---

## 3. Menu instellen

### Hoofdmenu aanmaken:

1. Ga naar **WordPress Admin** → **Weergave** → **Menu's**
2. Klik op **"Maak een nieuw menu"**
3. Naam: `Hoofdmenu`
4. Voeg pagina's toe:
   - Vink aan: Home, Shop, Over Ons, Academy, Contact
   - Klik **"Aan menu toevoegen"**
5. Sleep items in de juiste volgorde
6. Bij **"Menulocatie"** → vink **"Primary Menu"** aan
7. Klik **"Menu opslaan"**

### Aanbevolen menu structuur:

```
├── Home
├── Shop
│   ├── Startersets
│   ├── Hotwax
│   ├── Stripwax
│   └── Accessoires
├── Waxen (link naar /waxen/)
├── Academy
├── Over Ons
└── Contact
```

### Submenu maken:
Sleep een item iets naar rechts onder een ander item om het een submenu te maken.

---

## 4. Foto's toevoegen

### 4.1 Featured Image (Uitgelichte afbeelding)

Dit is de hoofdfoto van een pagina/product/post.

**Waar verschijnt deze:**
- Over Ons pagina: grote foto naast het verhaal
- Blog posts: header afbeelding
- Producten: product foto

**Hoe toe te voegen:**
1. Bewerk de pagina/post/product
2. In de rechter kolom, zoek **"Uitgelichte afbeelding"**
3. Klik **"Uitgelichte afbeelding instellen"**
4. Upload een foto of kies uit mediabibliotheek
5. Klik **"Uitgelichte afbeelding instellen"**
6. **Opslaan/Bijwerken**

### 4.2 Foto's in de content

**Methode 1: Block Editor (aanbevolen)**
1. Klik op het **+** icoon in de editor
2. Zoek **"Afbeelding"**
3. Upload of kies een foto
4. Pas grootte/uitlijning aan

**Methode 2: Media toevoegen**
1. Klik op **"Media toevoegen"** boven de editor
2. Upload je foto
3. Klik **"Invoegen in pagina"**

### 4.3 Productfoto's (WooCommerce)

1. Ga naar **Producten** → bewerk een product
2. **Productafbeelding** (rechts): de hoofdfoto
3. **Productgalerij** (rechts): extra foto's voor de slider

**Aanbevolen formaat:**
- Minimaal 800x800 pixels
- Vierkant formaat werkt het beste
- JPG of PNG
- Max 500KB per foto

### 4.4 Waar komen foto's op elke pagina?

#### Homepage
De homepage haalt foto's automatisch uit je producten. Zorg dat producten foto's hebben.

#### Over Ons pagina
- **Featured Image** = Grote foto naast "Hoe het begon"
- Team foto's: voeg toe via de content editor

#### Academy pagina
- Video thumbnails: voeg toe via content editor
- Of gebruik YouTube embed (kopieer YouTube link, plak in editor)

#### Blog posts
- **Featured Image** = Header foto bovenaan het artikel
- Extra foto's: voeg toe in de content

#### Product pagina's
- **Productafbeelding** = Hoofdfoto
- **Productgalerij** = Extra foto's

### 4.5 Foto's uploaden - beste praktijken

**Formaten:**
| Type | Aanbevolen formaat | Max grootte |
|------|-------------------|-------------|
| Product foto | 800x800 px (vierkant) | 300KB |
| Blog header | 1200x600 px | 400KB |
| Over Ons foto | 800x600 px | 300KB |
| Team foto | 400x400 px (vierkant) | 150KB |

**Tips:**
- Gebruik [TinyPNG](https://tinypng.com) om foto's te comprimeren
- Geef foto's duidelijke namen: `rose-hotwax-product.jpg`
- Voeg ALT tekst toe voor SEO

---

## 5. Producten aanmaken

### Nieuw product toevoegen:

1. Ga naar **Producten** → **Nieuwe toevoegen**
2. Vul in:
   - **Titel**: productnaam
   - **Beschrijving**: lange tekst (verschijnt in tabs)
   - **Korte beschrijving**: korte tekst naast de prijs
3. **Productgegevens**:
   - Prijs
   - Aanbiedingsprijs (optioneel)
   - Voorraadstatus
4. **Productafbeelding**: upload hoofdfoto
5. **Productgalerij**: upload extra foto's
6. **Productcategorieën**: vink aan (Hotwax, Stripwax, etc.)
7. Klik **"Publiceren"**

### Productcategorieën aanmaken:

1. Ga naar **Producten** → **Categorieën**
2. Voeg toe:
   - Startersets
   - Hotwax
   - Stripwax
   - Harspatronen
   - Accessoires

---

## 6. Blog posts schrijven

### Nieuw artikel schrijven:

1. Ga naar **Berichten** → **Nieuwe toevoegen**
2. Vul de **titel** in
3. Schrijf je artikel in de editor
4. Voeg een **Featured Image** toe (dit wordt de header)
5. Kies een **Categorie** (maak nieuwe aan indien nodig)
6. Klik **"Publiceren"**

### Blog categorieën aanmaken:

1. Ga naar **Berichten** → **Categorieën**
2. Voeg toe:
   - Tips & Tricks
   - Handleidingen
   - Nieuws
   - Reviews

---

## 7. Veelvoorkomende problemen

### "Pagina niet gevonden" na aanmaken
1. Ga naar **Instellingen** → **Permalinks**
2. Klik **"Wijzigingen opslaan"** (zonder iets te veranderen)
3. Dit ververst de URL structuur

### Foto's worden niet getoond
- Check of de foto is geüpload in de Mediabibliotheek
- Check of Featured Image is ingesteld
- Probeer een andere browser / cache legen

### Menu verschijnt niet
- Check of je "Primary Menu" hebt aangevinkt bij de menu locatie
- Check of het menu items bevat

### Template optie verschijnt niet
- Zorg dat je een **Pagina** bewerkt, geen **Bericht**
- Ververs de pagina (F5)

---

## 8. Checklist voor lancering

### Minimaal nodig:
- [ ] Theme geïnstalleerd en geactiveerd
- [ ] Homepage zichtbaar
- [ ] Shop pagina werkt
- [ ] Minimaal 3 producten met foto's
- [ ] Over Ons pagina aangemaakt
- [ ] Contact pagina aangemaakt
- [ ] Menu ingesteld met belangrijkste links
- [ ] Logo geüpload (Weergave → Customizer → Site-identiteit)

### Nice to have:
- [ ] Academy pagina
- [ ] Waxen gids pagina
- [ ] Hars kopen pagina
- [ ] Groothandel pagina
- [ ] 2-3 blog artikelen
- [ ] Alle producten met foto's en beschrijvingen

---

## 9. Hulp nodig?

- **WordPress handleidingen**: https://wordpress.org/support/
- **WooCommerce docs**: https://woocommerce.com/documentation/

---

*Handleiding voor Waxing Shop Theme v5.0*
