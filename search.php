<?php
get_header();

$archive_shortcode = get_option('archive_elementor_shortcode');
$archive_template = get_option('archive_template'); // Retrieve selected archive template

// Check if the archive shortcode is empty
if (!empty($archive_shortcode)) {
    // If the shortcode is not empty, display it
    echo do_shortcode($archive_shortcode);
} elseif (!empty($archive_template)) {
    // If the shortcode is empty but the template is set, display the template
    get_template_part('Template/Archive/' . $archive_template);
} else {
    // If both shortcode and template are empty, display a default message or content
    get_template_part('Template/Archive/archive1');
}

get_footer();
?>
