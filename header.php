<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class('ca-gov'); ?>>

<div id="skip-to-content">
    <a href="#main-content">Skip to Main Content</a>
</div>

<header role="banner" id="header" class="global-header fixed">

<!-- =========================
UTILITY HEADER
========================= -->
<div class="utility-header">
  <div class="container">
    <div class="flex-row">

      <div class="social-media-links">
        <div class="header-cagov-logo">
          <a href="https://www.ca.gov">
            <span class="sr-only">CA.gov</span>
            <span class="ca-gov-logo-svg"></span>
          </a>
        </div>

        <p class="official-tag">
          State of California
        </p>
      </div>

      <div class="settings-links">
        <span>Web Template v6.5.5</span>
      </div>

    </div>
  </div>
</div>

<!-- =========================
BRANDING
========================= -->
<div class="section-default">
  <div class="branding">
    <div class="container">

      <div class="header-organization-banner">
        <a href="<?php echo home_url(); ?>">

          <div class="logo-assets">

            <svg class="logo-img" aria-hidden="true"
                 viewBox="0 0 56 56"
                 xmlns="http://www.w3.org/2000/svg">
              <g>
                <path d="M45,9.7c-1.9,0-30.1,0-32,0s-3,1.2-3,3s0,40,0,40c0,0.6,0.2,1.2,0.5,1.7c0.5,0.8,1.4,1.3,2.5,1.3h32
                c1.7,0,3-1.3,3-3c0,0,0-38.3,0-40S46.9,9.7,45,9.7z M43.4,51.1H14.6V14.4h28.7V51.1z"/>
                <path d="M32.2,0.3c-4.8,0-24.6,0-24.6,0C4.2,0.3,0.3,1.6,0.3,8v28.5c0,4.7,4.7,4,4.7,4v-32c0-2.5,1.8-3.4,3.9-3.4
                h28C36.9,5.1,37,0.3,32.2,0.3z"/>
              </g>
            </svg>

            <div class="logo-text">
              <span class="logo-state">State of California</span>
              <span class="logo-dept"><?php bloginfo('name'); ?></span>
            </div>

          </div>

        </a>
      </div>

    </div>
  </div>
</div>

<!-- =========================
MOBILE CONTROLS
========================= -->
<div class="mobile-controls">
    <button class="mobile-control toggle-menu"
            aria-expanded="false"
            aria-controls="navigation">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span class="sr-only">Menu</span>
    </button>
</div>

<!-- =========================
NAV + SEARCH
========================= -->
<div class="navigation-search full-width-nav container">

    <!-- SEARCH -->
    <div id="head-search" class="search-container featured-search">
        <div class="container">
            <?php get_search_form(); ?>
        </div>
    </div>

    <!-- NAVIGATION -->
    <nav id="navigation"
         class="main-navigation dropdown nav"
         aria-label="Main navigation"
         data-multiselectable="false">

        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '<ul id="nav_list" class="top-level-nav">%3$s</ul>',
            'depth'          => 2,
            'fallback_cb'    => false,
        ]);
        ?>

    </nav>

</div>

</header>

<!-- =========================
CONTENT WRAPPER
========================= -->
<div id="main-content">

<main>