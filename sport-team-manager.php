<?php
/*
Plugin Name: Sport Team Manager
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Plugin to manage and promote Sport team matches. Complete with statistics and player tracking.
Version: 0.1
Author: Frédéric "Fredy31" Pilon
Author URI: http://www.fredericpilon.com
License: GPL2
*/
?>

<?php
    add_action( 'init', 'fp_stm_create_matches_pt' );
    /**
     * Creates the "Games" post type. Used to register games played by the team.
     */
    function fp_stm_create_matches_pt() {
        $labels = array(
            'name' => _x('Games', 'post type general name'),
            'singular_name' => _x('Game', 'post type singular name'),
            'add_new' => _x('Add New', 'games'),
            'add_new_item' => __('Add New Game'),
            'edit_item' => __('Edit Game'),
            'new_item' => __('New Game'),
            'all_items' => __('All Games'),
            'view_item' => __('View Game'),
            'search_items' => __('Search Game'),
            'not_found' =>  __('No games found'),
            'not_found_in_trash' => __('No games found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => __('Games')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'show_in_menu' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true, 
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('stm_games',$args);
    }
    
     add_action( 'init', 'fp_stm_create_players_pt' );
    /**
     * Creates the "Players" post type. Used to register player of the current team.
     */
    function fp_stm_create_players_pt() {
        $labels = array(
            'name' => _x('Players', 'post type general name'),
            'singular_name' => _x('Players', 'post type singular name'),
            'add_new' => _x('Add New', 'players'),
            'add_new_item' => __('Add New Player'),
            'edit_item' => __('Edit Player'),
            'new_item' => __('New Player'),
            'all_items' => __('All Players'),
            'view_item' => __('View Player'),
            'search_items' => __('Search Players'),
            'not_found' =>  __('No players found'),
            'not_found_in_trash' => __('No players found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => __('Players')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true, 
            'show_in_menu' => true, 
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true, 
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type('stm_players',$args);
    }

?>