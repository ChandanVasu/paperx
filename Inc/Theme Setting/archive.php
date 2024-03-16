<?php

// Includes/Theme Setting/archive_setup.php

// Check if this file is being accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define the callback function for the sub-menu (Archive Setup)
function theme_setting_archive() {
    // Function to display the content of the Archive Setup submenu page
    ?>


<div class="theme_setting_archive">
    <h2>Archive Setup</h2>

    <form method="post" action="options.php">
        <?php settings_fields('archive_setup_group'); ?>
        <?php do_settings_sections('archive_setup_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Archive Page Template :</th>
                <td>
                    <input type="text" name="archive_elementor_shortcode"
                        value="<?php echo esc_attr(get_option('archive_elementor_shortcode')); ?>"
                        placeholder="Inter Archive Template ID" />
                    <p class="description">Enter the Archive Template shortcode for the archive page here.</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Archive Page Style:</th>
                <td class="radio-container"> <!-- Add a container for radio buttons -->
                    <?php
                    // Define an array for labels, values, and corresponding image URLs
                    $templates = array(
                        'archive1' => array('Archive Style 1',  get_template_directory_uri() . '/Assets/Image/archive1.png'),
                        // 'archive2' => array('Archive Style 2',  get_template_directory_uri() . '/Assets/Image/archive2.png'),
                        'Comming Soon' => array('20+ Comming Soon',  get_template_directory_uri() . '/Assets/Image/comming_soon.webp'),
                    );

                    // Loop through each template
                    foreach ($templates as $value => $data) {
                        ?>
                            <div class="radio-item">
                                    <label>
                                    <input type="radio" name="archive_template" value="<?php echo esc_attr($value); ?>" <?php checked(get_option('archive_template'), $value ); ?>>
                                   <img class="radio-image" src="<?php echo esc_url($data[1]); ?>" alt="<?php echo esc_attr($data[0]); ?>">
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

// Register Elementor shortcode setting for archive page
function register_archive_elementor_shortcode() {
    register_setting('archive_setup_group', 'archive_elementor_shortcode');
    register_setting('archive_setup_group', 'archive_template'); // Register archive template setting
}
add_action('admin_init', 'register_archive_elementor_shortcode');
