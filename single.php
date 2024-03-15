<?php get_header(); ?>

<div id="primary-single-post" class="content-area-single-post">
    <main id="main-single-post" class="site-main-single-post" role="main-single-post" style="opacity: 0;">

        <?php
        $singlepost_shortcode = get_option('single_post_elementor_shortcode');
        $single_post_template = get_option('single_post_template'); // Retrieve selected single post template

        // Start the loop.
        while (have_posts()) : the_post();

            // Check if Elementor is active and if the specific template is being used
            if (class_exists('\Elementor\Plugin') && !\Elementor\Plugin::$instance->preview->is_preview_mode() && !empty(do_shortcode($singlepost_shortcode))) {
                // Output Elementor template with ID 774
                echo do_shortcode($singlepost_shortcode);
            } elseif (class_exists('\Elementor\Plugin') && !\Elementor\Plugin::$instance->preview->is_preview_mode() && !empty($single_post_template)) {
                // Output selected single post template
                get_template_part('Template/Single-post/' . $single_post_template);
            } elseif (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->preview->is_preview_mode()) {
                // Output default single post content
                the_content();
            } else {
                // Output default single post content
                get_template_part('Template/Single-post/single1');
            }

        // End of the loop.
        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>


