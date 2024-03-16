<?php
/**
 * The template for displaying individual pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
 *
 * @package paperx
 */

get_header();
?>

<div id="primary" class="post-content-area-paperx">
    <main id="main" class="site-main-area-paperx">
        <?php
        while (have_posts()) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'paperx'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->

        <?php endwhile; ?>
    </main><!-- #main -->
    <div class='theme-post-sidebar'>
        <?php get_sidebar(); ?>

    </div>
</div><!-- #primary -->




<?php

get_footer();
?>
