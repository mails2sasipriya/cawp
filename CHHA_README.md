# CHHA WordPress Theme (State Template Starter)

CHHA is a WordPress theme built using the California State Web Template approach, with a focus on clean structure, config-driven menus, and a portable setup that can be reused across environments.

---

## What this project is

This is **not a full WordPress installation repo**.

It is a **theme-centric starter system** designed to work inside an existing WordPress install.

You install WordPress separately, then drop this theme into:

```
wp-content/themes/chha/
```

---

## Key Features

- CA State Web Template CSS integration
- Modular header and footer structure
- Fully dynamic WordPress menus
- Config-driven export system (`/config`)
- Asset build pipeline using Node.js
- Clean separation between WordPress core and theme code
- Git-safe (no WordPress core committed)

---

## Project Structure

wp-content/themes/chha/
├── assets/
│   ├── css/
│   │   ├── custom.css
│   │   ├── homepage.css
│   │   └── (built CA template assets)
│   ├── js/
│   └── fonts/
│
├── template-parts/heo-banner.php
├── functions.php
├── header.php
├── footer.php
├── style.css
├── copy-assets.js
├── package.json

config/
├── menus.json
├── nav_menu_locations.json
├── theme_mods_chha.json
├── widget-options.json
├── site-name.json
├── site-tagline.json

---

## Setup Instructions

### 1. Install dependencies (WordPress root)

npm install

### 2. Build theme assets

npm run build

### 3. Activate theme

Appearance → Themes → Activate CHHA

---

## Configuration System

Run:

./export-wp-config.sh

Outputs /config folder for portability.

---

## Menu System

Footer uses:

'items_wrap' => '%3$s'

to remove UL/LI wrappers.

---

## Git Rules

DO NOT commit:
node_modules, wp-admin, wp-includes, uploads, wp-config.php

ONLY commit:
theme + config + scripts

---

## Goal

Reusable, portable, State Template-based WordPress starter theme.
