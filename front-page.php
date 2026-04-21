<?php get_header(); ?>

<?php get_template_part('template-parts/hero-banner'); ?>

<!-- PAGE CONTENT -->
<section class="section">
 
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_content();
      endwhile;
    endif;
    ?>
  
</section>

<?php get_footer(); ?>