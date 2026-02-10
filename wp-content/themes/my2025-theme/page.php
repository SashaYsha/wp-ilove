<?php get_header(); ?>

<div style="display: flex; justify-content: center; align-items: center; height: 80vh; font-size: 48px; text-align: center;">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>Контент не найден.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>