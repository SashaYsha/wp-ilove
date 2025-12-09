<?php get_header(); ?>

<div class="container">
    <main>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                        <?php echo get_the_date(); ?> | <?php the_author(); ?>
                    </div>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            echo '<p>Записей не найдено.</p>';
        endif;
        ?>
    </main>
</div>

<?php get_footer(); ?>