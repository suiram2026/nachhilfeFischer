<?php
/**
 * WordPress REST API endpoints (proxy to Laravel API)
 */
class BeMusic_Rest_API {

    /**
     * API namespace
     */
    private $namespace = 'bemusic/v1';

    /**
     * API client
     */
    private $api_client;

    /**
     * Initialize
     */
    public function __construct() {
        $this->api_client = new BeMusic_API_Client();
    }

    /**
     * Register REST API routes
     */
    public function register_routes() {
        // Landing page
        register_rest_route($this->namespace, '/landing', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_landing_page'),
            'permission_callback' => '__return_true',
        ));

        // Search
        register_rest_route($this->namespace, '/search', array(
            'methods'  => 'GET',
            'callback' => array($this, 'search'),
            'permission_callback' => '__return_true',
            'args' => array(
                'query' => array(
                    'required' => true,
                    'type' => 'string',
                ),
            ),
        ));

        // Tracks
        register_rest_route($this->namespace, '/tracks', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_tracks'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/tracks/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_track'),
            'permission_callback' => '__return_true',
        ));

        // Albums
        register_rest_route($this->namespace, '/albums', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_albums'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/albums/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_album'),
            'permission_callback' => '__return_true',
        ));

        // Artists
        register_rest_route($this->namespace, '/artists', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_artists'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/artists/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_artist'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/artists/(?P<id>\d+)/tracks', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_artist_tracks'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/artists/(?P<id>\d+)/albums', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_artist_albums'),
            'permission_callback' => '__return_true',
        ));

        // Playlists
        register_rest_route($this->namespace, '/playlists', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_playlists'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/playlists/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_playlist'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/playlists/(?P<id>\d+)/tracks', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_playlist_tracks'),
            'permission_callback' => '__return_true',
        ));

        // Genres
        register_rest_route($this->namespace, '/genres', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_genres'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/genres/(?P<name>[a-zA-Z0-9-_]+)/tracks', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_genre_tracks'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/genres/(?P<name>[a-zA-Z0-9-_]+)/albums', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_genre_albums'),
            'permission_callback' => '__return_true',
        ));

        // Radio
        register_rest_route($this->namespace, '/radio/(?P<type>[a-zA-Z0-9-_]+)/(?P<id>\d+)', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_radio'),
            'permission_callback' => '__return_true',
        ));

        // User
        register_rest_route($this->namespace, '/user/(?P<id>\d+)/profile', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_user_profile'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route($this->namespace, '/user/(?P<id>\d+)/playlists', array(
            'methods'  => 'GET',
            'callback' => array($this, 'get_user_playlists'),
            'permission_callback' => '__return_true',
        ));
    }

    /**
     * Get landing page
     */
    public function get_landing_page($request) {
        $result = $this->api_client->get_landing_page();
        return $this->format_response($result);
    }

    /**
     * Search
     */
    public function search($request) {
        $query = $request->get_param('query');
        $limit = $request->get_param('limit') ?: 10;
        $result = $this->api_client->search($query, $limit);
        return $this->format_response($result);
    }

    /**
     * Get tracks
     */
    public function get_tracks($request) {
        $params = $request->get_query_params();
        $result = $this->api_client->get_tracks($params);
        return $this->format_response($result);
    }

    /**
     * Get track
     */
    public function get_track($request) {
        $id = $request->get_param('id');
        $result = $this->api_client->get_track($id);
        return $this->format_response($result);
    }

    /**
     * Get albums
     */
    public function get_albums($request) {
        $params = $request->get_query_params();
        $result = $this->api_client->get_albums($params);
        return $this->format_response($result);
    }

    /**
     * Get album
     */
    public function get_album($request) {
        $id = $request->get_param('id');
        $result = $this->api_client->get_album($id);
        return $this->format_response($result);
    }

    /**
     * Get artists
     */
    public function get_artists($request) {
        $params = $request->get_query_params();
        $result = $this->api_client->get_artists($params);
        return $this->format_response($result);
    }

    /**
     * Get artist
     */
    public function get_artist($request) {
        $id = $request->get_param('id');
        $result = $this->api_client->get_artist($id);
        return $this->format_response($result);
    }

    /**
     * Get artist tracks
     */
    public function get_artist_tracks($request) {
        $id = $request->get_param('id');
        $params = $request->get_query_params();
        $result = $this->api_client->get_artist_tracks($id, $params);
        return $this->format_response($result);
    }

    /**
     * Get artist albums
     */
    public function get_artist_albums($request) {
        $id = $request->get_param('id');
        $params = $request->get_query_params();
        $result = $this->api_client->get_artist_albums($id, $params);
        return $this->format_response($result);
    }

    /**
     * Get playlists
     */
    public function get_playlists($request) {
        $params = $request->get_query_params();
        $result = $this->api_client->get_playlists($params);
        return $this->format_response($result);
    }

    /**
     * Get playlist
     */
    public function get_playlist($request) {
        $id = $request->get_param('id');
        $result = $this->api_client->get_playlist($id);
        return $this->format_response($result);
    }

    /**
     * Get playlist tracks
     */
    public function get_playlist_tracks($request) {
        $id = $request->get_param('id');
        $params = $request->get_query_params();
        $result = $this->api_client->get_playlist_tracks($id, $params);
        return $this->format_response($result);
    }

    /**
     * Get genres
     */
    public function get_genres($request) {
        $params = $request->get_query_params();
        $result = $this->api_client->get_genres($params);
        return $this->format_response($result);
    }

    /**
     * Get genre tracks
     */
    public function get_genre_tracks($request) {
        $name = $request->get_param('name');
        $params = $request->get_query_params();
        $result = $this->api_client->get_genre_tracks($name, $params);
        return $this->format_response($result);
    }

    /**
     * Get genre albums
     */
    public function get_genre_albums($request) {
        $name = $request->get_param('name');
        $params = $request->get_query_params();
        $result = $this->api_client->get_genre_albums($name, $params);
        return $this->format_response($result);
    }

    /**
     * Get radio
     */
    public function get_radio($request) {
        $type = $request->get_param('type');
        $id = $request->get_param('id');
        $params = $request->get_query_params();
        $result = $this->api_client->get_radio($type, $id, $params);
        return $this->format_response($result);
    }

    /**
     * Get user profile
     */
    public function get_user_profile($request) {
        $id = $request->get_param('id');
        $result = $this->api_client->get_user_profile($id);
        return $this->format_response($result);
    }

    /**
     * Get user playlists
     */
    public function get_user_playlists($request) {
        $id = $request->get_param('id');
        $params = $request->get_query_params();
        $result = $this->api_client->get_user_playlists($id, $params);
        return $this->format_response($result);
    }

    /**
     * Format API response
     */
    private function format_response($result) {
        if (isset($result['success']) && $result['success'] === false) {
            return new WP_Error(
                'api_error',
                isset($result['error']) ? $result['error'] : 'Unknown API error',
                array('status' => isset($result['status']) ? $result['status'] : 500)
            );
        }

        return rest_ensure_response($result['data']);
    }
}
