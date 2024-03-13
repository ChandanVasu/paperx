<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to paper_comment() which is
 * located in the functions.php file.
 *
 * @package Paper
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
            'prev_text' => '<span class="screen-reader-text">' . __('Previous', 'paper') . '</span>',
            'next_text' => '<span class="screen-reader-text">' . __('Next', 'paper') . '</span>',
        ));
        ?>

    <?php endif; // Check for have_comments(). ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note.
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'paper'); ?></p>
        <?php endif; ?>
        <?php
// Define aria_req variable
$aria_req = ( $req ? ' aria-required="true"' : '' );
?>

<?php
// Comment form
comment_form(array(
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( '', 'domainreference' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" placeholder="Your comment here..."></textarea></p>',
    
    'fields' => array(
        'author' => '<div class="comment-form-author-email"><p class="comment-form-author">' . '<label for="author">' . __( '', 'domainreference' ) . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="Your Name" /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __( '', 'domainreference' ) . '</label> ' .
                    '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="Your Email" /></p></div>'
    ),
));
?>


</div><!-- #comments -->


<style>
    /* Styling comment list */
/* Styling the comment form */
.comment-form {
  margin-top: 20px;
}

/* Styling the input fields */
.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Styling the submit button */
.comment-form input[type="submit"] {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Styling the submit button on hover */
.comment-form input[type="submit"]:hover {
  background-color: #0056b3;
}

/* Styling the comment form labels */
.comment-form label {
  font-weight: bold;
}

/* Styling the comment form required field indicator */
.comment-form span.required {
  color: red;
}
/* Styling the container for name and email fields */
.comment-form-author-email {
  display: flex;
  /* justify-content: space-between; */
  gap: 10px;

}

/* Adjusting width for each input field */
.comment-form-author-email input[type="text"],
.comment-form-author-email input[type="email"] {
  font-family: 'Batangas';
  background-color: transparent;
  border: 0px;
  border-radius: 8px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;

}


/* Styling the comment list */
.comment-list {
  list-style: none;
  padding: 10px;
  /* background-color: #cdcdcd; */
  border-radius: 10px;
}

/* Styling each comment */
.comment {

  padding: 10px 0;
}

/* Styling the comment author image */
.comment .avatar {
  margin-right: 10px;
  border-radius: 50%;
  height: 50px;
  width: 50px;
  object-fit: fill;
}

/* Styling the comment content */
.comment .comment-content {
  flex: 1;
}

/* Styling the comment author name */
.comment .comment-author {
  font-style: normal;

  font-weight: bold;
  font-family: 'Batangas';
  display: flex;
  align-items: center;
}

/* Styling the comment date */
.comment .commentmetadata a {
  float: right;
  font-family: 'Batangas';
  text-decoration: none;
  font-size: 15px;
  color: #000000;
  display: none;
  margin-top: -33px;
}

.comment .commentmetadata{
  display: none;
}

.comment .commentmetadata .comment-edit-link{
  display: none;
}

cite { 
  font-style: normal;
}

.says{
  display: none;
}

.comment-author .fn{
  text-decoration: none;
}

.comment p{
  font-family: 'Batangas';
  margin-left: 56px;
  /* margin-top: -10px; */
}

.comment .reply{
  font-size: 20px;
  text-decoration: none;
  font-family: 'Batangas';
  margin-top: 5px;
margin-left: 50px;
}

.comment-respond .comment-reply-title {
  margin-top: 20px;
  font-family: 'Batangas';

}
.comment .children{
  margin-left: 60px;
}

.comment .comment-body{
  border-radius: 10px;
  /* background-color: #fff; */
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;

  padding: 10px;
}

.comment-respond .comment-notes, .comment-respond .logged-in-as{
  display: block;
  font-family: 'Batangas';
  margin-bottom: 10px;
  margin-top: -14px;
}

.comment-respond .comment-form-cookies-consent {
  display: block;
  font-family: 'Batangas';
  margin-bottom: 10px;
}

/* Styling the comment form placeholder and text font */
.comment-form-comment textarea::placeholder,
.comment-form-comment textarea {
  font-family: 'Batangas';
    font-size: 14px; /* Change the font size as needed */
    color: #666; /* Change the text color as needed */
}

.comment-form-comment textarea {
    /* Additional styling for the comment textarea if required */
    border: 0px;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    padding: 8px;
    background-color: transparent;
    border-radius: 8px;
    width: 100%; /* Adjust the width as needed */
    height: 150px; /* Adjust the height as needed */
    resize: vertical;

}

.comment-form input[type="submit"] {
  background-color: var(--primary-color);
  color: var(--secondary-color);
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.comment-form input[type="submit"]:hover{
  background-color: #fd0000;

}
</style>