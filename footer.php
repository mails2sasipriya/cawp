</main>
</div> <!-- end #main-content -->

<!-- =========================
SITE FOOTER (3 COLUMN)
========================= -->
<aside class="p-b-md p-t-sm section-standout site-footer">
  <div class="container">
    <div class="row">

      <!-- COLUMN 1 -->
      <div class="col-md-4">
        <div class="h4 w-100 brd-bottom brd-highlight p-b">Our Department</div>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer_col_1',   // FIXED
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 1,
          'link_before'    => '<span class="d-block no-underline m-y font-size-16 text-white color-highlight-hover underline-hover">',
          'link_after'     => '</span>',
          'fallback_cb'    => '__return_empty_string', // PREVENT PAGE LIST
        ]);
        ?>
      </div>

      <!-- COLUMN 2 -->
      <div class="col-md-4">
        <div class="h4 w-100 brd-bottom brd-highlight p-b">State Campaigns</div>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer_col_2',   // FIXED
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 1,
          'link_before'    => '<span class="d-block no-underline m-y font-size-16 text-white color-highlight-hover underline-hover">',
          'link_after'     => '</span>',
          'fallback_cb'    => '__return_empty_string', // PREVENT PAGE LIST
        ]);
        ?>
      </div>

      <!-- COLUMN 3 -->
      <div class="col-md-4">
        <div class="h4 w-100 brd-bottom brd-highlight p-b">Communities</div>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer_col_3',   // FIXED
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 1,
          'link_before'    => '<span class="d-block no-underline m-y font-size-16 text-white color-highlight-hover underline-hover">',
          'link_after'     => '</span>',
          'fallback_cb'    => '__return_empty_string', // PREVENT PAGE LIST
        ]);
        ?>
      </div>

    </div>
  </div>
</aside>

<!-- =========================
GLOBAL FOOTER (CA)
========================= -->
<footer id="footer" class="global-footer">

  <div class="container">
    <div class="d-flex">

      <!-- CA LOGO -->
      <a href="https://www.ca.gov" class="cagov-logo">
        <span class="sr-only">CA.gov</span>
        <span class="ca-gov-logo-svg"></span>
      </a>

      <!-- FOOTER LINKS -->
      <ul class="footer-links">
        <?php
        wp_nav_menu([
          'theme_location' => 'footer',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'fallback_cb'    => false,
        ]);
        ?>
      </ul>

      <!-- SOCIAL -->
  <ul class="socialsharer-container nav social-share-links">
  <?php
  // Social icons mapping: menu item title → CA State Template icon class
  $icon_map = [
    'facebook'  => 'ca-gov-icon-facebook',
    'twitter'   => 'ca-gov-icon-twitter',
    'x'         => 'ca-gov-icon-twitter', // fallback
    'youtube'   => 'ca-gov-icon-youtube',
    'linkedin'  => 'ca-gov-icon-linkedin',
    'instagram' => 'ca-gov-icon-instagram',
    'github'    => 'ca-gov-icon-github',
  ];

  $menu_items = wp_get_nav_menu_items( get_nav_menu_locations()['social'] ?? 0 );

  if ( $menu_items ) {
    foreach ( $menu_items as $item ) {

      // find proper icon
      $title_key = strtolower( $item->title );
      $icon_class = $icon_map[$title_key] ?? 'ca-gov-icon-link'; // fallback icon

      echo '<li class="nav-item">';
      echo '<a class="nav-link ' . esc_attr( $icon_class ) . '" href="' . esc_url( $item->url ) . '" target="_blank" title="' . esc_attr( $item->title ) . '"></a>';
      echo '</li>';
    }
  }
  ?>
</ul>

    </div>
  </div>

  <!-- COPYRIGHT -->
  <div class="copyright">
    <div class="container text-right">
      © <?php echo date('Y'); ?> State of California
    </div>
  </div>

  <!-- BACK TO TOP -->
  <button class="return-top">
    <span class="sr-only">Back to top</span>
  </button>

</footer>

<?php wp_footer(); ?>
</body>
</html>