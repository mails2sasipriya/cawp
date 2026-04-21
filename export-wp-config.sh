#!/bin/bash
set -e

# --------------------------------------------------
# Paths (Windows-safe)
# --------------------------------------------------
PHP="/c/xampp/php/php.exe"
WP="/c/wp-cli/wp-cli.phar"
WP_PATH="/c/xampp/htdocs/wordpress"

CONFIG_DIR="config"
mkdir -p "$CONFIG_DIR"

echo "Exporting CHHA WordPress configuration..."

# --------------------------------------------------
# WP-CLI runner (stable for Git Bash)
# --------------------------------------------------
run_wp() {
  "$PHP" "$WP" --path="$WP_PATH" --skip-themes --skip-plugins "$@"
}

# --------------------------------------------------
# Step 1: Site basics
# --------------------------------------------------
echo "Step 1: Site basics"

run_wp option get blogname > "$CONFIG_DIR/site-name.json"
run_wp option get blogdescription > "$CONFIG_DIR/site-tagline.json"
run_wp option get stylesheet > "$CONFIG_DIR/active-theme.json"

# --------------------------------------------------
# Step 2: Theme state (IMPORTANT SOURCE OF TRUTH)
# --------------------------------------------------
echo "Step 2: Theme state"

run_wp option get theme_mods_chha --format=json > "$CONFIG_DIR/theme_mods_chha.json" || echo "{}" > "$CONFIG_DIR/theme_mods_chha.json"

# --------------------------------------------------
# Step 3: Clean menu export (FIXED APPROACH)
# NOTE: WP stores real menu assignments in theme_mods
# --------------------------------------------------
echo "Step 3: Menus (skipped raw export, using theme_mods)"

# Optional debug export only (not required for restore)
run_wp menu list --format=json > "$CONFIG_DIR/menus_debug.json" || echo "[]" > "$CONFIG_DIR/menus_debug.json"

# --------------------------------------------------
# Step 4: Widgets
# --------------------------------------------------
echo "Step 4: Widgets"

run_wp widget list --format=json > "$CONFIG_DIR/sidebars_widgets.json" || echo "{}" > "$CONFIG_DIR/sidebars_widgets.json"

echo "✔ CHHA config export complete"