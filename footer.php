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
        <div class="h4 w-100 brd-bottom brd-highlight p-b">CHHA</div>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer-menu-1',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 1,
          'link_before'    => '<span class="d-block no-underline m-y font-size-16 text-white color-highlight-hover underline-hover">',
          'link_after'     => '</span>',
        ]);
        ?>
      </div>

      <!-- COLUMN 2 -->
      <div class="col-md-4">
        <div class="h4 w-100 brd-bottom brd-highlight p-b">Resources</div>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer-menu-2',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 1,
          'link_before'    => '<span class="d-block no-underline m-y font-size-16 text-white color-highlight-hover underline-hover">',
          'link_after'     => '</span>',
        ]);
        ?>
      </div>

      <!-- COLUMN 3 -->
      <div class="col-md-4">
        <div class="h4 w-100 brd-bottom brd-highlight p-b">Related websites</div>

        <?php
        wp_nav_menu([
          'theme_location' => 'footer-menu-3',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'depth'          => 1,
          'link_before'    => '<span class="d-block no-underline m-y font-size-16 text-white color-highlight-hover underline-hover">',
          'link_after'     => '</span>',
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