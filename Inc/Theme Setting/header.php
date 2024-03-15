<?php
// Includes/Theme Setting/single_post_setup.php

// Check if this file is being accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define the callback function for the sub-menu (Header Setting)
function theme_setting_header() {
    // Function to display the content of the Header Setting page
    ?>
    <style>
        /* CSS styles */
        .theme_header_setting {
            margin-top: 20px !important;
        }

        .theme_header_setting .form-table {
            border-collapse: separate !important;
            border-spacing: 10px !important;
        }

        .theme_header_setting .form-table th,
        .theme_header_setting .form-table td {
            padding: 10px !important;
        }

        .theme_header_setting .form-table td .radio-item{
            margin-right: 20px;
            display: inline-flex;
            gap : 20px;
            align-items: center;
            justify-content: center;
            text-align: center;         
        }

        .theme_header_setting .radio-item label {
            display: inline-block !important;
            position: relative !important;
            border: 2px solid transparent !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            cursor: pointer !important;
        }

        .theme_header_setting .radio-item label:hover {
            /* border-color: #ccc !important; */
        }

        .theme_header_setting .radio-item label .radio-image {
            width: 150px;
            height: 100px;
            border-radius: 5px;
            /* display: block !important; */
        }

        .form-table input.tog,
        .form-table input[type=radio] {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .theme_header_setting .radio-container {
            display: flex;
            gap: 20px;
        }

        .radio-item {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
            border-radius: 5px;
            padding: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .radio-item p {
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-weight: 600;
            font-size: 15px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        .switch input:checked+.slider:before {
    -webkit-transform: translate3d(20px, -50%, 0);
    transform: translate3d(20px, -0%, 0);
}

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>


    <div class="theme_header_setting">
        <h2>Header Settings</h2>

        <form method="post" action="options.php">
            <?php settings_fields('header_setup_group'); ?>
            <?php do_settings_sections('header_setup_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Header vasutheme Template:</th>
                    <td>
                        <input type="text" name="header_shortcode" value="<?php echo esc_attr(get_option('header_shortcode')); ?>"
                            placeholder="Inter vasutheme Template ID" />
                        <p class="description">Enter the Header vasutheme Template shortcode for the Header.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"> Header Template:</th>
                    <td>
                        <?php
                        // Define the selected template
                        $selected_template = get_option('header_selected');
                        
                        // Define an array for template options with images
                        $template_options = array(
                            'header1' => array('Header 1', get_template_directory_uri() . '/Assets/Image/header.png'),
                            // 'header2' => array('Header 2',  get_template_directory_uri() . '/Assets/Image/header.png'),
                            'Comming Soon' => array('20+ Comming Soon',  get_template_directory_uri() . '/Assets/Image/comming_soon.webp'),
                        );
                        
                        // Loop through each template option
                        foreach ($template_options as $template_key => $template_data) {
                            ?>
                            <div class="radio-item">
                            <label>
                                <input type="radio" name="header_selected" value="<?php echo esc_attr($template_key); ?>" <?php checked($selected_template,                             $template_key); ?>>
                                <img class="radio-image" src="<?php echo esc_url($template_data[1]); ?>" alt="<?php echo esc_attr($template_data[0]); ?>">
                                <p><?php echo esc_html($template_data[0]); ?></p>
                            </label>

                            </div>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <h2>Sticky Header Settings</h2>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Sticky Header:</th>
                    <td>
                        <?php
                          $sticky_header_enabled = get_option('sticky_header_enabled');
                        ?>
                        <label class="switch">
                            <input type="checkbox" name="sticky_header_enabled" value="1" <?php checked(1, $sticky_header_enabled); ?>>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}



function register_header_elementor_shortcode() {
    register_setting('header_setup_group', 'header_shortcode');
    register_setting('header_setup_group', 'header_selected'); // Register single post template setting
    register_setting('header_setup_group', 'sticky_header_enabled'); // Register sticky header setting under the same group
}
add_action('admin_init', 'register_header_elementor_shortcode');


// Output CSS in the header based on the sticky header option value
function add_sticky_header_css() {
    $sticky_header_enabled = get_option('sticky_header_enabled');
    if ($sticky_header_enabled) {
        echo '<style>.header-content-vasutheme { position: sticky; top: 0; z-index: 999; }</style>';
    }
}
add_action('wp_head', 'add_sticky_header_css');
?>


<?php

function custom_color_settings_page() {
    ?>
    <div class="custom_color_settings_page">
        <h2>Custom Colors</h2>
        <form method="post" action="options.php">
            <?php settings_fields('custom-color-settings-group'); ?>
            <?php do_settings_sections('custom-color-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Primary Color</th>
                    <td><input type="color" name="primary_color" value="<?php echo get_option('primary_color'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Secondary Color</th>
                    <td><input type="color" name="secondary_color" value="<?php echo get_option('secondary_color'); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register and initialize settings
function custom_color_settings_init() {
    register_setting(
        'custom-color-settings-group', // Option group
        'primary_color' // Option name
    );

    register_setting(
        'custom-color-settings-group', // Option group
        'secondary_color' // Option name
    );
}
add_action('admin_init', 'custom_color_settings_init');

// Enqueue styles using registered colors
function enqueue_custom_colors() {
    wp_enqueue_style(
        'custom-colors',
        get_template_directory_uri() . '/Assets/Styles/Elementor/main.css'
    );

    wp_add_inline_style('custom-colors', '
        :root {
            --primary-color: ' . get_option('primary_color') . ';
            --secondary-color: ' . get_option('secondary_color') . ';
        }
    ');
}
add_action('wp_head', 'enqueue_custom_colors');
