<div class='vasutheme-footer'>
    <?php
    $footer_elementor_shortcode = get_option('footer_elementor_shortcode');
    $copyright_text = get_option('footer_copyright_text'); // Assuming 'footer_custom_text' is the option name for the custom text field
    
    // Check if the Elementor shortcode is set and if Elementor is active
    if ($footer_elementor_shortcode && class_exists('\Elementor\Plugin')) {
        // Output the saved Elementor shortcode
        echo do_shortcode($footer_elementor_shortcode);
    } else {
        // Output custom footer content with custom copyright text if available, otherwise, default text
        if (!empty($copyright_text)) {
            echo '<p>' . $copyright_text . '</p>';

        } else {
            $site_name = get_bloginfo('name');
            echo '<p> © ' . $site_name . date(" Y") . '. All Rights Reserved.</p>';
            
        }
    }
    wp_footer(); // Enqueue Elementor assets
    ?>

</div> 