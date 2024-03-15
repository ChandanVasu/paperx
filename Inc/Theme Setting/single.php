<?php

// Includes/Theme Setting/single_post_setup.php

// Check if this file is being accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define the callback function for the sub-menu (Single Post Setup)
function theme_setting_single_post() {
    // Function to display the content of the Single Post Setup submenu page
    ?>
<style>
    /* CSS styles */
    .theme_setting_single_post {
        margin-top: 20px !important;
    }

    .theme_setting_single_post .form-table {
        border-collapse: separate !important;
        border-spacing: 10px !important;
    }

    .theme_setting_single_post .form-table th,
    .theme_setting_single_post .form-table td {
        padding: 10px !important;
    }

    .theme_setting_single_post label {
        display: inline-block !important;
        position: relative !important;
        border: 2px solid transparent !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        cursor: pointer !important;
    }

    .theme_setting_single_post label:hover {
        border-color: #ccc !important;
    }

    /* .theme_setting_single_post input[type="radio"] {
            display: none!important;
        } */

    .theme_setting_single_post label .radio-image {
        background-color: rgba(182, 244, 239, 0.605);
        width: 150px;
        height: 100px;
        border-radius: 5px;
        display: block !important;

    }

    .form-table input.tog,
    .form-table input[type=radio] {
        position: absolute;
        top: 10px;
        /* left: 0; */
        right: 10px;
    }

    .theme_setting_single_post .radio-container {
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
</style>

<div class="theme_setting_single_post">
    <h2>Single Post Setup</h2>

    <form method="post" action="options.php">
        <?php settings_fields('single_post_setup_group'); ?>
        <?php do_settings_sections('single_post_setup_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Single Post vasutheme Template :</th>
                <td>
                    <input type="text" name="single_post_elementor_shortcode"
                        value="<?php echo esc_attr(get_option('single_post_elementor_shortcode')); ?>"
                        placeholder="Inter vasutheme Template ID" />
                    <p class="description">Enter the vasutheme Template shortcode for the single post here.</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Single Post Style:</th>
                <td class="radio-container"> <!-- Add a container for radio buttons -->
                    <?php
                    // Define an array for labels, values, and corresponding image URLs
                    $templates = array(
                        'single1' => array('Single Post',  get_template_directory_uri() . '/Assets/Image/single1.jpg'),
                        // 'single2' => array('Right Side Bar',  get_template_directory_uri() . '/Assets/Image/single2.png'),
                        'Comming Soon' => array('20+ Comming Soon',  get_template_directory_uri() . '/Assets/Image/comming_soon.webp'),
                    );

                    // Loop through each template
                    foreach ($templates as $value => $data) {
                        ?>
                    <div class="radio-item">
                        <label>
                            <input type="radio" name="single_post_template" value="<?php echo esc_attr($value); ?>"
                                <?php checked(get_option('single_post_template'), $value ); ?>>
                            <img class="radio-image" src="<?php echo esc_url($data[1]); ?>"
                                alt="<?php echo esc_attr($data[0]); ?>">
                        </label>
                        <p>
                            <?php echo esc_html($data[0]); ?>
                        </p> <!-- Display the text below the image -->
                    </div>

                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>

<?php
}



// Register Elementor shortcode setting for single post
function register_single_post_elementor_shortcode() {
    register_setting('single_post_setup_group', 'single_post_elementor_shortcode');
    register_setting('single_post_setup_group', 'single_post_template'); // Register single post template setting
}
add_action('admin_init', 'register_single_post_elementor_shortcode');