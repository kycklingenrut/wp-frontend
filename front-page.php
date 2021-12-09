<?php

$projects_query = new WP_Query(array('posts_per_page' => 3, 'category_name' => 'projects'));

$posttitle = get_field('post-title');
$posttext = get_field('post-text');
get_header();?>

<?php get_template_part('inc/fp', 'header');?>


<!-- Show newest posts -->
<?php get_template_part('inc/fp', 'blogposts');?>


<?php get_template_part('inc/fp', 'languages');?>

<?php get_template_part('inc/fp', 'projects');?>

<?php
get_footer();