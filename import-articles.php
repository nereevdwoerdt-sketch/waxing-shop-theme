<?php
/**
 * Import 29 SEO Artikelen
 * Run via: php import-articles.php (met WordPress geladen)
 */

// Load WordPress
$wp_load = dirname(__FILE__) . '/../../../wp-load.php';
if (!file_exists($wp_load)) {
    die("wp-load.php niet gevonden\n");
}
require_once($wp_load);
require_once(__DIR__ . '/Parsedown.php');

$parsedown = new Parsedown();

$articles = array(
    // Huidproblemen (31)
    array('file' => 'artikel-1-folliculitis-ingegroeide-haren.md', 'slug' => 'folliculitis-ingegroeide-haren', 'cat' => 31),
    array('file' => 'artikel-7-keratosis-pilaris-kippenhuid.md', 'slug' => 'keratosis-pilaris-kippenhuid', 'cat' => 31),
    array('file' => 'artikel-11-hirsutisme-overmatige-haargroei.md', 'slug' => 'hirsutisme-overmatige-haargroei', 'cat' => 31),
    array('file' => 'artikel-13-scheerbultjes.md', 'slug' => 'scheerbultjes', 'cat' => 31),
    array('file' => 'artikel-14-strawberry-legs.md', 'slug' => 'strawberry-legs', 'cat' => 31),

    // Vergelijkingen (32)
    array('file' => 'artikel-4-epileren-vs-waxen.md', 'slug' => 'epileren-vs-waxen', 'cat' => 32),
    array('file' => 'artikel-5-ontharingscreme-nadelen.md', 'slug' => 'ontharingscreme-nadelen', 'cat' => 32),
    array('file' => 'artikel-8-ipl-vs-waxen.md', 'slug' => 'ipl-vs-waxen', 'cat' => 32),
    array('file' => 'artikel-15-waxen-vs-scheren.md', 'slug' => 'waxen-vs-scheren', 'cat' => 32),
    array('file' => 'artikel-20-hot-wax-vs-stripwax.md', 'slug' => 'hot-wax-vs-stripwax', 'cat' => 32),
    array('file' => 'artikel-24-sugaring-vs-waxen.md', 'slug' => 'sugaring-vs-waxen', 'cat' => 32),

    // Lichaamsdelen (33)
    array('file' => 'artikel-6-rug-waxen-mannen.md', 'slug' => 'rug-waxen-mannen', 'cat' => 33),
    array('file' => 'artikel-10-borst-waxen-mannen.md', 'slug' => 'borst-waxen-mannen', 'cat' => 33),
    array('file' => 'artikel-16-brazilian-wax-thuis.md', 'slug' => 'brazilian-wax-thuis', 'cat' => 33),
    array('file' => 'artikel-17-bikinilijn-waxen-thuis.md', 'slug' => 'bikinilijn-waxen-thuis', 'cat' => 33),
    array('file' => 'artikel-18-gezicht-waxen.md', 'slug' => 'gezicht-waxen', 'cat' => 33),
    array('file' => 'artikel-21-benen-waxen.md', 'slug' => 'benen-waxen', 'cat' => 33),
    array('file' => 'artikel-29-oksels-waxen.md', 'slug' => 'oksels-waxen', 'cat' => 33),

    // Doelgroepen (34)
    array('file' => 'artikel-9-waxen-tijdens-zwangerschap.md', 'slug' => 'waxen-tijdens-zwangerschap', 'cat' => 34),

    // Educatie (35)
    array('file' => 'artikel-2-zelf-waxen-beginners-gids.md', 'slug' => 'zelf-waxen-beginners-gids', 'cat' => 35),
    array('file' => 'artikel-12-nazorg-na-waxen.md', 'slug' => 'nazorg-na-waxen', 'cat' => 35),
    array('file' => 'artikel-19-wetenschap-van-waxen.md', 'slug' => 'wetenschap-van-waxen', 'cat' => 35),
    array('file' => 'artikel-22-waxen-faq.md', 'slug' => 'waxen-faq', 'cat' => 35),

    // Product Advies (36)
    array('file' => 'artikel-3-wax-kopen-7-factoren.md', 'slug' => 'wax-kopen-7-factoren', 'cat' => 36),
    array('file' => 'artikel-23-welke-wax-past-bij-mij.md', 'slug' => 'welke-wax-past-bij-mij', 'cat' => 36),
    array('file' => 'artikel-25-waxverwarmer-kiezen.md', 'slug' => 'waxverwarmer-kiezen', 'cat' => 36),
    array('file' => 'artikel-26-wax-starterset.md', 'slug' => 'wax-starterset', 'cat' => 36),
    array('file' => 'artikel-27-waxsoorten-vergeleken.md', 'slug' => 'waxsoorten-vergeleken', 'cat' => 36),
    array('file' => 'artikel-28-nacree-blanche-gids.md', 'slug' => 'nacree-blanche-gids', 'cat' => 36),
);

$imported = 0;
$skipped = 0;
$errors = 0;

echo "=== START IMPORT ===\n\n";

foreach ($articles as $article) {
    // Check of artikel al bestaat
    $existing = get_page_by_path($article['slug'], OBJECT, 'post');
    if ($existing) {
        echo "SKIP: {$article['slug']} bestaat al (ID: {$existing->ID})\n";
        $skipped++;
        continue;
    }

    // Lees markdown bestand
    $filepath = __DIR__ . '/artikelen/' . $article['file'];
    if (!file_exists($filepath)) {
        echo "ERROR: Bestand niet gevonden: {$article['file']}\n";
        $errors++;
        continue;
    }

    $markdown = file_get_contents($filepath);

    // Extract titel uit eerste # regel
    preg_match('/^# (.+)$/m', $markdown, $matches);
    $title = isset($matches[1]) ? trim($matches[1]) : ucfirst(str_replace('-', ' ', $article['slug']));

    // Verwijder titel uit content
    $markdown = preg_replace('/^# .+$/m', '', $markdown, 1);

    // Convert markdown naar HTML
    $content = $parsedown->text($markdown);

    // Extract meta description (eerste paragraaf)
    preg_match('/<p>(.+?)<\/p>/s', $content, $excerpt_match);
    $excerpt = isset($excerpt_match[1]) ? wp_strip_all_tags($excerpt_match[1]) : '';
    $excerpt = wp_trim_words($excerpt, 30);

    // Maak post
    $post_data = array(
        'post_title'    => $title,
        'post_name'     => $article['slug'],
        'post_content'  => $content,
        'post_excerpt'  => $excerpt,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_category' => array($article['cat']),
        'post_author'   => 1,
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id && !is_wp_error($post_id)) {
        echo "OK: {$title} (ID: {$post_id}, slug: {$article['slug']}, cat: {$article['cat']})\n";
        $imported++;
    } else {
        echo "ERROR: Kon niet importeren: {$article['slug']}\n";
        $errors++;
    }
}

echo "\n=== KLAAR ===\n";
echo "Geïmporteerd: {$imported}\n";
echo "Overgeslagen: {$skipped}\n";
echo "Errors: {$errors}\n";
