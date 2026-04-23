<?php

$items = $attributes['items'] ?? [];

if (empty($items) || !is_array($items)) {
    return;
}
?>

<div class="chha-accordion-group">

    <?php foreach ($items as $item): ?>

        <?php
        $title = $item['title'] ?? '';
        $content = $item['content'] ?? '';
        ?>

        <cagov-accordion>
            <details>
                <summary><?php echo esc_html($title); ?></summary>
                <div class="accordion-body">
                    <?php echo wp_kses_post($content); ?>
                </div>
            </details>
        </cagov-accordion>

    <?php endforeach; ?>

</div>