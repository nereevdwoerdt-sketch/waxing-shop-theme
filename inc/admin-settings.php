<?php
/**
 * Admin Settings Page
 *
 * @package Waxing_Shop
 * @since 5.8
 */

defined('ABSPATH') || exit;

/**
 * Add admin menu
 */
function waxing_admin_menu() {
    add_menu_page(
        'Waxing Shop',
        'Waxing Shop',
        'manage_options',
        'waxing-shop',
        'waxing_settings_page',
        'dashicons-store',
        58
    );

    add_submenu_page(
        'waxing-shop',
        'Product IDs',
        'Product IDs',
        'manage_options',
        'waxing-shop',
        'waxing_settings_page'
    );
}
add_action('admin_menu', 'waxing_admin_menu');

/**
 * Register settings
 */
function waxing_register_settings() {
    // Starter Sets
    register_setting('waxing_settings', 'waxing_starter_set_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_complete_set_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_pro_set_id', array('sanitize_callback' => 'absint'));

    // Wax 400g
    register_setting('waxing_settings', 'waxing_gold_400_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_rose_400_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_nacree_400_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_intimicire_400_id', array('sanitize_callback' => 'absint'));

    // Wax 1kg
    register_setting('waxing_settings', 'waxing_gold_1kg_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_rose_1kg_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_nacree_1kg_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_intimicire_1kg_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_sunset_1kg_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_rodo_1kg_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_vegan_1kg_id', array('sanitize_callback' => 'absint'));

    // Accessoires
    register_setting('waxing_settings', 'waxing_warmer_single_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_warmer_double_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_spatels_50_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_spatels_100_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_pre_lotion_id', array('sanitize_callback' => 'absint'));
    register_setting('waxing_settings', 'waxing_after_lotion_id', array('sanitize_callback' => 'absint'));
}
add_action('admin_init', 'waxing_register_settings');

/**
 * Settings page HTML
 */
