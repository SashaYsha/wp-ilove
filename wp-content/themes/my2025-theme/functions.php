<?php
function my2025_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => 'Главное меню',
    ));
}
add_action('after_setup_theme', 'my2025_setup');

function my2025_scripts() {
    wp_enqueue_style('my2025-style', get_stylesheet_uri(), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'my2025_scripts');