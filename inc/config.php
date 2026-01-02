<?php
/**
 * Theme Configuration Constants
 *
 * Central location for all theme constants and configuration values.
 * Update version number here only - it will be used throughout the theme.
 *
 * @package Waxing_Shop
 * @since 5.8
 */

defined('ABSPATH') || exit;

// =============================================
// VERSION & PATHS
// =============================================

/**
 * Theme version - single source of truth
 * Must match Version in style.css header
 */
define('WAXING_VERSION', '5.8.0');
define('WAXING_THEME_VERSION', WAXING_VERSION); // Backward compatibility alias

/**
 * Theme paths
 */
define('WAXING_DIR', get_template_directory());
define('WAXING_URI', get_template_directory_uri());

// =============================================
// FEATURE FLAGS
// =============================================

/**
 * Enable/disable features for easy testing
 */
define('WAXING_ENABLE_QUIZ', true);
define('WAXING_ENABLE_WISHLIST', true);
define('WAXING_ENABLE_LIVE_SEARCH', true);
define('WAXING_ENABLE_NEWSLETTER_POPUP', true);

/**
 * Social proof settings
 * IMPORTANT: Fake social proof (simulated viewers, fake sale times) is disabled
 * by default as it can be misleading to customers and may violate consumer
 * protection regulations in some jurisdictions.
 */
define('WAXING_ENABLE_FAKE_SOCIAL_PROOF', false);  // Disabled by default - ethical concern

// =============================================
// RATE LIMITS
// =============================================

/**
 * AJAX rate limiting settings
 */
define('WAXING_SEARCH_RATE_LIMIT', 10);        // Max searches per minute
define('WAXING_NEWSLETTER_RATE_LIMIT', 3);    // Max subscriptions per hour
define('WAXING_WISHLIST_MAX_ITEMS', 50);      // Max wishlist items

// =============================================
// CACHE SETTINGS
// =============================================

/**
 * Transient cache durations (in seconds)
 */
define('WAXING_CACHE_BESTSELLERS', HOUR_IN_SECONDS);
define('WAXING_CACHE_SHORTCODES', 15 * MINUTE_IN_SECONDS);

// =============================================
// SHOP SETTINGS
// =============================================

/**
 * Default shop configuration
 */
define('WAXING_PRODUCTS_PER_PAGE', 12);
define('WAXING_FREE_SHIPPING_THRESHOLD', 50);  // Euro amount for free shipping

// =============================================
// IMAGE SIZES
// =============================================

/**
 * Custom image dimensions
 */
define('WAXING_IMAGE_CARD_SIZE', 600);
define('WAXING_IMAGE_LARGE_SIZE', 1200);
define('WAXING_IMAGE_BLOG_WIDTH', 600);
define('WAXING_IMAGE_BLOG_HEIGHT', 400);
