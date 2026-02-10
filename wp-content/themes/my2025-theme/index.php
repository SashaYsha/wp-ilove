<?php
get_header(); ?>

<div class="container">
    <main>
        <h1>Архив / Поиск</h1>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div><?php the_excerpt(); ?></div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Ничего не найдено.</p>
        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>