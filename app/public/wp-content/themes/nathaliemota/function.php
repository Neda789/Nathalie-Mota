<?php
function nathaliemota_setup() {
    // support pour title tag
    add_theme_support('title-tag');

    // support pour custom logo
    add_theme_support('custom-logo');

    // support pour post thumbnails
    add_theme_support('post-thumbnails');

    // Registration pour main menu
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'nathaliemota')
    ));
}
add_action('after_setup_theme', 'nathaliemota_setup');

// Enqueue styles
function nathaliemota_enqueue_styles() {
    wp_enqueue_style('nathaliemota-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_styles');

?>
