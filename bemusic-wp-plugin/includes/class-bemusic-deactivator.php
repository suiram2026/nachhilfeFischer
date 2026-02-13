<?php
/**
 * Fired during plugin deactivation
 */
class BeMusic_Deactivator {

    /**
     * Deactivation tasks
     */
    public static function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();

        // Clear any cached data
        wp_cache_flush();
    }
}
