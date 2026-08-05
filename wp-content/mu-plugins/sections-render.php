<?php
/**
 * Plugin Name: Site Sections Render
 * Description: Выводит секции topbar/header/footer/bottombar на сайт
 */

if (!defined('ABSPATH')) exit;

/**
 * Рендерит одну секцию по её типу (slug)
 */
function render_site_section($slug) {
    static $cache = [];
    if (isset($cache[$slug])) return $cache[$slug];

    $html = '';
    $posts = get_posts([
        'post_type'      => $slug,
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    ]);

    if (!empty($posts)) {
        $id = $posts[0]->ID;
        // Контент, собранный Elementor (вместе со стилями)
        if (class_exists('\Elementor\Plugin')) {
            $html = \Elementor\Plugin::$instance->frontend->get_builder_content($id, true);
        }
        // Запасной вариант, если Elementor не использовался
        if ('' === trim($html)) {
            $html = apply_filters('the_content', $posts[0]->post_content);
        }
    }

    $cache[$slug] = $html;
    return $html;
}

/* Шорткод [site_section type="header"] — на будущее */
add_shortcode('site_section', function($atts) {
    $atts = shortcode_atts(['type' => 'header'], $atts);
    return render_site_section($atts['type']);
});

/* 🔼 TOPBAR + HEADER — сразу после <body> */
add_action('wp_body_open', function() {
    echo '<div class="si-wrap si-topbar">' . render_site_section('topbar') . '</div>';
    echo '<div class="si-wrap si-header">' . render_site_section('header') . '</div>';
}, 1);

/* 🔽 FOOTER + BOTTOMBAR — в самом низу страницы */
add_action('wp_footer', function() {
    echo '<div class="si-wrap si-footer">' . render_site_section('footer') . '</div>';
    echo '<div class="si-wrap si-bottombar">' . render_site_section('bottombar') . '</div>';
}, 99);

/*  Скрываем родные шапку и футер темы */
add_action('wp_head', function() {
    echo '<style>
        header:not(.si-wrap):not(.si-wrap *),
        footer:not(.si-wrap):not(.si-wrap *) { display: none !important; }
    </style>';
}, 99);