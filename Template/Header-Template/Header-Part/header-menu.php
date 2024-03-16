<nav class="paper-header-menu">
  <?php
  wp_nav_menu(array(
    'theme_location' => 'primary-menu',
    'container' => false,
    'menu_class' => 'primary-menu',
    'fallback_cb' => false,
  ));
  ?>
</nav>

<div class='menu-mobile-icon'>
<img onclick="callHamburger()" class="image-menu-close-icon" src="<?php echo esc_url(get_template_directory_uri()); ?>/Assets/Image/close.png" alt="">
  <img class="image-menu-icon" onclick="callHamburger()" src="<?php echo esc_url(get_template_directory_uri()); ?>/Assets/Image/menu.png" alt="">
  <div class="paper-header-menu-mobile">

<div class='search-box-mobile-menu'>
<?php get_search_form(); ?>

</div>

    <nav class="mobile-nav">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'primary-menu',
        'container' => false,
        'menu_class' => 'primary-menu',
        'fallback_cb' => false,
      ));
      ?>
    </nav>
  </div>
</div>


