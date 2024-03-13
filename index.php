<?php get_header(); ?>

<div class="archive-post-grids">

<div class="el-g-1-grid-container"> <!-- Modified class name -->
    <?php while (have_posts()) : the_post(); ?>

    <?php if (get_post_type() === 'post') : ?> <!-- Check if the current item is a post -->
    
    <div class="el-g-1-custom-post-item-vasutheme"> <!-- Modified class name -->
        <div class="el-g-1-post-thumbnail-vasutheme"> <!-- Modified class name -->
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            <span class="el-g-1-category-meta-vasutheme">
                <?php the_category(', '); ?>
            </span> <!-- Modified class name -->
        </div>

        <h2 class="el-g-1-post-title-vasutheme"><a href="<?php the_permalink(); ?>">
                <?php echo wp_trim_words(get_the_title(), 10); ?>
            </a></h2> <!-- Modified class name -->

        <div class="el-g-1-post-content-vasutheme"> <!-- Modified class name -->
            <?php echo wp_trim_words(get_the_content(), 20); ?>
        </div>
        <div class="el-g-1-post-meta-vasutheme"> <!-- Modified class name -->
            <?php
                            $author_id = get_the_author_meta('ID');
                            $author_avatar = get_avatar_url($author_id, ['size' => 32]);
                            ?>
            <img class="el-g-1-author-avatar-vasutheme" src="<?php echo esc_url($author_avatar); ?>"
                alt="<?php echo esc_attr(get_the_author()); ?>"> <!-- Modified class name -->
            <a class="el-g-1-name-meta-vasutheme" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
                <?php the_author(); ?>
            </a>
            <span class="el-g-1-date-meta-vasutheme">
                <?php echo get_the_date(); ?>
            </span> <!-- Modified class name -->
        </div>
    </div>
    
    <?php endif; ?>
    
    <?php endwhile; ?>
</div>

</div><!-- .grid-container -->


<?php get_footer(); ?>