function waxing_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check for settings saved message
    if (isset($_GET['settings-updated'])) {
        add_settings_error('waxing_messages', 'waxing_message', 'Instellingen opgeslagen.', 'updated');
    }
    ?>
    <div class="wrap waxing-admin">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <?php settings_errors('waxing_messages'); ?>

        <form action="options.php" method="post">
            <?php settings_fields('waxing_settings'); ?>

            <style>
                .waxing-admin { max-width: 800px; }
                .waxing-section { background: #fff; border: 1px solid #ccd0d4; border-radius: 4px; margin: 20px 0; padding: 0; }
                .waxing-section-header { background: #f0f0f1; padding: 12px 20px; border-bottom: 1px solid #ccd0d4; cursor: pointer; display: flex; justify-content: space-between; align-items: center; }
                .waxing-section-header h2 { margin: 0; font-size: 14px; font-weight: 600; }
                .waxing-section-header .toggle { color: #666; }
                .waxing-section-body { padding: 20px; }
                .waxing-field { display: flex; align-items: center; margin-bottom: 16px; gap: 12px; }
                .waxing-field:last-child { margin-bottom: 0; }
                .waxing-field label { flex: 0 0 180px; font-weight: 500; }
                .waxing-field input { width: 120px; padding: 6px 10px; }
                .waxing-field .description { color: #666; font-size: 12px; }
                .waxing-field .product-preview { font-size: 12px; color: #0073aa; margin-left: 8px; }
                .waxing-field .product-preview.error { color: #dc3232; }
                .submit { margin-top: 20px; }
            </style>

            <!-- Starter Sets -->
            <div class="waxing-section">
                <div class="waxing-section-header">
                    <h2>Starter Sets</h2>
                    <span class="toggle">&#9660;</span>
                </div>
                <div class="waxing-section-body">
                    <?php waxing_render_field('waxing_starter_set_id', 'Starter Set'); ?>
                    <?php waxing_render_field('waxing_complete_set_id', 'Complete Set'); ?>
                    <?php waxing_render_field('waxing_pro_set_id', 'Pro Set'); ?>
                </div>
            </div>

            <!-- Hot Wax 400g -->
            <div class="waxing-section">
                <div class="waxing-section-header">
                    <h2>Hot Wax 400g</h2>
                    <span class="toggle">&#9660;</span>
                </div>
                <div class="waxing-section-body">
                    <?php waxing_render_field('waxing_gold_400_id', 'Gold 400g'); ?>
                    <?php waxing_render_field('waxing_rose_400_id', 'Rose 400g'); ?>
                    <?php waxing_render_field('waxing_nacree_400_id', 'Nacree 400g'); ?>
                    <?php waxing_render_field('waxing_intimicire_400_id', 'Intimicire 400g'); ?>
                </div>
            </div>

            <!-- Hot Wax 1kg -->
            <div class="waxing-section">
                <div class="waxing-section-header">
                    <h2>Hot Wax 1kg</h2>
                    <span class="toggle">&#9660;</span>
                </div>
                <div class="waxing-section-body">
                    <?php waxing_render_field('waxing_gold_1kg_id', 'Gold 1kg'); ?>
                    <?php waxing_render_field('waxing_rose_1kg_id', 'Rose 1kg'); ?>
                    <?php waxing_render_field('waxing_nacree_1kg_id', 'Nacree 1kg'); ?>
                    <?php waxing_render_field('waxing_intimicire_1kg_id', 'Intimicire 1kg'); ?>
                    <?php waxing_render_field('waxing_sunset_1kg_id', 'Sunset 1kg'); ?>
                    <?php waxing_render_field('waxing_rodo_1kg_id', 'Rodo 1kg'); ?>
                    <?php waxing_render_field('waxing_vegan_1kg_id', 'Vegan 1kg'); ?>
                </div>
            </div>

            <!-- Accessoires -->
            <div class="waxing-section">
                <div class="waxing-section-header">
                    <h2>Accessoires</h2>
                    <span class="toggle">&#9660;</span>
                </div>
                <div class="waxing-section-body">
                    <?php waxing_render_field('waxing_warmer_single_id', 'Harsverwarmer (enkel)'); ?>
                    <?php waxing_render_field('waxing_warmer_double_id', 'Harsverwarmer (dubbel)'); ?>
                    <?php waxing_render_field('waxing_spatels_50_id', 'Spatels 50st'); ?>
                    <?php waxing_render_field('waxing_spatels_100_id', 'Spatels 100st'); ?>
                    <?php waxing_render_field('waxing_pre_lotion_id', 'Pre-wax Lotion'); ?>
                    <?php waxing_render_field('waxing_after_lotion_id', 'After-wax Lotion'); ?>
                </div>
            </div>

            <?php submit_button('Instellingen Opslaan'); ?>
        </form>

        <script>
        jQuery(document).ready(function($) {
            $('.waxing-section-header').on('click', function() {
                $(this).next('.waxing-section-body').slideToggle(200);
                $(this).find('.toggle').text(function(i, text) {
                    return text === '▼' ? '▲' : '▼';
                });
            });
        });
        </script>
    </div>
    <?php
}

/**
 * Render a settings field with product preview
 */
function waxing_render_field($option_name, $label) {
    $value = get_option($option_name, '');
    $product = $value ? wc_get_product($value) : null;
    ?>
    <div class="waxing-field">
        <label for="<?php echo esc_attr($option_name); ?>"><?php echo esc_html($label); ?></label>
        <input
            type="number"
            id="<?php echo esc_attr($option_name); ?>"
            name="<?php echo esc_attr($option_name); ?>"
            value="<?php echo esc_attr($value); ?>"
            placeholder="Product ID"
            min="0"
        >
        <?php if ($value) : ?>
            <?php if ($product) : ?>
                <span class="product-preview">
                    &#10003; <?php echo esc_html($product->get_name()); ?>
                    (<?php echo wc_price($product->get_price()); ?>)
                </span>
            <?php else : ?>
                <span class="product-preview error">&#10007; Product niet gevonden</span>
            <?php endif; ?>
        <?php else : ?>
            <span class="description">WooCommerce product ID</span>
        <?php endif; ?>
    </div>
    <?php
}
