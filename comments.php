<?php

// Comment-form arguments and html
$comment_author = "Name";
$comment_email = "Email";
$comment_url = "Website";
$comment_cookies = ' By commenting you accept the ';

$comment_send = "Send";
$comment_title = "Write a Comment";

$comments_args = array(

    'fields' => array(
        //Author field
        'author' => '<div class="form-row"><div class="comment-form-author form-group my-2">
        <label for="author">Name *</label></br>
        <input id="author" name="author" aria-required="true" placeholder="' . $comment_author . '"></input>
        </div>',
        //Email Field
        'email' => '<div class="comment-form-email form-group my-2"><label for="email">Email *</label></br>
        <input id="email" name="email" placeholder="' . $comment_email . '"></input></div>',
        //URL Field
        'url' => '<div class="comment-form-url form-group my-2"><label for="url">Website</label></br>
        <input id="url" name="url" placeholder="' . $comment_url . '"></input></div>',
        //Cookies
        'cookies' => '<div class="form-check my-3"><input type="checkbox" required class="form-check-input" id="privacy-policy"><label class="form-check-label" for="privacy-policy">' . $comment_cookies . '<a href="' . get_privacy_policy_url() . '" target="_blank">Privacy Policy</a></label></div></div>',
    ),

    // Change the title of send button
    'label_submit' => __($comment_send),
    // Change the title of the reply section
    'title_reply' => __($comment_title),
    // Remove "Text or HTML to be displayed after the set of comment fields".
    'class_container' => 'container col-sm-8 mt-3 mb-4',
    // Redefine your own textarea (the comment body).
    'comment_field' => '<div class="form-group">
    <label for="exampleFormControlTextarea1">Your Thoughts?</label>
    <textarea class="form-control" id="comment" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea></div>',
    // Change of classes for submit-button
    'submit_button' => '<button type="submit" id="submit" class="btn post-btn submit">Send</button>',
    // Change wrapper for button
    'submit_field' => '<div class="form-submit d-flex justify-content-end my-2">%1$s %2$s</div>',

);
comment_form($comments_args);

// If comments exists, run wp_list_comments with helper function
if (have_comments()):

?>
<div class="container">
    <h3 class="container col-sm-8 my-2">Latest comments</h3>
    <ul class="post-comments">
        <?php
wp_list_comments(array(
    'style' => 'ul',
    'short_ping' => true,
    'reverse_top_level' => true,
    'callback' => 'custom_comments',
));
?>
    </ul>

    <!-- If there are more than three comments, paginate the comments -->
    <div class="container col-6 col-md-3 col-lg-2 d-flex justify-content-center comments-pagination">
        <?php paginate_comments_links();
?>

    </div>
</div><?php
endif;?>