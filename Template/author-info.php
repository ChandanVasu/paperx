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


<style>
    .author-name-last-updated .author-name a {
        font-family: 'Batangas';
        font-size: 15px;
        color: black;
        text-decoration: underline;
        text-decoration-color: red;
    }

    .author-name-last-updated .author-name a:hover {
        color: rgb(225, 9, 9);

    }

    .author-info {
        font-family: 'Batangas';
        color: rgb(80, 80, 80);
        display: flex;
        gap: 10px;
    }

    .author-info p {
        margin: 0;
        font-size: 13px;
    }

    .author-info img {
        border: 2px dotted black;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .author-info img:hover {
        border: 2px dotted rgb(255, 0, 0);

    }
</style>