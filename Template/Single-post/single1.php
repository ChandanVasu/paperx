<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package paperx
 */

get_header();
?>

<div class='paperx-single1-post'>

    <div class="paperx-single1-content-area">
        <!-- breadcrumb-inner.php -->
        <ul class="paperx-breadcrumb-single1">
            <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
            <li><a href="<?php echo esc_url(get_permalink()); ?>">
                    <?php the_title(); ?>
                </a></li>
        </ul>

        <h1 class="paperx-post-title-single1">
            <?php the_title(); ?>
        </h1>

        <?php if (has_excerpt()) : ?>
        <div class="paperx-post-excerpt-single1">
            <?php the_excerpt(); ?>
        </div>
        <?php endif; ?>

        <div class='paperx-author-single1'>
           
                <?php get_template_part('Template/author-info'); ?>
        </div>

        <?php if (has_post_thumbnail()) : ?>
        <div class="paperx-post-thumbnailss-single1">
            <?php the_post_thumbnail('full'); ?>
        </div>
        <?php endif; ?>

        <div class="paperx-post-content-single1">
            <?php the_content(); ?>
        </div>

        <div class='paperxpost-tag-single1'>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 36 36">
                <path fill="currentColor"
                    d="M31.87 10h-5.55l1-4.83A1 1 0 0 0 26.35 4h-2a1 1 0 0 0-1 .78L22.33 10h-5.4l1-4.83A1 1 0 0 0 17 4h-2a1 1 0 0 0-1 .78L13 10H7a1 1 0 0 0-1 .8l-.41 2a1 1 0 0 0 1 1.2h5.55l-1.64 8h-6a1 1 0 0 0-1 .8l-.41 2a1 1 0 0 0 1 1.2h5.59l-1 4.83a1 1 0 0 0 1 1.17h2a1 1 0 0 0 .95-.78L13.67 26h5.4l-1 4.83A1 1 0 0 0 19 32h2a1 1 0 0 0 1-.78L23.05 26h6a1 1 0 0 0 1-.8l.4-2a1 1 0 0 0-1-1.2h-5.58l1.63-8h6a1 1 0 0 0 1-.8l.41-2a1 1 0 0 0-1.04-1.2m-12 12h-5.4l1.64-8h5.4Z" />
            </svg>
            <span>Tag - </span>
            <?php
            $posttags = get_the_tags();
            if ($posttags) {
                foreach($posttags as $tag) {
                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>, '; 
                }
            }
            ?>
        </div>

        <?php
        if (comments_open() || get_comments_number()) :
            comments_template();
            
        endif;
        ?>
        <?php wp_link_pages(); ?>

    </div>
     
    <div class='paperx-single1-sidebar'>
     <?php get_sidebar(); ?>
    </div>

</div>

<?php
get_footer();
?>