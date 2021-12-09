<?php
//Protect against arbitrary paged values
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$args = array(
    'posts_per_page' => 3,
    'category_name' => 'blogposts',
    'paged' => $paged,
);

$blogpost_blog_query = new WP_Query($args);

?>
<div class="row g-5 justify-content-center">
    <div class="col-md-8">
        <?php

// The Loop
if ($blogpost_blog_query->have_posts()):
    while ($blogpost_blog_query->have_posts()):
        $blogpost_blog_query->the_post();

        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $sm_img = $image['sizes']['medium'];
            $img_alt = $image['alt'];}

        $blogpost_title = get_field('newpost-title');
        $blogpost_content = get_field('newpost-text');
        $post_date = get_the_date('l F j, Y');

        $text = get_field('newpost-text');

        ?>
        <article class="home-blogpost my-2">
            <div class="card-body d-flex flex-column">
                <img src="<?php echo $sm_img; ?>" alt="">
                <div class="d-flex justify-content-end">
                    <small class="mb-2 text-muted"><?php echo $post_date; ?></small>
                </div>
                <h3 class="card-title"><?php echo $blogpost_title; ?></h3>
                <div class="card-text card-text-post">
                    <?php echo content_excerpt(100); ?></div>
                <div class="d-flex justify-content-end">
                    <button class="btn post-btn"><a href="<?php the_permalink();?>" class="post-nav-link">To
                            Post</a></button>
                </div>
            </div>
        </article>
        <?php endwhile;?>
        <?php
    echo bootstrap_pagination($blogpost_blog_query);
    ?>

        <?php else: ?>
        <?php _e('Sorry, no posts matched your criteria.');?>
        <?php endif;
?>
    </div>
</div>