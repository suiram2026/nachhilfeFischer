<?php
/**
 * Core plugin class
 */
class BeMusic {

    /**
     * The loader that's responsible for maintaining and registering all hooks
     */
    protected $loader;

    /**
     * Plugin version
     */
    protected $version;

    /**
     * Initialize plugin
     */
    public function __construct() {
        $this->version = BEMUSIC_VERSION;
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load required dependencies
     */
    private function load_dependencies() {
        // Core dependencies
        require_once BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic-loader.php';
        require_once BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic-api-client.php';
        require_once BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic-post-types.php';
        require_once BEMUSIC_PLUGIN_DIR . 'includes/class-bemusic-taxonomies.php';

        // Admin dependencies
        require_once BEMUSIC_PLUGIN_DIR . 'admin/class-bemusic-admin.php';
        require_once BEMUSIC_PLUGIN_DIR . 'admin/class-bemusic-settings.php';

        // Public dependencies
        require_once BEMUSIC_PLUGIN_DIR . 'public/class-bemusic-public.php';
        require_once BEMUSIC_PLUGIN_DIR . 'public/class-bemusic-shortcodes.php';
        require_once BEMUSIC_PLUGIN_DIR . 'public/class-bemusic-rest-api.php';

        $this->loader = new BeMusic_Loader();
    }

    /**
     * Register admin hooks
     */
    private function define_admin_hooks() {
        $admin = new BeMusic_Admin($this->version);
        $settings = new BeMusic_Settings();
        $post_types = new BeMusic_Post_Types();
        $taxonomies = new BeMusic_Taxonomies();

        // Admin hooks
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $settings, 'add_menu_page');
        $this->loader->add_action('admin_init', $settings, 'register_settings');

        // Post types and taxonomies
        $this->loader->add_action('init', $post_types, 'register_post_types');
        $this->loader->add_action('init', $taxonomies, 'register_taxonomies');
    }

    /**
     * Register public hooks
     */
    private function define_public_hooks() {
        $public = new BeMusic_Public($this->version);
        $shortcodes = new BeMusic_Shortcodes();
        $rest_api = new BeMusic_Rest_API();

        // Public hooks
        $this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_scripts');

        // Shortcodes
        $this->loader->add_action('init', $shortcodes, 'register_shortcodes');

        // REST API
        $this->loader->add_action('rest_api_init', $rest_api, 'register_routes');
    }

    /**
     * Run the loader to execute all hooks
     */
    public function run() {
        $this->loader->run();
    }
}
