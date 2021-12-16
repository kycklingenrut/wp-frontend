<?php
get_header();
// Save privacy page info into separate variables
$policy_page_title = '';
$policy_page_id = (int) get_option('wp_page_for_privacy_policy');

// If policy page exists, render the content
if ($policy_page_id && get_post_status($policy_page_id) === 'publish') {
    $policy_page_title = get_the_title($policy_page_id);
}
?>
<div class="container">
    <h1 class="mb-5 text-center"><?php echo $policy_page_title; ?></h1><?php

if (have_posts()):
    while (have_posts()): the_post();?>
    <div class="container">
        <div class="text">
            <?php the_content()?>
        </div>
    </div><?php
    endwhile;
endif;
?>
</div>
<?php get_footer();?>