<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        endif;
        ?>

        <?php 
            if (function_exists('techvibe_latest_posts_section')) {
                techvibe_latest_posts_section();
            } else {
                echo 'Funkcja techvibe_latest_posts_section() nie istnieje.';
            }
        ?>

    </main>
</div>

<?php get_footer(); ?>
