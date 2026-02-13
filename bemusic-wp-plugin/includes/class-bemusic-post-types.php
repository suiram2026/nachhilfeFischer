<?php
/**
 * Register custom post types
 */
class BeMusic_Post_Types {

    /**
     * Register all post types
     */
    public function register_post_types() {
        $this->register_track_post_type();
        $this->register_album_post_type();
        $this->register_artist_post_type();
        $this->register_playlist_post_type();
    }

    /**
     * Register Track post type
     */
    private function register_track_post_type() {
        $labels = array(
            'name'                  => _x('Tracks', 'Post type general name', 'bemusic'),
            'singular_name'         => _x('Track', 'Post type singular name', 'bemusic'),
            'menu_name'             => _x('Tracks', 'Admin Menu text', 'bemusic'),
            'name_admin_bar'        => _x('Track', 'Add New on Toolbar', 'bemusic'),
            'add_new'               => __('Add New', 'bemusic'),
            'add_new_item'          => __('Add New Track', 'bemusic'),
            'new_item'              => __('New Track', 'bemusic'),
            'edit_item'             => __('Edit Track', 'bemusic'),
            'view_item'             => __('View Track', 'bemusic'),
            'all_items'             => __('All Tracks', 'bemusic'),
            'search_items'          => __('Search Tracks', 'bemusic'),
            'parent_item_colon'     => __('Parent Tracks:', 'bemusic'),
            'not_found'             => __('No tracks found.', 'bemusic'),
            'not_found_in_trash'    => __('No tracks found in Trash.', 'bemusic'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'bemusic',
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'track'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-format-audio',
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        );

        register_post_type('bemusic_track', $args);
    }

    /**
     * Register Album post type
     */
    private function register_album_post_type() {
        $labels = array(
            'name'                  => _x('Albums', 'Post type general name', 'bemusic'),
            'singular_name'         => _x('Album', 'Post type singular name', 'bemusic'),
            'menu_name'             => _x('Albums', 'Admin Menu text', 'bemusic'),
            'name_admin_bar'        => _x('Album', 'Add New on Toolbar', 'bemusic'),
            'add_new'               => __('Add New', 'bemusic'),
            'add_new_item'          => __('Add New Album', 'bemusic'),
            'new_item'              => __('New Album', 'bemusic'),
            'edit_item'             => __('Edit Album', 'bemusic'),
            'view_item'             => __('View Album', 'bemusic'),
            'all_items'             => __('All Albums', 'bemusic'),
            'search_items'          => __('Search Albums', 'bemusic'),
            'parent_item_colon'     => __('Parent Albums:', 'bemusic'),
            'not_found'             => __('No albums found.', 'bemusic'),
            'not_found_in_trash'    => __('No albums found in Trash.', 'bemusic'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'bemusic',
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'album'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-album',
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        );

        register_post_type('bemusic_album', $args);
    }

    /**
     * Register Artist post type
     */
    private function register_artist_post_type() {
        $labels = array(
            'name'                  => _x('Artists', 'Post type general name', 'bemusic'),
            'singular_name'         => _x('Artist', 'Post type singular name', 'bemusic'),
            'menu_name'             => _x('Artists', 'Admin Menu text', 'bemusic'),
            'name_admin_bar'        => _x('Artist', 'Add New on Toolbar', 'bemusic'),
            'add_new'               => __('Add New', 'bemusic'),
            'add_new_item'          => __('Add New Artist', 'bemusic'),
            'new_item'              => __('New Artist', 'bemusic'),
            'edit_item'             => __('Edit Artist', 'bemusic'),
            'view_item'             => __('View Artist', 'bemusic'),
            'all_items'             => __('All Artists', 'bemusic'),
            'search_items'          => __('Search Artists', 'bemusic'),
            'parent_item_colon'     => __('Parent Artists:', 'bemusic'),
            'not_found'             => __('No artists found.', 'bemusic'),
            'not_found_in_trash'    => __('No artists found in Trash.', 'bemusic'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'bemusic',
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'artist'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-microphone',
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        );

        register_post_type('bemusic_artist', $args);
    }

    /**
     * Register Playlist post type
     */
    private function register_playlist_post_type() {
        $labels = array(
            'name'                  => _x('Playlists', 'Post type general name', 'bemusic'),
            'singular_name'         => _x('Playlist', 'Post type singular name', 'bemusic'),
            'menu_name'             => _x('Playlists', 'Admin Menu text', 'bemusic'),
            'name_admin_bar'        => _x('Playlist', 'Add New on Toolbar', 'bemusic'),
            'add_new'               => __('Add New', 'bemusic'),
            'add_new_item'          => __('Add New Playlist', 'bemusic'),
            'new_item'              => __('New Playlist', 'bemusic'),
            'edit_item'             => __('Edit Playlist', 'bemusic'),
            'view_item'             => __('View Playlist', 'bemusic'),
            'all_items'             => __('All Playlists', 'bemusic'),
            'search_items'          => __('Search Playlists', 'bemusic'),
            'parent_item_colon'     => __('Parent Playlists:', 'bemusic'),
            'not_found'             => __('No playlists found.', 'bemusic'),
            'not_found_in_trash'    => __('No playlists found in Trash.', 'bemusic'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'bemusic',
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'playlist'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-playlist-audio',
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        );

        register_post_type('bemusic_playlist', $args);
    }
}
