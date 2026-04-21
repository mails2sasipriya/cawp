<?php

/**
 * Safe ACF wrapper (prevents fatal error if plugin missing)
 */
function chha_field($key) {
    return function_exists('get_field') ? get_field($key) : null;
}

$variant = chha_field('hero_variant') ?: 'image';

$title       = chha_field('hero_title') ?: get_bloginfo('name');
$description = chha_field('hero_description');
$btn_text    = chha_field('hero_button_text');
$btn_link    = chha_field('hero_button_link');

$image       = chha_field('hero_image');
$bg_image    = chha_field('hero_bg_image');
$video       = chha_field('hero_video_url');

$show_bear   = chha_field('hero_static_asset_toggle');
?>

<?php if ($variant === 'background' && $bg_image): ?>

<!-- BACKGROUND HERO -->
<div class="header-primary-banner hidden-print"
     style="background-image:url('<?php echo esc_url($bg_image['url']); ?>');
            background-size:cover;
            background-position:center;">

  <div class="container">
    <div class="row my-4">
      <div class="col my-auto text-white">

        <h1 class="font-weight-600"><?php echo esc_html($title); ?></h1>

        <?php if ($description): ?>
          <div class="lead m-b-lg"><?php echo esc_html($description); ?></div>
        <?php endif; ?>

        <?php if ($btn_text): ?>
          <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-primary">
            <?php echo esc_html($btn_text); ?>
          </a>
        <?php endif; ?>

      </div>
    </div>
  </div>

</div>

<?php elseif ($variant === 'video' && $video): ?>

<!-- VIDEO HERO -->
<div class="header-primary-banner hidden-print">

  <div class="container">
    <div class="row my-4">

      <div class="col-md-6 my-auto">
        <h1 class="color-white"><?php echo esc_html($title); ?></h1>
        <p class="color-white"><?php echo esc_html($description); ?></p>
      </div>

      <div class="col-md-6">
        <iframe width="100%" height="315"
                src="<?php echo esc_url($video); ?>"
                frameborder="0"
                allowfullscreen></iframe>
      </div>

    </div>
  </div>

</div>

<?php else: ?>

<!-- DEFAULT HERO -->
<div class="header-primary-banner hidden-print">

  <div class="container">
    <div class="row my-4">

      <div class="col my-auto">

        <h1 class="color-white"><?php echo esc_html($title); ?></h1>

        <?php if ($description): ?>
          <div class="color-white lead">
            <?php echo esc_html($description); ?>
          </div>
        <?php endif; ?>

        <?php if ($btn_text): ?>
          <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-primary">
            <?php echo esc_html($btn_text); ?>
          </a>
        <?php endif; ?>

      </div>

      <div class="col my-auto">

        <?php if ($show_bear): ?>

          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/header-bear.svg"
            alt="California bear"
            width="100%"
          />

        <?php elseif ($image): ?>

          <img
            src="<?php echo esc_url($image['url']); ?>"
            alt="<?php echo esc_attr($image['alt']); ?>"
            width="100%"
          />

        <?php endif; ?>

      </div>

    </div>
  </div>

</div>

<?php endif; ?>