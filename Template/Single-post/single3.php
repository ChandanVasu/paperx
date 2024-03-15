<?php
/**
 * Template Name: Single Post Style 3
 * Template Post Type: post
 */
?>

<!DOCTYPE html>
<html lang="en">

<body>

    <main>
        <!-- Single post content -->
        <article>
            <h2><?php the_title(); ?></h2>
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnailss">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
        </article>
    </main>
    
</body>
</html>
