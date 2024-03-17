<?php get_header(); ?>

<div class="theme-post-grid">

    <div class="el-g-1-grid-container"> <!-- Modified class name -->
        <?php while (have_posts()) : the_post(); ?>

        <?php if (get_post_type() === 'post') : ?> <!-- Check if the current item is a post -->

            <div class="el-g-1-custom-post-item-paperx"> <!-- Modified class name -->
                <div class="el-g-1-post-thumbnail-paperx"> <!-- Modified class name -->
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>

                </div>
                <span class="el-g-2-category-meta-paperx">
                    <?php the_category(', '); ?>
                </span>
                <h2 class="el-g-1-post-title-paperx"><a href="<?php the_permalink(); ?>">
                        <?php echo wp_trim_words(get_the_title(), 10); ?>
                    </a></h2> <!-- Modified class name -->

                <div class="el-g-1-post-content-paperx"> <!-- Modified class name -->
                    <?php echo wp_trim_words(get_the_content(), 20); ?>
                    <a href="<?php the_permalink(); ?>" class="read-more">Read More</a> <!-- Added Read More button -->
                </div>
                <div class="el-g-1-post-meta-paperx"> <!-- Modified class name -->
                    <?php
                                    $author_id = get_the_author_meta('ID');
                                    $author_avatar = get_avatar_url($author_id, ['size' => 32]);
                                    ?>
                    <img class="el-g-1-author-avatar-paperx" src="<?php echo esc_url($author_avatar); ?>"
                        alt="<?php echo esc_attr(get_the_author()); ?>"> <!-- Modified class name -->
                    <a class="el-g-1-name-meta-paperx" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                        <?php the_author(); ?>
                    </a>
                    <span class="el-g-1-date-meta-paperx">
                        <?php echo get_the_date(); ?>
                    </span> <!-- Modified class name -->
                </div>
            </div>

        <?php endif; ?>

        <?php endwhile; ?>
    </div>
    <div class='theme-post-sidebar'>
        <?php get_sidebar(); ?>

    </div>
</div><!-- .grid-container -->


<?php get_footer(); ?>
