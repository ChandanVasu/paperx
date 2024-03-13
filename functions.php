<?php

function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');

    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'vasutheme'),
    ));
    register_nav_menus(array(
        'hearder-menu' => __('Header Menu', 'vasutheme'),
    ));
}
add_action('after_setup_theme', 'theme_setup');


include_once get_template_directory() . '/Inc/paperx-template.php';

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_script( 'elementor-frontend' );
    wp_enqueue_style( 'elementor-frontend' );
}, 20 );


function theme_options_page() {
    ?>
    <div class="theme-options-content">
        <?php get_template_part('Inc/Theme Setting/Theme-Setting-Template-File/Theme-Setting'); ?>
    </div>
    <?php
}

// Register the "Theme Options" menu
function register_theme_options_menu() {
    add_menu_page(
        'Theme Options',   
        'Vasu Theme',       
        'manage_options',        
        'theme-options',    
        'theme_options_page', 
        'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1792 1792"><path fill="currentColor" d="M874 1638v66q-208-6-385-109.5T206 1319l58-34q29 49 73 99l65-57q148 168 368 212l-17 86q65 12 121 13m-598-530l-83 28q22 60 49 112l-57 33q-98-180-98-385t98-385l57 33q-30 56-49 112l82 28q-35 100-35 212q0 109 36 212m1252 177l58 34q-106 172-283 275.5T918 1704v-66q56-1 121-13l-17-86q220-44 368-212l65 57q44-50 73-99m-151-554l-233 80q14 42 14 85t-14 85l232 80q-31 92-98 169l-185-162q-57 67-147 85l48 241q-52 10-98 10t-98-10l48-241q-90-18-147-85l-185 162q-67-77-98-169l232-80q-14-42-14-85t14-85l-233-80q33-93 99-169l185 162q59-68 147-86l-48-240q44-10 98-10t98 10l-48 240q88 18 147 86l185-162q66 76 99 169M874 88v66q-65 2-121 13l17 86q-220 42-368 211l-65-56q-38 42-73 98l-57-33q106-172 282-275.5T874 88m831 808q0 205-98 385l-57-33q27-52 49-112l-83-28q36-103 36-212q0-112-35-212l82-28q-19-56-49-112l57-33q98 180 98 385m-120-423l-57 33q-35-56-73-98l-65 56q-148-169-368-211l17-86q-56-11-121-13V88q209 6 385 109.5T1585 473m163 423q0-173-67.5-331T1499 293t-272-181.5T896 44t-331 67.5T293 293T111.5 565T44 896t67.5 331T293 1499t272 181.5t331 67.5t331-67.5t272-181.5t181.5-272t67.5-331m44 0q0 182-71 348t-191 286t-286 191t-348 71t-348-71t-286-191t-191-286T0 896t71-348t191-286T548 71T896 0t348 71t286 191t191 286t71 348"/></svg>
      '),                        
        20                       
    );
}
add_action('admin_menu', 'register_theme_options_menu');

// Include the file containing the callback function for the sub-menu
include_once get_template_directory() . '/Inc/Theme Setting/header.php';
include_once get_template_directory() . '/Inc/Theme Setting/logo.php';
include_once get_template_directory() . '/Inc/Theme Setting/single.php';
include_once get_template_directory() . '/Inc/Theme Setting/footer.php';
include_once get_template_directory() . '/Inc/Theme Setting/archive.php';
include_once get_template_directory() . '/Inc/Demo.php';




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
    wp_enqueue_style('Paper Css', get_template_directory_uri() . '/Assets/Styles/Paper.css');
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


function wpse196289_default_page_template() {
    global $post;
    if ( 'page' == $post->post_type 
        && 0 != count( get_page_templates( $post ) ) 
        && get_option( 'page_for_posts' ) != $post->ID // Not the page for listing posts
        && '' == $post->page_template // Only when page_template is not set
    ) {
        $post->page_template = "page-mytemplate.php";
    }
}
add_action('add_meta_boxes', 'wpse196289_default_page_template', 1);




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

