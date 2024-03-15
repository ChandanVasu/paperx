<?php

// Enqueue editor styles
function theme_editor_styles() {
    add_editor_style('editor-styles.css'); // Replace 'editor-styles.css' with the name of your custom CSS file
}
add_action('admin_init', 'theme_editor_styles');






// Register custom block patterns
function theme_register_block_patterns() {
    register_block_pattern(
        'theme/custom-heading',
        array(
            'title'       => __('Custom Heading', 'paperx'),
            'description' => __('A block pattern for a custom heading.', 'paperx'),
            'content'     => "
                <!-- wp:heading {\"level\":2,\"className\":\"custom-heading\"} -->
                <h2 class=\"custom-heading\">Custom Heading Text</h2>
                <!-- /wp:heading -->
            ",
            'categories'  => array('text'),
            'keywords'    => array('heading', 'title'),
        )
    );
}
add_action('init', 'theme_register_block_patterns');


function theme_register_block_styles() {
    // Register a custom block style for the heading block
    register_block_style(
        'core/heading', // Block name
        array(
            'name'         => 'theme-custom-heading', // Style name
            'label'        => __('Theme Custom Heading', 'paperx'), // Style label
            'inline_style' => '.wp-block-heading.theme-custom-heading { color: red; }', // CSS styles
        )
    );

    // You can register more block styles for other blocks as needed
}
add_action('init', 'theme_register_block_styles');


function theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'paperx' ),
        'id'            => 'main-sidebar',
        'description'   => __( 'Widgets added here will appear on the main sidebar.', 'paperx' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'theme_widgets_init' );
