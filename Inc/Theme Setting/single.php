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


<div class="theme_setting_single_post">
    <h2>Single Post Setup</h2>

    <form method="post" action="options.php">
        <?php settings_fields('single_post_setup_group'); ?>
        <?php do_settings_sections('single_post_setup_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Single Post PaperXTemplate :</th>
                <td>
                    <input type="text" name="single_post_elementor_shortcode"
                        value="<?php echo esc_attr(get_option('single_post_elementor_shortcode')); ?>"
                        placeholder="Inter PaperXTemplate ID" />
                    <p class="description">Enter the PaperXTemplate shortcode for the single post here.</p>
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