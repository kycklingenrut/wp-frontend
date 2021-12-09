<?php

$blogpost_query = new WP_Query(array('posts_per_page' => 2, 'category_name' => 'blogposts'));

?>

<div class="container px-4 py-5">
    <h2 class="pb-2 border-bottom fp-posts-title">Our Blog</h2>
    <div class="row my-1 py-5">

        <?php
// The Loop
if ($blogpost_query->have_posts()):
    while ($blogpost_query->have_posts()):
        $blogpost_query->the_post();

        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $sm_img = $image['sizes']['medium'];
            $img_alt = $image['alt'];}

        //Grab the excerpt
        $excerpt = custom_field_excerpt();
        //Strip the excerpt of tags
        $stripped_exc = strip_tags($excerpt);
        // var_dump($image);

        $trimmed_title = mb_strimwidth(get_the_title(), 0, 29, '...');
        $post_date = get_the_date('F j, Y');
        ?>


        <div class="col-lg-6">
            <div
                class="row border rounded overflow-hidden flex-md-row shadow-sm position-relative mx-2 my-2 fp-blog-card">
                <div class="col p-3 d-flex flex-column position-static">

                    <small class="mb-1 text-muted"><?php echo $post_date; ?></small>
                    <h5 class=""><?php the_title();?></h5>
                    <p class="card-text mb-auto" id="fp-blog-exc"><?php echo $stripped_exc; ?> </p>
                    <a href="<?php the_permalink();?>">Continue reading</a>
                </div>
                <div class="col px-0 justify-content-end d-none d-lg-flex">
                    <img width="200" height="250" src="<?php echo $sm_img ?>" alt="<?php echo $img_alt ?>"
                        class="fp-blog-img"></img>

                </div>
            </div>
        </div>
        <?php endwhile;
else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.');?></p>
        <?php endif;?>

    </div>
</div>