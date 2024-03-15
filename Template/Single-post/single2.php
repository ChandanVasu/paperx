<div class="post-content-single2">
    <!-- breadcrumb-inner.php -->
    <ul class="breadcrumb-single2">
        <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
        <li><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></li>
    </ul>
    
    <h1 class="post-title-single2"><?php the_title(); ?></h1>
    
    <?php if (has_excerpt()) : ?>
        <div class="post-excerpt-single2">
            <?php the_excerpt(); ?>
        </div>
    <?php endif; ?>

    <div class='author-and-shear-single2'>
        <div class='author-and-shear-single2-author'><?php get_template_part('Template/author-info'); ?></div>
        <div class='author-and-shear-single2-share'><?php get_template_part('Template/post-share-social-media'); ?> </div>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnailss-single2">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>
    
    <div class="post-content-single2">
        <?php the_content(); ?>
    </div>

    <div class='post-tag-single-two'>
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 36 36"><path fill="currentColor" d="M31.87 10h-5.55l1-4.83A1 1 0 0 0 26.35 4h-2a1 1 0 0 0-1 .78L22.33 10h-5.4l1-4.83A1 1 0 0 0 17 4h-2a1 1 0 0 0-1 .78L13 10H7a1 1 0 0 0-1 .8l-.41 2a1 1 0 0 0 1 1.2h5.55l-1.64 8h-6a1 1 0 0 0-1 .8l-.41 2a1 1 0 0 0 1 1.2h5.59l-1 4.83a1 1 0 0 0 1 1.17h2a1 1 0 0 0 .95-.78L13.67 26h5.4l-1 4.83A1 1 0 0 0 19 32h2a1 1 0 0 0 1-.78L23.05 26h6a1 1 0 0 0 1-.8l.4-2a1 1 0 0 0-1-1.2h-5.58l1.63-8h6a1 1 0 0 0 1-.8l.41-2a1 1 0 0 0-1.04-1.2m-12 12h-5.4l1.64-8h5.4Z"/></svg>  
        <span>Tag - </span>        
        <?php
            $posttags = get_the_tags();
            if ($posttags) {
                foreach($posttags as $tag) {
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . $tag->name . '</a>, '; 
                }
            }
        ?>
    </div>
    
    <?php
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</div>

<div class="sidebar">
    <?php get_sidebar(); ?>
</div>
