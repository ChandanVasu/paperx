<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/Assets/Styles/Paper.css">


</head>

<body>
    <div class='vasu_theme_setting_admin_menu'>

        <div class='vasu_theme_setting_admin_menu_body'>
            <div class="admin_menu_sidebar">


                <h1 id="theme_setting_header">Header</h1>
                <h1 id="register_theme_logo_submenu">Logo</h1>
                <h1 id="theme_setting_footer">Footer</h1>
                <h1 id="theme_setting_single_post">Single Post</h1>
                <h1 id="theme_setting_archive">Archive Post</h1>
                <a href="<?php echo esc_url(home_url('wp-admin/themes.php?page=one-click-demo-import')); ?>">
                    <h1 id="import_demo">Import Demo</h1></a>
                <a href="<?php echo esc_url(home_url('wp-admin/themes.php?page=tgmpa-install-plugins')); ?>">
                    <h1 id="install_plugin">Install Plugin</h1>
                </a>




            </div>

            <div class='admin_menu_template_area'>
                <div class="theme-setting-defult " id="theme_setting_header_content">
                    <?php theme_setting_header(); custom_color_settings_page() ?>
                </div>
                <div class="theme-setting" id="theme_setting_single_post_content">
                    <?php theme_setting_single_post() ?>
                </div>
                <div class="theme-setting" id="theme_setting_logo_content">
                    <?php theme_setting_logo() ?>
                </div>
                <div class="theme-setting" id="theme_setting_footer_content">
                    <?php theme_setting_footer() ?>

                </div>

                <div class="theme-setting" id="theme_setting_archive_content">
                    <?php theme_setting_archive() ?>

                </div>

            </div>


        </div>

        <!-- <embed src="https://vasuthemeime.com/email/index.html" type="" width="100%" height="600px" > -->



    </div>



</body>

<script>
    document.getElementById("theme_setting_header").addEventListener("click", function () {
        document.getElementById("theme_setting_header_content").style.display = "block";
        document.getElementById("theme_setting_single_post_content").style.display = "none";
        document.getElementById("theme_setting_logo_content").style.display = "none";
        document.getElementById("theme_setting_footer_content").style.display = "none";
        document.getElementById("theme_setting_archive_content").style.display = "none";



        document.getElementById("theme_setting_header").style.color = "blue";
        document.getElementById("theme_setting_single_post").style.color = "black";
        document.getElementById("register_theme_logo_submenu").style.color = "black";
        document.getElementById("theme_setting_footer").style.color = "black";
        document.getElementById("theme_setting_archive").style.color = "black";








    });
    document.getElementById("theme_setting_single_post").addEventListener("click", function () {
        document.getElementById("theme_setting_header_content").style.display = "none";
        document.getElementById("theme_setting_single_post_content").style.display = "block";
        document.getElementById("theme_setting_logo_content").style.display = "none";
        document.getElementById("theme_setting_footer_content").style.display = "none";
        document.getElementById("theme_setting_archive_content").style.display = "none";


        document.getElementById("theme_setting_header").style.color = "black";
        document.getElementById("theme_setting_single_post").style.color = "blue";
        document.getElementById("register_theme_logo_submenu").style.color = "black";
        document.getElementById("theme_setting_footer").style.color = "black";
        document.getElementById("theme_setting_archive").style.color = "black";




    });
    document.getElementById("register_theme_logo_submenu").addEventListener("click", function () {
        document.getElementById("theme_setting_header_content").style.display = "none";
        document.getElementById("theme_setting_single_post_content").style.display = "none";
        document.getElementById("theme_setting_logo_content").style.display = "block";
        document.getElementById("theme_setting_footer_content").style.display = "none";
        document.getElementById("theme_setting_archive_content").style.display = "none";


        document.getElementById("theme_setting_header").style.color = "black";
        document.getElementById("theme_setting_single_post").style.color = "black";
        document.getElementById("register_theme_logo_submenu").style.color = "blue";
        document.getElementById("theme_setting_footer").style.color = "black";
        document.getElementById("theme_setting_archive").style.color = "black";




    });
    document.getElementById("theme_setting_footer").addEventListener("click", function () {
        document.getElementById("theme_setting_header_content").style.display = "none";
        document.getElementById("theme_setting_single_post_content").style.display = "none";
        document.getElementById("theme_setting_logo_content").style.display = "none";
        document.getElementById("theme_setting_footer_content").style.display = "block";
        document.getElementById("theme_setting_archive_content").style.display = "none";


        document.getElementById("theme_setting_header").style.color = "black";
        document.getElementById("theme_setting_single_post").style.color = "black";
        document.getElementById("register_theme_logo_submenu").style.color = "black";
        document.getElementById("theme_setting_footer").style.color = "blue";
        document.getElementById("theme_setting_archive").style.color = "black";





    });


    document.getElementById("theme_setting_archive").addEventListener("click", function () {
        // Hide other sections and display the archive settings content
        document.getElementById("theme_setting_header_content").style.display = "none";
        document.getElementById("theme_setting_single_post_content").style.display = "none";
        document.getElementById("theme_setting_logo_content").style.display = "none";
        document.getElementById("theme_setting_footer_content").style.display = "none";
        document.getElementById("theme_setting_archive_content").style.display = "block";

        // Update colors to indicate the active section
        document.getElementById("theme_setting_header").style.color = "black";
        document.getElementById("theme_setting_single_post").style.color = "black";
        document.getElementById("register_theme_logo_submenu").style.color = "black";
        document.getElementById("theme_setting_footer").style.color = "black";
        document.getElementById("theme_setting_archive").style.color = "blue";
    });

</script>

</html>