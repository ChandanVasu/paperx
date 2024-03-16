<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paperx
 */

?>



<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head();?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

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
    wp_head();
    ?>
</div>

