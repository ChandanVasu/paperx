<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>

</style>

<body>



  <img onclick="callhamber()" class="image-menu-icon" src="<?php echo get_template_directory_uri(); ?>/Assets/Image/menu.png" alt="">

  <div class='hambermenu-main-contant' id='hambermenu-main-contant'>
    

<div class='header-under-hamber-menu'><div class="logo vasutheme-header1-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="vasutheme-header1-logo-link"><?php bloginfo('name'); ?></a>
            <?php endif; ?>
        </div>


        <img onclick="callhamber()" class="image-menu-close-icon" src="<?php echo get_template_directory_uri(); ?>/Assets/Image/close.png" alt="">

      
      </div>
<div class="mobile-menu-search-box">
<?php get_search_form(); ?>
</div>
      


    <nav class="vasutheme-hamber-menu">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'primary-menu',
        'container' => false,
        'menu_class' => 'primary-menu vasutheme-header1-menu-list',
        'fallback_cb' => false,
      ));
      ?>
    </nav>
  </div>

  <script>
    function callhamber() {
      var menu = document.getElementById('hambermenu-main-contant');
      menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    }
  </script>
</body>

</html>
