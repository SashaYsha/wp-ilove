<?php
/**
 * Plugin Name: Site Sections CPT
 * Description: Отдельные сущности для Topbar, Header, Footer, Bottombar
 */

if (!defined('ABSPATH')) exit;

add_action('init', function() {
    $sections = [
        'topbar'    => 'Topbar',
        'header'    => 'Шапка сайта',
        'footer'    => 'Футер',
        'bottombar' => 'Bottombar',
    ];

    foreach ($sections as $slug => $name) {
        register_post_type($slug, [
            'label'              => $name,
            'public'             => true,   // ✅ нужно для превью Elementor
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => false,
            'menu_icon'          => 'dashicons-layout',
            'supports'           => ['title', 'editor', 'elementor'],
            'capability_type'    => 'post',
            'rewrite'            => false,  // 🔒 нет красивых URL
            'has_archive'        => false,  // 🔒 нет архивов
            'exclude_from_search'=> true,   // 🔒 не ищется и не индексируется
        ]);
    }
});

// 🔒 Защита: посторонние не могут открыть секцию по прямой ссылке
add_action('template_redirect', function() {
    if (is_singular(['topbar', 'header', 'footer', 'bottombar'])
        && !current_user_can('edit_posts')) {
        wp_redirect(home_url(), 302);
        exit;
    }
});

// Убираем лишние метабоксы
add_action('add_meta_boxes', function() {
    foreach (['topbar', 'header', 'footer', 'bottombar'] as $section) {
        remove_post_type_support($section, 'comments');
        remove_post_type_support($section, 'trackbacks');
    }
}, 20);