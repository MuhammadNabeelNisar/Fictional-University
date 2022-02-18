<?php 

function university_files() {

    //css files
    wp_enqueue_style( 'main_style', get_theme_file_uri( '/build/style-index.css' ) );
    wp_enqueue_style( 'extra_style', get_theme_file_uri( '/build/index.css' ) );
    wp_enqueue_style( 'font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'google_font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' );

    //css files
    wp_enqueue_script( 'main_js', get_theme_file_uri( '/build/index.js' ), array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'university_files' );



function university_features() {

    add_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'university_features' );



function university_adjust_queries( $query ) {

    if ( !is_admin() AND is_post_type_archive( 'event' ) AND is_main_query() ) {
        $query->set( 'meta_key', 'event_date' );
        $query->set( 'orderby', 'meta_value_num' );
        $query->set( 'order', 'ASC' );
        $query->set( 'meta_query', array(
                array(
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => date( 'Ymd' ),
                  'type' => 'numeric'
                )
            ) 
        );
    }

    if ( !is_admin() AND is_post_type_archive( 'program' ) AND is_main_query() ) {
        $query->set( 'post_per_page', -1 );
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
    }

}
add_action( 'pre_get_posts', 'university_adjust_queries' );





function university_post_types() {

    // custom post type event
    register_post_type( 'event', array(
        'public' => true,
        'supports' => array(
            'title', 'editor', 'excerpt'
        ),
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'events'
        ),
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar'
    ) );

    // custom post type program
    register_post_type( 'program', array(
        'public' => true,
        'supports' => array(
            'title', 'editor'
        ),
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'programs'
        ),
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards'
    ) );

    // custom post type Professors
    register_post_type( 'professor', array(
        'public' => true,
        'supports' => array(
            'title', 'editor'
        ),
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more'
    ) );

}
add_action( 'init', 'university_post_types' );

