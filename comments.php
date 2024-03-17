<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to vasutheme_comment() which is
 * located in the functions.php file.
 *
 * @package vasutheme
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can customize this section based on your theme's design
    if (have_comments()) :
        ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'o1',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_pagination(array(
            'prev_text' => '<span class="screen-reader-text">' . __('Previous', 'paperx') . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __('Next', 'paperx') . '</span>',
        ));
        ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note.
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'paperx'); ?></p>
        <?php endif; ?>
        <?php
// Define aria_req variable
$aria_req = ( $req ? ' aria-required="true"' : '' );
?>

<?php
// Comment form
comment_form(array(
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( '', 'paperx' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" placeholder="Your comment here..."></textarea></p>',
    
    'fields' => array(
        'author' => '<div class="comment-form-author-email"><p class="comment-form-author">' . '<label for="author">' . __( '', 'paperx' ) . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="Your Name" /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __( '', 'paperx' ) . '</label> ' .
                    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="Your Email" /></p></div>'
    ),
));
?>


</div><!-- #comments -->

