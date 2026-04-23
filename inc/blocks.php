<?php
add_action('init', function () {

    $blocks_dir = get_template_directory() . '/blocks';

    foreach (glob($blocks_dir . '/*', GLOB_ONLYDIR) as $dir) {

        $slug = basename($dir);

        if ($slug === '_engine') continue;

        $block_name = 'chha/' . $slug;

        $js_path = $dir . '/index.js';
        $render_path = $dir . '/render.php';

        // Register script per block
        if (file_exists($js_path)) {

            $handle = 'chha-' . $slug . '-editor';

            wp_register_script(
                $handle,
                get_template_directory_uri() . '/blocks/' . $slug . '/index.js',
                ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'],
                filemtime($js_path)
            );

            register_block_type($block_name, [
                'editor_script' => $handle,
                'render_callback' => function ($attributes) use ($render_path) {

                    ob_start();
                    include $render_path;
                    return ob_get_clean();
                }
            ]);
        }
    }
});