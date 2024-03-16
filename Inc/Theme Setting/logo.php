<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


function theme_setting_logo() {
    ?>

    <div class="theme_setting_logo">
        <h2>Logo Setup</h2>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
            <?php wp_nonce_field('theme_logo_action', 'theme_logo_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Upload Logo:</th>
                    <td>
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                        ?>
                        <img class='logo-image' src="<?php echo esc_url($logo_url); ?>" alt="Logo" style="max-width: 200px;">
                        <input type="file" name="website_logo" id="website_logo_input" />
                        <label for="website_logo_input" class="upload-logo-btn">Choose Logo</label>
                        <input type="submit" class="button button-secondary remove-logo-btn" name="remove_logo" value="Remove Logo">
                    </td>
                    
                </tr>
                <p style="font-size: 12px; color: #666; margin-top: 5px;">Recommended size: 525px by 175px</p>

                <tr valign="top">
                    <th scope="row">Site Name:</th>
                    <td>
                        <input type="text" name="site_name" value="<?php echo esc_attr(get_bloginfo('name')); ?>" />
                    </td>
                </tr>
            </table>
            <input type="hidden" name="action" value="theme_logo_action">
            <?php submit_button('Save Changes'); ?>
        </form>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('#website_logo_input').change(function() {
                var input = $(this)[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.logo-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
    <?php
}

// Handle logo upload and site name update
function handle_logo_upload() {
    if (!isset($_POST['theme_logo_nonce']) || !wp_verify_nonce($_POST['theme_logo_nonce'], 'theme_logo_action')) {
        wp_die('Security check');
    }

    if (!current_user_can('manage_options')) {
        wp_die('Permission denied');
    }

    // Update site name
    if (isset($_POST['site_name'])) {
        update_option('blogname', sanitize_text_field($_POST['site_name']));
    }

    // Handle logo removal
    if (isset($_POST['remove_logo'])) {
        remove_theme_mod('custom_logo');
    }

    // Handle logo upload
    if (!empty($_FILES['website_logo']['tmp_name'])) {
        $uploaded_file = wp_handle_upload($_FILES['website_logo'], array('test_form' => false));
        if ($uploaded_file && !isset($uploaded_file['error'])) {
            $attachment_id = wp_insert_attachment(array(
                'post_mime_type' => $uploaded_file['type'],
                'post_title' => sanitize_file_name($_FILES['website_logo']['name']),
                'post_content' => '',
                'post_status' => 'inherit'
            ), $uploaded_file['file']);

            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $uploaded_file['file']);
            wp_update_attachment_metadata($attachment_id, $attachment_data);

            set_theme_mod('custom_logo', $attachment_id);
        }
    }

    wp_redirect(admin_url('admin.php?page=theme-options'));
    exit();
}
add_action('admin_post_theme_logo_action', 'handle_logo_upload');
?>
