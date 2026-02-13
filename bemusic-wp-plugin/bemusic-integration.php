<?php
/**
 * Plugin Name: BeMusic Integration
 * Plugin URI: https://elsfm.com
 * Description: WordPress integration for BeMusic Laravel API (elsfm.com/api/v1). Provides custom post types, API proxy, and shortcodes for music streaming functionality.
 * Version: 1.0.0
 * Author: BeMusic
 * Author URI: https://elsfm.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bemusic
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Plugin version
define('BEMUSIC_VERSION', '1.0.0');
define('BEMUSIC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BEMUSIC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BEMUSIC_API_BASE_URL', 'https://elsfm.com/api/v1');

/**
 * Plugin activation hook
 */
function activate_bemusic_integration() {
    require_once BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic-activator.php';
    BeMusic_Activator::activate();
}

/**
 * Plugin deactivation hook
 */
function deactivate_bemusic_integration() {
    require_once BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic-deactivator.php';
    BeMusic_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_bemusic_integration');
register_deactivation_hook(__FILE__, 'deactivate_bemusic_integration');

/**
 * Core plugin class
 */
require BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic.php';

/**
 * Initialize the plugin
 */
function run_bemusic_integration() {
    $plugin = new BeMusic();
    $plugin->run();
}
run_bemusic_integration();
