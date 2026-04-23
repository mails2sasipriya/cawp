<?php

$content = $attributes['content'] ?? '';
$author = $attributes['author'] ?? '';
$variant = $attributes['variant'] ?? 'graphic';

$class = $variant === 'no-graphic'
    ? 'no-quotation-mark'
    : 'with-graphic';
?>

<blockquote class="<?php echo esc_attr($class); ?>">

    <p><?php echo wp_kses_post($content); ?></p>

 <footer>
    <?php echo wp_kses_post($author); ?>
</footer>

</blockquote>