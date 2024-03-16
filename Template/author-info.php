<!-- author-info.php -->
<div class="author-info">
    <div class="author-avatar">
        <?php echo get_avatar(get_the_author_meta('ID'), 64); ?>
    </div>
    <div class="author-name-last-updated">
        <p class="author-name">Posted by - <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <?php the_author(); ?>
            </a></p>
        <p>Last updated:
            <?php the_modified_time('F j, Y g:i A'); ?>
        </p>
    </div>
</div>

