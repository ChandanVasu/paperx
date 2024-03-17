<?php
// Includes/Theme Setting/footer_setup.php

// Check if this file is being accessed directly
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define the callback function for the sub-menu (Footer Setup)
function theme_setting_footer() {
    // Function to display the content of the Footer Setup submenu page
    ?>
    <div class="theme_setting_footer">
        <h2>Footer Setup</h2>
        <form method="post" action="options.php">
            <?php settings_fields('footer_setup_group'); ?>
            <?php do_settings_sections('footer_setup_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Footer PaperXTemplate:</th>
                    <td><input type="text" name="footer_elementor_shortcode" value="<?php echo esc_attr(get_option('footer_elementor_shortcode')); ?>" placeholder="Enter Elementor shortcode" />
                        <p class="description">Enter the PaperXTemplate shortcode to display the footer content.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Copyright Text:</th>
                    <td><input type="text" name="footer_copyright_text" value="<?php echo esc_attr(get_option('footer_copyright_text')); ?>" placeholder="Enter copyright text" />
                        <p class="description">Enter the copyright text to be displayed in the footer.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

    <?php
}

function register_footer_elementor_shortcode() {
    register_setting('footer_setup_group', 'footer_elementor_shortcode');
    register_setting('footer_setup_group', 'footer_copyright_text'); // Register copyright text setting
}
add_action('admin_init', 'register_footer_elementor_shortcode');
