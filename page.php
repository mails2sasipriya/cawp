<?php get_header(); ?>

<section class="section">
  <div class="container">

    <?php
    while (have_posts()) : the_post();
    ?>

      <h1><?php the_title(); ?></h1>

      <div class="m-t-md">
        <?php the_content(); ?>
      </div>

    <?php endwhile; ?>

  </div>
</section>

<?php get_footer(); ?>