<?php


/**
 * Theme Name: PaperX

 */

function register_vasutheme_widget($widgets_manager) {

    require_once(__DIR__ . '/Widget/widget.php');
    require_once(__DIR__ . '/Widget/Grid-Post-1.php');
    require_once(__DIR__ . '/Widget/List-Post-1.php');
    require_once(__DIR__ . '/Widget/author.php');
    require_once(__DIR__ . '/Widget/Grid-Post-2.php');
    require_once(__DIR__ . '/Widget/Heading-Title-Elementor.php');
    require_once(__DIR__ . '/Widget/Single-Post-Content.php');

    $widgets_manager->register(new \Custom_Post_Share_Widget());
    $widgets_manager->register(new \List_Post_1());
    $widgets_manager->register(new \Post_Title_Widget());
    $widgets_manager->register(new \Grid_Post_1());
    $widgets_manager->register(new \Grid_Post_2());
    $widgets_manager->register(new \Custom_Title_Widget());
    $widgets_manager->register(new \Single_Post_Content_Widget());
    $widgets_manager->register(new \Author_Info_Widget());
    $widgets_manager->register(new \Comment_Widget());
    $widgets_manager->register(new \Post_Thumbnail_Widget());
    $widgets_manager->register(new \Post_Meta_Widget());
    $widgets_manager->register(new \Breadcrumb_Widget());
    $widgets_manager->register(new \Post_Excerpt_Widget());
    $widgets_manager->register(new \Custom_Nav_Menu_Widget());

}
add_action('elementor/widgets/register', 'register_vasutheme_widget');
