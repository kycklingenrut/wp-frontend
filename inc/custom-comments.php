<?php
if (!function_exists('custom_comments')):
    function custom_comments($comment, $args, $depth)
{
        ?>

<li <?php comment_class();?> id="li-comment-<?php comment_ID()?>">
    <div class="container col-sm-8 my-2 single-comment">
        <div class="row justify-content-between">
            <div class="col-sm-6 col-lg-8">
                <h5><?php echo get_comment_author() ?></h5>
            </div>
            <div class="col-6 col-md-4 d-flex justify-content-end">
                <p><?php printf( /* translators: 1: date and time(s). */esc_html__('%1$s at %2$s'), get_comment_date(), get_comment_time())?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">

                <p><?php comment_text()?></p>
            </div>
        </div>
    </div>
    <?php
    }
endif;
?>