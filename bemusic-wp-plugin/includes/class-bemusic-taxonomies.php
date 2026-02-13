<?php
/**
 * Register custom taxonomies
 */
class BeMusic_Taxonomies {

    /**
     * Register all taxonomies
     */
    public function register_taxonomies() {
        $this->register_genre_taxonomy();
    }

    /**
     * Register Genre taxonomy
     */
    private function register_genre_taxonomy() {
        $labels = array(
            'name'                       => _x('Genres', 'Taxonomy general name', 'bemusic'),
            'singular_name'              => _x('Genre', 'Taxonomy singular name', 'bemusic'),
            'search_items'               => __('Search Genres', 'bemusic'),
            'popular_items'              => __('Popular Genres', 'bemusic'),
            'all_items'                  => __('All Genres', 'bemusic'),
            'parent_item'                => __('Parent Genre', 'bemusic'),
            'parent_item_colon'          => __('Parent Genre:', 'bemusic'),
            'edit_item'                  => __('Edit Genre', 'bemusic'),
            'update_item'                => __('Update Genre', 'bemusic'),
            'add_new_item'               => __('Add New Genre', 'bemusic'),
            'new_item_name'              => __('New Genre Name', 'bemusic'),
            'separate_items_with_commas' => __('Separate genres with commas', 'bemusic'),
            'add_or_remove_items'        => __('Add or remove genres', 'bemusic'),
            'choose_from_most_used'      => __('Choose from the most used genres', 'bemusic'),
            'not_found'                  => __('No genres found.', 'bemusic'),
            'menu_name'                  => __('Genres', 'bemusic'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'show_in_menu'          => 'bemusic',
            'show_in_rest'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'genre'),
            'update_count_callback' => '_update_post_term_count',
        );

        // Register for all music-related post types
        register_taxonomy(
            'bemusic_genre',
            array('bemusic_track', 'bemusic_album', 'bemusic_artist'),
            $args
        );
    }
}
