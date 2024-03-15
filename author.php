<?php
get_header();
$archive_shortcode = get_option('archive_elementor_shortcode');
$archive_template = get_option('archive_template');
?>


    <?php
  

        if (!empty($archive_shortcode)) {
            // If the shortcode is not empty, display it
            echo do_shortcode($archive_shortcode);
        } elseif (!empty($archive_template)) {
            
            get_template_part('Template/Archive/' . $archive_template);

        } else {
            // If both shortcode and template are empty, display a default message or content

            get_template_part('Template/Archive/archive1');
        }


    // Pagination
    the_posts_pagination(array(
        'prev_text' => __('Previous page', 'paperx'),
        'next_text' => __('Next page', 'paperx'),
    ));
    ?>


<?php
get_footer();
?>
