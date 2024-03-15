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
<style>
    /* CSS styles */
    .theme_setting_archive {
        margin-top: 20px !important;
    }

    .theme_setting_archive .form-table {
        border-collapse: separate !important;
        border-spacing: 10px !important;
    }

    .theme_setting_archive .form-table th,
    .theme_setting_archive .form-table td {
        padding: 10px !important;
    }

    .theme_setting_archive label {
        display: inline-block !important;
        position: relative !important;
        border: 2px solid transparent !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        cursor: pointer !important;
    }

    .theme_setting_archive label:hover {
        border-color: #ccc !important;
    }

    .theme_setting_archive label .radio-image {
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

    .theme_setting_archive .radio-container {
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
                            <input type="radio" name="archive_template" value="<?php echo $value; ?>" <?php
                                checked(get_option('archive_template'), $value ); ?>>
                            <img class="radio-image" src="<?php echo $data[1]; ?>" alt="<?php echo $data[0]; ?>">
                        </label>
                        <p>
                            <?php echo $data[0]; ?>
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
