#!/bin/bash
set -e

echo "🚀 Starting CHHA setup..."

# -----------------------------
# CONFIG
# -----------------------------
WP="php /c/wp-cli/wp-cli.phar"
WP_PATH="/c/xampp/htdocs/wptest"
THEME_PATH="$WP_PATH/wp-content/themes/chha"

run_wp() {
  $WP --path="$WP_PATH" --skip-themes --skip-plugins "$@"
}

# -----------------------------
# SITE CONFIG
# -----------------------------
echo "Configuring site..."

run_wp option update blogname "CHHA Site"
run_wp option update blogdescription "CHHA WordPress System"
run_wp option update timezone_string "America/Los_Angeles"

# -----------------------------
# PERMALINKS
# -----------------------------
echo "Setting permalinks..."

run_wp rewrite structure "/%postname%/" --hard
run_wp rewrite flush --hard

# -----------------------------
# THEME
# -----------------------------
echo "Activating theme..."

run_wp theme activate chha || true

# -----------------------------
# ACF STATUS CHECK (NO DB IMPORT)
# -----------------------------
echo "Checking ACF + loading JSON..."

run_wp eval '
if (function_exists("acf_get_field_groups")) {
    acf_get_field_groups();
    echo "✔ ACF JSON loaded\n";
} else {
    echo "⚠ ACF not active\n";
}
'

# -----------------------------
# MENUS
# -----------------------------
echo "Creating menus..."

menu_exists() {
  run_wp menu list --fields=name 2>/dev/null | grep -Fxq "$1"
}

create_menu() {
  NAME="$1"

  if menu_exists "$NAME"; then
    echo "✔ Exists: $NAME"
  else
    run_wp menu create "$NAME"
    echo "✔ Created: $NAME"
  fi
}

create_menu "Main Menu"
create_menu "Footer Menu"
create_menu "Social Menu"
create_menu "Footer Column 1"
create_menu "Footer Column 2"
create_menu "Footer Column 3"

# -----------------------------
# BUILD ASSETS
# -----------------------------
echo "Building theme assets..."

cd "$THEME_PATH"

npm install
npm run build

echo "✅ CHHA setup complete"