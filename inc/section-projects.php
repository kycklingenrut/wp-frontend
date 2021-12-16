<?php
$blogpost_query = new WP_Query(array('posts_per_page' => -1, 'category_name' => 'projects'));
?>
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 justify-content-center">

        <?php
// The Loop
if ($blogpost_query->have_posts()):
    while ($blogpost_query->have_posts()):
        $blogpost_query->the_post();

        // If image exists, put in variables
        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $sm_img = $image['sizes']['thumbnail'];
            $image_id = $image['ID'];
            $image_alt = $image['alt'];
        } else {
            $image_id = "";
            $image_alt = "";
        }
        // Trim the title
        $trimmed_title = mb_strimwidth(get_the_title(), 0, 25, '...');

        ?>

        <div class="col my-3">
            <div class="sec-proj-cont border rounded shadow-sm p-2">

                <img height="200px" class="card-img-top" <?php acf_responsive_image($image_id, 'full', '640px');?>
                    alt="<?php echo $image_alt; ?>" />
                <div class="px-1 my-2 d-flex flex-column justify-content-center text-center">
                    <h5><?php echo $trimmed_title; ?></h5>
                    <button class="btn post-btn align-self-center" style="max-width:150px"><a
                            href=" <?php the_permalink();?>" class="post-nav-link">Read
                            More</a></button>
                </div>
            </div>
        </div>
        <?php
    endwhile;
else:endif;
?>
    </div>
</div>