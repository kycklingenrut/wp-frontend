<?php
get_header();?>

<!-- Get section-content -->
<?php get_template_part('inc/section', 'content');?>
<!-- Get comments, if comments exist -->
<?php if (comments_open() || get_comments_number()):
    comments_template();
endif;?>

<?php
get_footer();
?>