<div class="container">
    <div class="row g-5 justify-content-center">
        <div class="col-md-10">
            <?php

if (have_posts()):
    while (have_posts()):
        the_post();

        if (get_field('newpost-text') != null) {
            $text = get_field('newpost-text');
        }
        if (get_field('newpost-image') != null) {
            $image = get_field('newpost-image');
            $sm_img = $image['sizes']['medium'];
            $img_alt = $image['alt'];
        }

        ?>
            <article class="my-5 home-blogpost rounded">
                <div class="card-body d-flex flex-column">
                    <img src="<?php echo $sm_img; ?>" alt="<?php echo $img_alt; ?>" class="rounded">
                    <div class="single-title border-bottom d-flex my-2 justify-content-center">
                        <h3 class="align-self-center my-2 fw-bold"><?php the_title();?></h3>
                    </div>
                    <div class="card-text"><?php echo $text; ?></div>
                </div>
            </article>
            <div class=" d-flex justify-content-center">
                <button class="btn post-btn" id="go-back">Return to Blog</button>
            </div>
            <?php endwhile;else:endif;?>
        </div>
    </div>
</div>