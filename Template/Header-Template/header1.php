<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('vasutheme-header1-body'); ?>>

<header class="vasutheme-header1">
    <div class="container vasutheme-header1-container">
        <div class="logo vasutheme-header1-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="vasutheme-header1-logo-link"><?php bloginfo('name'); ?></a>
            <?php endif; ?>
        </div>



        <div class="header1-search-box">
        <?php get_search_form(); ?>

        </div>

        <nav class="primary-menu vasutheme-header1-menu">

            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => false,
                'menu_class' => 'primary-menu vasutheme-header1-menu-list',
                'fallback_cb' => false,
            ));
            ?>
        </nav>

        

        <div class='vasu-theme-mobile-menu-header-1'>
            <div onclick="callhamber()" class='search-svg-for-mobile'>
            <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 12 12"><path fill="black" d="M5 1a4 4 0 1 0 2.248 7.31l2.472 2.47a.75.75 0 1 0 1.06-1.06L8.31 7.248A4 4 0 0 0 5 1M2.5 5a2.5 2.5 0 1 1 5 0a2.5 2.5 0 0 1-5 0"/></svg>
            </div>
        <?php get_template_part('Template/Header-Template/Header-Part/mobilemenu'); ?>
        
        </div>
    </div>

    <script>
    function callhamber() {
      var menu = document.getElementById('hambermenu-main-contant');
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
  </script>
    
</header>

<main>
