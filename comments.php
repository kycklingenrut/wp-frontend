<?php

$comment_author = "Name";
$comment_email = "Email";
$comment_url = "Website";
$comment_cookies = ' By commenting you accept the Privacy Policy';

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
        'cookies' => '<div class="form-check my-3"><input type="checkbox" required class="form-check-input" id="privacy-policy"><label class="form-check-label" for="privacy-policy">' . $comment_cookies . '</label></div></div>',
    ),

    // Change the title of send button
    'label_submit' => __($comment_send),
    // Change the title of the reply section
    'title_reply' => __($comment_title),
    // Remove "Text or HTML to be displayed after the set of comment fields".
    'class_container' => 'container col-sm-8 mt-3',
    // 'class_form' => 'form-group',
    // 'comment_notes_before' => '<h3 class="comments-title">',
    // 'comment_notes_after' => '</h3>',
    // Redefine your own textarea (the comment body).
    'comment_field' => '<div class="form-group">
    <label for="exampleFormControlTextarea1">Your Thoughts?</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>',
    'submit_button' => '<button type="submit" class="btn post-btn">Send</button>',
    'submit_field' => '<div class="form-submit d-flex justify-content-end my-2">%1$s %2$s</div>',
);
comment_form($comments_args);