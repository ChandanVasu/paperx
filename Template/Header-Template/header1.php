<header class="vasutheme-header1">
    <div class="vasutheme-header1-container">
        <div class="logo vasutheme-header1-logo">
            <?php if (has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
            <?php else: ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="vasutheme-header1-logo-link">
                <?php bloginfo('name'); ?>
            </a>
            <?php endif; ?>
        </div>



        <div class="header1-search-box">
            <?php get_search_form(); ?>

        </div>

        <?php get_template_part('Template/Header-Template\Header-Part/nav-menu'); ?>

</header>