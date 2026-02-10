<?php
function my2025_setup() {
    register_nav_menus(array(
        'primary' => 'Главное меню'
    ));
}
add_action('after_setup_theme', 'my2025_setup');
