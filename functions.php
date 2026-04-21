<?php

function chha_setup() {

    add_theme_support('title-tag');

    register_nav_menus([
        'primary'       => 'Main Menu',
        'footer'        => 'Footer Menu',
        'social'        => 'Social Menu',
        'footer_col_1'  => 'Footer Column 1',
        'footer_col_2'  => 'Footer Column 2',
        'footer_col_3'  => 'Footer Column 3',
    ]);
}
add_action('after_setup_theme', 'chha_setup', 0);

/**
 * CRITICAL FIX:
 * Ensure menu locations exist during WP-CLI execution
 */
if (defined('WP_CLI') && WP_CLI) {
    add_action('init', function () {
        chha_setup();
    });
}

function chha_assets() {

    $base = get_template_directory_uri() . '/assets/css';

    wp_enqueue_style('cagov-core', $base . '/cagov.core.min.css');

    wp_enqueue_style(
        'cagov-theme',
        $base . '/colortheme-oceanside.css',
        ['cagov-core']
    );

    wp_enqueue_style(
        'cagov-custom',
        $base . '/custom.css',
        ['cagov-theme']
    );

    if (is_front_page()) {
        wp_enqueue_style(
            'cagov-homepage',
            $base . '/homepage.css',
            ['cagov-custom']
        );
    }

    $deps = is_front_page() ? ['cagov-homepage'] : ['cagov-custom'];

    wp_enqueue_style(
        'chha-style',
        get_stylesheet_uri(),
        $deps,
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    wp_enqueue_script(
        'cagov-core-js',
        get_template_directory_uri() . '/assets/js/cagov.core.js',
        [],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'chha_assets');

function chha_menu_css_class($classes, $item, $args) {
    if ($args->theme_location === 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'chha_menu_css_class', 10, 3);

function chha_menu_link_class($atts, $item, $args) {
    if ($args->theme_location === 'primary') {
        $atts['class'] = 'first-level-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'chha_menu_link_class', 10, 3);

add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

require get_template_directory() . '/inc/config-loader.php';

if (function_exists('acf_add_options_page') || function_exists('acf_get_setting')) {

    // Save ACF JSON into theme folder
    add_filter('acf/settings/save_json', function () {
        return get_template_directory() . '/acf-json';
    });

    // Load ACF JSON from theme folder
    add_filter('acf/settings/load_json', function ($paths) {
        $paths[] = get_template_directory() . '/acf-json';
        return $paths;
    });
}