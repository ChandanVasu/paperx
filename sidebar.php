<aside id="sidebar" class="widget-area" role="complementary">
    <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
        <div class="sidebar-widget">
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
        </div>
    <?php else : ?>
        <div class="sidebar-widget">
            <h3 class="widget-title"><?php esc_html_e( 'Search', 'paperx' ); ?></h3>
            <?php get_search_form(); ?>
        </div>

        <div class="sidebar-widget">
            <h3 class="widget-title"><?php esc_html_e( 'Categories', 'paperx' ); ?></h3>
            <ul>
                <?php
                    wp_list_categories( array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'show_count' => 1,
                        'title_li'   => '',
                        'number'     => 10,
                    ) );
                ?>
            </ul>
        </div>
    <?php endif; ?>
</aside>
