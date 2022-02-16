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



function university_post_types() {

    register_post_type( 'event', array(
        'public' => true,
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

}
add_action( 'init', 'university_post_types' );

