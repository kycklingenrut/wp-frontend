<?php
$blogpost_query = new WP_Query(array('posts_per_page' => 3, 'category_name' => 'projects'));
?>

<div class="container px-4 py-5 mb-1">
    <h2 class="pb-2 border-bottom">Our Projects</h2>
    <div>
        <div class="row row-cols-1 row-cols-lg-3 my-1 py-5">
            <?php
// The Loop
if ($blogpost_query->have_posts()):
    while ($blogpost_query->have_posts()):
        $blogpost_query->the_post();

        // If image exists, put it in variables
        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $sm_img = $image['sizes']['thumbnail'];
            $image_id = $image['ID'];
            $image_alt = $image['alt'];
        } else {
            $image_id = "";
            $image_alt = "";
        }
        ?>

            <div class="col mb-4">
                <div class="card h-100">
                    <img height="300px" class="fp-proj-img" <?php acf_responsive_image($image_id, 'full', '250px');?>
                        alt="<?php echo $image_alt; ?>" />
                    <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                        <h5 class="card-title"><?php the_title();?></h5>
                        <a href="<?php the_permalink();?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <?php
    endwhile;
else:endif;
?>
        </div>
    </div>
</div>