<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site may use a different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Your_Theme_Name
 */

get_header();
?>

<main id="page-primary" class="page-site-main">
    <div class="page-content">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <?php
        the_content();
        ?>
    </div>
</main><!-- #primary -->

<?php
get_footer();
