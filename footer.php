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
      <ul class="socialsharer-container">
        <?php
        wp_nav_menu([
          'theme_location' => 'social',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'fallback_cb'    => false,
        ]);
        ?>
      </ul>

    </div>
  </div>

  <!-- COPYRIGHT -->
  <div class="copyright">
    <div class="container text-right">
      © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
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