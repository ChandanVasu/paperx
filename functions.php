<?php
// Add support for wide alignment
function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ));
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1000,
        'height'        => 250,
        'flex-height'   => true,
        'flex-width'    => true,
        'header-text'   => false,
    ));
    add_theme_support('custom-background');
    add_theme_support('align-wide'); // Recommended: Add support for wide alignment
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'paperx'),
    ));
}
add_action('after_setup_theme', 'theme_setup');



// include_once get_template_directory() . '/Plugin/custom-post-types.php';

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_script( 'elementor-frontend' );
    wp_enqueue_style( 'elementor-frontend' );
}, 20 );



// Include the file containing the callback function for the sub-menu
include_once get_template_directory() . '/Inc/Theme Setting/header.php';
include_once get_template_directory() . '/Inc/Theme Setting/logo.php';
include_once get_template_directory() . '/Inc/Theme Setting/single.php';
include_once get_template_directory() . '/Inc/Theme Setting/footer.php';
include_once get_template_directory() . '/Inc/Theme Setting/archive.php';
include_once get_template_directory() . '/Inc/Demo.php';
include_once get_template_directory() . '/Inc/function-inc.php';





function register_vasutheme_widget( $widgets_manager ) {

    require_once( __DIR__ . '/Elementor/widget.php' );
    require_once( __DIR__ . '/Elementor/Grid-Post-1.php' );
    require_once(__DIR__ . '/Elementor/List-Post-1.php');
    require_once(__DIR__ . '/Elementor/author.php');
    require_once(__DIR__ . '/Elementor/Grid-Post-2.php');
    require_once(__DIR__ . '/Elementor/Heading-Title-Elementor.php');
    require_once(__DIR__ . '/Elementor/Single-Post-Content.php');



    $widgets_manager->register( new \Custom_Post_Share_Widget() );
    $widgets_manager->register( new \List_Post_1());
    $widgets_manager->register( new \Post_Title_Widget());
    $widgets_manager->register( new \Grid_Post_1() );
    $widgets_manager->register( new \Grid_Post_2() );
    $widgets_manager->register( new \Custom_Title_Widget() );
    $widgets_manager->register( new \Single_Post_Content_Widget() );
    $widgets_manager->register( new \Author_Info_Widget ());
    $widgets_manager->register( new \Comment_Widget());
    $widgets_manager->register( new \Post_Thumbnail_Widget());
    $widgets_manager->register( new \Post_Meta_Widget());
    $widgets_manager->register( new \Breadcrumb_Widget());
    $widgets_manager->register( new \Post_Excerpt_Widget());
    // $widgets_manager->register( new \Archive_Title());


    
}
add_action( 'elementor/widgets/register', 'register_vasutheme_widget' );

function add_elementor_widget_categories( $elements_manager ) {

    $categories = [];
    $categories['Vasu X'] =
        [
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


function enqueue_styles_and_scripts() {
    // Enqueue CSS file
    wp_enqueue_style('Grid-Post-1', get_template_directory_uri() . '/Assets/Styles/Elementor/Grid-Post-1.css');
    wp_enqueue_style('Grid-Post-2', get_template_directory_uri() . '/Assets/Styles/Elementor/Grid-Post-2.css');
    wp_enqueue_style('Main Css', get_template_directory_uri() . '/Assets/Styles/Elementor/main.css');
    wp_enqueue_style('List-Post', get_template_directory_uri() . '/Assets/Styles/Elementor/List-Post.css');
    wp_enqueue_style('List-Post-2', get_template_directory_uri() . '/Assets/Styles/Elementor/List-Post-2.css');
    wp_enqueue_style('vasutheme Css', get_template_directory_uri() . '/Assets/Styles/vasutheme.css');
    wp_enqueue_style('Header1 css', get_template_directory_uri() . '/Assets/Styles/Header/header1.css');
    wp_enqueue_style('Header2 css', get_template_directory_uri() . '/Assets/Styles/Header/header2.css');
    wp_enqueue_style('Search css', get_template_directory_uri() . '/Assets/Styles/Header/search.css');
    wp_enqueue_style('Hamburger css', get_template_directory_uri() . '/Assets/Styles/Header/hamburger.css');
    wp_enqueue_style('Theme', get_template_directory_uri() . '/Assets/Styles/main.css');
    wp_enqueue_style('Single Post 1', get_template_directory_uri() . '/Assets/Styles/single1.css');
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');


function add_custom_scripts() {
    // Enqueue footer.js script
    wp_enqueue_script('footer-script', get_template_directory_uri() . '/Assets/Js/footer.js');
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');





function enqueue_admin_styles() {
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_admin_styles');



require_once get_template_directory() . '/Inc/Theme Setting/Plugin/activation.php';

function ocdi_plugin_intro_text( $default_text ) {
    $default_text .= '<div class="ocdi__intro-text"><h1>Import Demo Data Vasu Theme.</h1></div>';
 
    return $default_text;
}
add_filter( 'ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );


if (!isset($content_width)) {
    $content_width = 900; // Set the desired content width in pixels
}
