<?php
/**
 * display template display 404 page
 */
get_header();

?>
<div class='page_not_found'>

<img src="<?php echo esc_url(get_template_directory_uri()); ?>/Assets/Image/404.png" alt="">
<div class="page-not-found-search-box">
        <?php get_search_form(); ?>

        </div>

        <h1>Back To Home <a href="<?php echo esc_url(home_url('/')); ?>">GO Back</a></h1>

</div>
<?php

get_footer(); ?>