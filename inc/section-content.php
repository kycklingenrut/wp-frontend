<div class="container">
    <div class="container section-content">
        <div class="row g-5 justify-content-center">
            <div class="col-md-10">
                <div class=" d-flex">
                    <button class="btn post-btn" id="go-back"><i class="fas fa-angle-double-left"></i> Go Back</button>
                </div>
                <?php

if (have_posts()):
    while (have_posts()):
        the_post();

        // If text exists, put it in a variable
        if (get_field('newpost-text') != null) {
            $text = get_field('newpost-text');
        }

        // If image exists, put it in variables
        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $image_id = $image['ID'];
            $image_alt = $image['alt'];
        } else {
            $image_id = "";
            $image_alt = "";
        }
        ?>
                <article class="my-5 home-blogpost rounded">
                    <div class="card-body d-flex flex-column">
                        <img class="rounded" <?php acf_responsive_image($image_id, 'full', '640px');?>
                            alt="<?php echo $image_alt; ?>" />
                        <div class="single-title border-bottom d-flex my-2 justify-content-center">
                            <h3 class="align-self-center my-2 fw-bold"><?php the_title();?></h3>
                        </div>
                        <div class="card-text"><?php echo $text; ?></div>
                    </div>
                </article>
                <?php endwhile;else:endif;?>
            </div>
        </div>
    </div>
</div>