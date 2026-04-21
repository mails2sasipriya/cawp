<?php

/**
 * CHHA Config Loader
 * Phase 2: Import WP configuration from /config JSON files
 */

if (!defined('ABSPATH')) exit;

class CHHA_Config_Loader {

    private $config_path;

    public function __construct() {
        $this->config_path = get_template_directory() . '/../../config/';
        add_action('after_setup_theme', [$this, 'load_config'], 20);
    }

    public function load_config() {
        $this->apply_site_settings();
        $this->apply_theme_mods();
        $this->apply_menus();
    }

    /**
     * SITE TITLE + TAGLINE
     */
    private function apply_site_settings() {

        $site_name_file = $this->config_path . 'site-name.json';
        $tagline_file   = $this->config_path . 'site-tagline.json';

        if (file_exists($site_name_file)) {
            $name = trim(file_get_contents($site_name_file));
            if (!empty($name)) {
                update_option('blogname', $name);
            }
        }

        if (file_exists($tagline_file)) {
            $tagline = trim(file_get_contents($tagline_file));
            if (!empty($tagline)) {
                update_option('blogdescription', $tagline);
            }
        }
    }

    /**
     * THEME MODS (customizer settings)
     */
    private function apply_theme_mods() {

        $file = $this->config_path . 'theme_mods_chha.json';

        if (!file_exists($file)) return;

        $data = json_decode(file_get_contents($file), true);

        if (!is_array($data)) return;

        foreach ($data as $key => $value) {
            set_theme_mod($key, $value);
        }
    }

    /**
     * MENUS + LOCATIONS
     */
    private function apply_menus() {

        $menus_file = $this->config_path . 'menus.json';
        $locations_file = $this->config_path . 'nav_menu_locations.json';

        if (file_exists($menus_file)) {
            $menus = json_decode(file_get_contents($menus_file), true);
            $this->create_menus($menus);
        }

        if (file_exists($locations_file)) {
            $locations = json_decode(file_get_contents($locations_file), true);
            $this->assign_menu_locations($locations);
        }
    }

    /**
     * CREATE MENUS IF NOT EXISTS
     */
    private function create_menus($menus) {

        if (!is_array($menus)) return;

        foreach ($menus as $menu_name => $items) {

            $menu = wp_get_nav_menu_object($menu_name);

            if (!$menu) {
                $menu_id = wp_create_nav_menu($menu_name);
            } else {
                $menu_id = $menu->term_id;
            }

            if (!empty($items) && is_array($items)) {
                foreach ($items as $item) {
                    wp_update_nav_menu_item($menu_id, 0, [
                        'menu-item-title'  => $item['title'] ?? '',
                        'menu-item-url'    => $item['url'] ?? '#',
                        'menu-item-status' => 'publish',
                    ]);
                }
            }
        }
    }

    /**
     * ASSIGN MENUS TO LOCATIONS
     */
    private function assign_menu_locations($locations) {

        if (!is_array($locations)) return;

        $menu_locations = [];

        foreach ($locations as $location => $menu_name) {

            $menu = wp_get_nav_menu_object($menu_name);

            if ($menu) {
                $menu_locations[$location] = $menu->term_id;
            }
        }

        if (!empty($menu_locations)) {
            set_theme_mod('nav_menu_locations', $menu_locations);
        }
    }
}

new CHHA_Config_Loader();