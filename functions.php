<?php

/**
 * Theme Setup
 */
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
 * WP-CLI safety (ensures menus exist in automation mode)
 */
if (defined('WP_CLI') && WP_CLI) {
    add_action('init', 'chha_setup', 0);
}

/**
 * Assets
 */
function chha_assets() {

    $base = get_template_directory_uri() . '/assets/css';
    $custom_base = get_template_directory_uri() . '/src/css';

    wp_enqueue_style('cagov-core', $base . '/cagov.core.min.css');

    wp_enqueue_style(
        'cagov-theme',
        $base . '/colortheme-oceanside.css',
        ['cagov-core']
    );

    wp_enqueue_style(
        'cagov-custom',
        $custom_base . '/custom.css',
        ['cagov-theme']
    );

    if (is_front_page()) {
        wp_enqueue_style(
            'cagov-homepage',
            $custom_base . '/homepage.css',
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

/**
 * Menu styling helpers
 */
function chha_menu_css_class($classes, $item, $args) {
    if (!empty($args->theme_location) && $args->theme_location === 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'chha_menu_css_class', 10, 3);

function chha_menu_link_class($atts, $item, $args) {
    if (!empty($args->theme_location) && $args->theme_location === 'primary') {
        $atts['class'] = 'first-level-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'chha_menu_link_class', 10, 3);

/**
 * SVG support
 */
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/**
 * SAFE ACF HELPER (ONLY DEFINED ONCE)
 * 👉 THIS IS THE FIX FOR YOUR FATAL ERROR
 */
if (!function_exists('chha_field')) {
    function chha_field($key) {
        return function_exists('get_field') ? get_field($key) : null;
    }
}

/**
 * ACF JSON (CONFIG-DRIVEN SCHEMA)
 */
if (function_exists('acf_get_field_groups') || function_exists('acf_get_setting')) {

    add_filter('acf/settings/save_json', function () {
        return get_template_directory() . '/acf-json';
    });

    add_filter('acf/settings/load_json', function ($paths) {
        $paths[] = get_template_directory() . '/acf-json';
        return $paths;
    });
}

/**
 * Config loader (your engine layer)
 */
require get_template_directory() . '/inc/config-loader.php';