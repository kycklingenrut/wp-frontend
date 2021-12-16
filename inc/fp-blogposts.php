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

        // If image exists, put it in variables
        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $image_id = $image['ID'];
            $image_alt = $image['alt'];
        } else {
            $image_id = "";
            $image_alt = "";
        }

        //Grab the excerpt
        $excerpt = custom_field_excerpt();
        //Strip the excerpt of tags
        $stripped_exc = strip_tags($excerpt);
        // If title is too long, trim it
        $trimmed_title = mb_strimwidth(get_the_title(), 0, 29, '...');
        // Get the post date
        $post_date = get_the_date('F j, Y');
        ?>


        <div class="col-lg-6">
            <div
                class="row border rounded overflow-hidden flex-md-row shadow-sm position-relative mx-2 my-2 fp-blog-card">
                <div class="col p-3 d-flex flex-column position-static">

                    <small class="mb-1 text-muted"><?php echo $post_date; ?></small>
                    <h5 class=""><?php the_title();?></h5>
                    <p class="card-text mb-auto" id="fp-blog-exc"><?php echo $stripped_exc; ?> </p>
                    <button class="btn post-btn" style="max-width: 100px"><a href="<?php the_permalink();?>"
                            class="post-nav-link">To
                            Post</a></button>
                </div>
                <div class="col px-0 justify-content-end d-none d-lg-flex">

                    <img width="200" height="250" class="fp-blog-img"
                        <?php acf_responsive_image($image_id, 'full', '640px');?> alt="<?php echo $img_alt; ?>" />

                </div>
            </div>
        </div>
        <?php endwhile;
else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.');?></p>
        <?php endif;?>

    </div>
</div>