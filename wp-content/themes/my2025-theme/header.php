<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <nav style="padding: 20px; text-align: center; background: #f0f0f0; margin-bottom: 20px;">
    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
</nav>