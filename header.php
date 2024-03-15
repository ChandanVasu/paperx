<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head();?>
<style>
    *{
        margin: 0;
        padding:0;
    }
</style>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- Your header content -->

<div class="header-content-vasutheme">
    <?php
    // Retrieve the selected header from the WordPress database
    $selected_header = get_option('header_selected');
    $header_shortcode = get_option('header_shortcode');

    // Check if the selected header is set and not empty
    if (!empty($header_shortcode)) {
        // Output the header setup using the shortcode
        echo do_shortcode($header_shortcode);
    } elseif (!empty($selected_header)) {
        // Output the selected header
        get_template_part('Template/Header-Template/' . $selected_header);
    } else {
        // Output default header content (header1)
        get_template_part('Template/Header-Template/header1');
    }
    ?>
</div>

<?php wp_head();?>

