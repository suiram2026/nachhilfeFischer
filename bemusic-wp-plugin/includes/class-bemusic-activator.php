<?php
/**
 * Fired during plugin activation
 */
class BeMusic_Activator {

    /**
     * Activation tasks
     */
    public static function activate() {
        // Flush rewrite rules to register custom post types
        flush_rewrite_rules();

        // Create default options
        if (!get_option('bemusic_api_url')) {
            add_option('bemusic_api_url', BEMUSIC_API_BASE_URL);
        }

        if (!get_option('bemusic_api_token')) {
            add_option('bemusic_api_token', '');
        }

        if (!get_option('bemusic_sync_enabled')) {
            add_option('bemusic_sync_enabled', false);
        }

        if (!get_option('bemusic_cache_duration')) {
            add_option('bemusic_cache_duration', 3600); // 1 hour default
        }
    }
}
