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
add_action('after_setup_theme', 'chha_setup');


function chha_assets() {

    $base = get_template_directory_uri() . '/assets/css';

    // 1. Core framework
    wp_enqueue_style(
        'cagov-core',
        $base . '/cagov.core.min.css'
    );

    // 2. Theme layer
    wp_enqueue_style(
        'cagov-theme',
        $base . '/colortheme-oceanside.css',
        ['cagov-core']
    );

    // 3. State base custom styles
    wp_enqueue_style(
        'cagov-custom',
        $base . '/custom.css',
        ['cagov-theme']
    );

    // 4. Homepage styles (only front page)
    if (is_front_page()) {
        wp_enqueue_style(
            'cagov-homepage',
            $base . '/homepage.css',
            ['cagov-custom']
        );
    }

    // 5. FINAL override layer (your theme)
    $deps = is_front_page() ? ['cagov-homepage'] : ['cagov-custom'];

    wp_enqueue_style(
        'chha-style',
        get_stylesheet_uri(),
        $deps,
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    // Script
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


/* Allow SVG uploads */
add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

require get_template_directory() . '/inc/config-loader.php';