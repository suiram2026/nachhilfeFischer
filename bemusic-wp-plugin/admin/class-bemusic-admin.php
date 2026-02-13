<?php
/**
 * Admin functionality
 */
class BeMusic_Admin {

    /**
     * Plugin version
     */
    private $version;

    /**
     * Initialize
     */
    public function __construct($version) {
        $this->version = $version;
    }

    /**
     * Enqueue admin styles
     */
    public function enqueue_styles() {
        wp_enqueue_style(
            'bemusic-admin',
            BEMUSIC_PLUGIN_URL . 'assets/css/bemusic-admin.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Enqueue admin scripts
     */
    public function enqueue_scripts() {
        wp_enqueue_script(
            'bemusic-admin',
            BEMUSIC_PLUGIN_URL . 'assets/js/bemusic-admin.js',
            array('jquery'),
            $this->version,
            false
        );
    }
}
