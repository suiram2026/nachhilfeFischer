<?php
/**
 * API Client for BeMusic Laravel API
 */
class BeMusic_API_Client {

    /**
     * API base URL
     */
    private $api_url;

    /**
     * API token
     */
    private $api_token;

    /**
     * Cache duration
     */
    private $cache_duration;

    /**
     * Initialize API client
     */
    public function __construct() {
        $this->api_url = get_option('bemusic_api_url', BEMUSIC_API_BASE_URL);
        $this->api_token = get_option('bemusic_api_token', '');
        $this->cache_duration = get_option('bemusic_cache_duration', 3600);
    }

    /**
     * Make API request
     */
    private function request($endpoint, $method = 'GET', $body = null, $use_cache = true) {
        $cache_key = 'bemusic_' . md5($endpoint . $method . serialize($body));

        // Try to get from cache
        if ($use_cache && $method === 'GET') {
            $cached = get_transient($cache_key);
            if ($cached !== false) {
                return $cached;
            }
        }

        $url = trailingslashit($this->api_url) . ltrim($endpoint, '/');

        $args = array(
            'method'  => $method,
            'timeout' => 15,
            'headers' => array(
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ),
        );

        // Add authorization if token exists
        if (!empty($this->api_token)) {
            $args['headers']['Authorization'] = 'Bearer ' . $this->api_token;
        }

        // Add body for POST/PUT requests
        if ($body !== null && in_array($method, array('POST', 'PUT', 'PATCH'))) {
            $args['body'] = json_encode($body);
        }

        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'error'   => $response->get_error_message(),
            );
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($status_code >= 200 && $status_code < 300) {
            // Cache successful GET requests
            if ($use_cache && $method === 'GET') {
                set_transient($cache_key, $data, $this->cache_duration);
            }

            return array(
                'success' => true,
                'data'    => $data,
            );
        }

        return array(
            'success' => false,
            'error'   => isset($data['message']) ? $data['message'] : 'API request failed',
            'status'  => $status_code,
        );
    }

    /**
     * Get landing page data
     */
    public function get_landing_page() {
        return $this->request('landing-page-data');
    }

    /**
     * Search
     */
    public function search($query, $limit = 10) {
        return $this->request('search?query=' . urlencode($query) . '&limit=' . $limit);
    }

    /**
     * Get tracks
     */
    public function get_tracks($params = array()) {
        $query = http_build_query($params);
        return $this->request('tracks' . ($query ? '?' . $query : ''));
    }

    /**
     * Get track by ID
     */
    public function get_track($id) {
        return $this->request('tracks/' . $id);
    }

    /**
     * Get albums
     */
    public function get_albums($params = array()) {
        $query = http_build_query($params);
        return $this->request('albums' . ($query ? '?' . $query : ''));
    }

    /**
     * Get album by ID
     */
    public function get_album($id) {
        return $this->request('albums/' . $id);
    }

    /**
     * Get artists
     */
    public function get_artists($params = array()) {
        $query = http_build_query($params);
        return $this->request('artists' . ($query ? '?' . $query : ''));
    }

    /**
     * Get artist by ID
     */
    public function get_artist($id) {
        return $this->request('artists/' . $id);
    }

    /**
     * Get artist tracks
     */
    public function get_artist_tracks($id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('artists/' . $id . '/tracks' . ($query ? '?' . $query : ''));
    }

    /**
     * Get artist albums
     */
    public function get_artist_albums($id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('artists/' . $id . '/albums' . ($query ? '?' . $query : ''));
    }

    /**
     * Get playlists
     */
    public function get_playlists($params = array()) {
        $query = http_build_query($params);
        return $this->request('playlists' . ($query ? '?' . $query : ''));
    }

    /**
     * Get playlist by ID
     */
    public function get_playlist($id) {
        return $this->request('playlists/' . $id);
    }

    /**
     * Get playlist tracks
     */
    public function get_playlist_tracks($id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('playlists/' . $id . '/tracks' . ($query ? '?' . $query : ''));
    }

    /**
     * Get genres
     */
    public function get_genres($params = array()) {
        $query = http_build_query($params);
        return $this->request('genres' . ($query ? '?' . $query : ''));
    }

    /**
     * Get genre tracks
     */
    public function get_genre_tracks($genre_name, $params = array()) {
        $query = http_build_query($params);
        return $this->request('tags/' . urlencode($genre_name) . '/tracks' . ($query ? '?' . $query : ''));
    }

    /**
     * Get genre albums
     */
    public function get_genre_albums($genre_name, $params = array()) {
        $query = http_build_query($params);
        return $this->request('tags/' . urlencode($genre_name) . '/albums' . ($query ? '?' . $query : ''));
    }

    /**
     * Get channels
     */
    public function get_channels($params = array()) {
        $query = http_build_query($params);
        return $this->request('channel' . ($query ? '?' . $query : ''));
    }

    /**
     * Get channel by ID
     */
    public function get_channel($id) {
        return $this->request('channel/' . $id);
    }

    /**
     * Get user profile
     */
    public function get_user_profile($user_id) {
        return $this->request('user-profile/' . $user_id);
    }

    /**
     * Get user playlists
     */
    public function get_user_playlists($user_id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('users/' . $user_id . '/playlists' . ($query ? '?' . $query : ''));
    }

    /**
     * Get user liked tracks
     */
    public function get_user_liked_tracks($user_id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('users/' . $user_id . '/liked-tracks' . ($query ? '?' . $query : ''));
    }

    /**
     * Get user liked albums
     */
    public function get_user_liked_albums($user_id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('users/' . $user_id . '/liked-albums' . ($query ? '?' . $query : ''));
    }

    /**
     * Get user liked artists
     */
    public function get_user_liked_artists($user_id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('users/' . $user_id . '/liked-artists' . ($query ? '?' . $query : ''));
    }

    /**
     * Get radio recommendations
     */
    public function get_radio($type, $id, $params = array()) {
        $query = http_build_query($params);
        return $this->request('radio/' . $type . '/' . $id . ($query ? '?' . $query : ''));
    }

    /**
     * Clear cache
     */
    public function clear_cache() {
        global $wpdb;
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_bemusic_%'");
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_bemusic_%'");
    }
}
