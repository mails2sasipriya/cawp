#!/bin/bash
set -e

echo "Starting CHHA setup..."

WP="php /c/wp-cli/wp-cli.phar"
WP_PATH="/c/xampp/htdocs/chha-wp"

run_wp() {
  $WP --path="$WP_PATH" --skip-themes --skip-plugins "$@"
}

# Basic site config
run_wp option update blogname "CHHA Site"
run_wp option update blogdescription "CHHA WordPress System"
run_wp option update timezone_string "America/Los_Angeles"

# Permalinks
run_wp rewrite structure "/%postname%/" --hard

# Activate theme
$WP --path="$WP_PATH" theme activate chha

# Menus
echo "Creating menus..."
run_wp menu create "Main Menu" || true
run_wp menu create "Footer Column 1" || true
run_wp menu create "Footer Column 2" || true
run_wp menu create "Footer Column 3" || true
run_wp menu create "Social Menu" || true

run_wp menu location assign "Main Menu" primary
run_wp menu location assign "Footer Column 1" footer_col_1
run_wp menu location assign "Footer Column 2" footer_col_2
run_wp menu location assign "Footer Column 3" footer_col_3
run_wp menu location assign "Social Menu" social

# Build assets (inside theme)
npm install
npm run build

echo "✅ CHHA setup complete"