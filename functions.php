<?php
// Add theme support for various features
function theme_setup() {
    // Post Thumbnails Support
    add_theme_support('post-thumbnails');

    // Automatic Feed Links Support
    add_theme_support('automatic-feed-links');

    // Title Tag Support
    add_theme_support('title-tag');

    // Custom Logo Support
    add_theme_support('custom-logo');

    // WP Block Styles Support
    add_theme_support('wp-block-styles');

    // Responsive Embeds Support
    add_theme_support('responsive-embeds');

    // HTML5 Support
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ));

    // Custom Header Support
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1000,
        'height'        => 250,
        'flex-height'   => true,
        'flex-width'    => true,
        'header-text'   => false,
    ));

    // Custom Background Support
    add_theme_support('custom-background');

    // Align Wide Support
    add_theme_support('align-wide'); // Add support for wide alignment

    // Register Primary Menu
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'paperx'),
    ));
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue Elementor scripts and styles
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_script( 'elementor-frontend' );
    wp_enqueue_style( 'elementor-frontend' );
}, 20 );

// Include various theme settings and functionalities
include_once get_template_directory() . '/Inc/Theme Setting/header.php';
include_once get_template_directory() . '/Inc/Theme Setting/logo.php';
include_once get_template_directory() . '/Inc/Theme Setting/single.php';
include_once get_template_directory() . '/Inc/Theme Setting/footer.php';
include_once get_template_directory() . '/Inc/Theme Setting/archive.php';
include_once get_template_directory() . '/Inc/Demo.php';
include_once get_template_directory() . '/Inc/function-inc.php';

// Register Elementor widgets
function register_vasutheme_widget( $widgets_manager ) {
    // Include widget files
    require_once( __DIR__ . '/Elementor/widget.php' );
    require_once( __DIR__ . '/Elementor/Grid-Post-1.php' );
    // Include other widget files...

    // Register widgets
    $widgets_manager->register( new \Custom_Post_Share_Widget() );
    $widgets_manager->register( new \List_Post_1());
    // Register other widgets...
}
add_action( 'elementor/widgets/register', 'register_vasutheme_widget' );

// Add custom categories for Elementor widgets
function add_elementor_widget_categories( $elements_manager ) {
    $categories = [];
    $categories['Vasu X'] = [
        'title' => 'Vasu X',
        'icon'  => 'fa fa-plug'
    ];

    $old_categories = $elements_manager->get_categories();
    $categories = array_merge($categories, $old_categories);

    $set_categories = function ( $categories ) {
        $this->categories = $categories;
    };

    $set_categories->call( $elements_manager, $categories );
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');

// Enqueue styles and scripts
function enqueue_styles_and_scripts() {
    // Enqueue CSS files
    wp_enqueue_style('Grid-Post-1', get_template_directory_uri() . '/Assets/Styles/Elementor/Grid-Post-1.css');
    // Enqueue other CSS files...
}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

// Enqueue footer script
function add_custom_scripts() {
    wp_enqueue_script('footer-script', get_template_directory_uri() . '/Assets/Js/footer.js');
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');

// Enqueue admin styles
function enqueue_admin_styles() {
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');

// Add introductory text for OCDI plugin
function ocdi_plugin_intro_text( $default_text ) {
    $default_text .= '<div class="ocdi__intro-text"><h1>Import Demo Data Vasu Theme.</h1></div>';
    return $default_text;
}
add_filter( 'ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );

// Set content width if not already set
if (!isset($content_width)) {
    $content_width = 900; // Set the desired content width in pixels
}

// Enqueue comment reply script
function enqueue_comment_reply_script() {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_comment_reply_script');
