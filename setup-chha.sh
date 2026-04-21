#!/bin/bash
set -e

echo "🚀 Starting CHHA setup..."

# -----------------------------
# WP-CLI CONFIG
# -----------------------------
WP="php /c/wp-cli/wp-cli.phar"
WP_PATH="/c/xampp/htdocs/wordpress-test"
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
# THEME ACTIVATION
# -----------------------------
echo "Activating theme..."

run_wp theme activate chha || true

# -----------------------------
# ACF INSTALL (SAFE + REAL CHECK)
# -----------------------------
echo "Installing Advanced Custom Fields..."

if run_wp plugin is-installed advanced-custom-fields >/dev/null 2>&1; then
  echo "✔ ACF already installed"
else
  if run_wp plugin install advanced-custom-fields --activate; then
    echo "✔ ACF installed and activated"
  else
    echo "⚠️ ACF install failed (likely SSL/cURL issue on XAMPP)"
    echo "➡️ Fix SSL cert in php.ini to enable plugin downloads"
  fi
fi

# -----------------------------
# MENU HELPERS
# -----------------------------
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

# -----------------------------
# MENUS
# -----------------------------
echo "Creating menus..."

create_menu "Main Menu"
create_menu "Footer Menu"
create_menu "Social Menu"
create_menu "Footer Column 1"
create_menu "Footer Column 2"
create_menu "Footer Column 3"

# -----------------------------
# THEME BUILD
# -----------------------------
echo "Building theme assets..."

cd "$THEME_PATH"

npm install
npm run build

echo "✅ CHHA setup complete"