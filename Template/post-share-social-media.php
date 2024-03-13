<!-- post-share-social-media.php -->
<div class="post-share-social-media">
    <ul class="social-media-icons">
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"
                rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"
                target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a></li>
        <li><a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"
                target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a></li>
        <li><a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php the_title(); ?>"
                target="_blank" rel="noopener noreferrer"><i class="fab fa-pinterest"></i></a></li>
        <!-- Add more social media share links as needed -->
        <li><a href="javascript:void(0);" onclick="window.print()"><i class="fas fa-print"></i></a></li>
    </ul>
</div>

<style>
    


    @media print {

        body *,
        .author-and-shear-single1 {
            visibility: hidden;
        }

        .singlepost1-vasutheme,
        .singlepost1-vasutheme * {
            visibility: visible;
        }

        .singlepost1-vasutheme {
            position: absolute;
            left: 0;
            top: 0;
        }
    }


</style>