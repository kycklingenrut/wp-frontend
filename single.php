<?php
get_header();?>

<?php get_template_part('inc/section', 'content');?>

<?php if (comments_open() || get_comments_number()):
    comments_template();
endif;?>

<?php
get_footer();
?>