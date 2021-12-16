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
        ?>
            <article class="my-5 home-blogpost rounded">
                <div class="card-body d-flex flex-column">
                    <div class="single-title border-bottom d-flex my-2 justify-content-center">
                        <h3 class="align-self-center my-2 fw-bold"><?php the_title();?></h3>
                    </div>
                    <div class="card-text"><?php echo content_excerpt(500); ?></div>
                    <div class="d-flex justify-content-end">
                        <button class="btn post-btn"><a href="<?php the_permalink();?>" class="post-nav-link">To
                                Post</a></button>
                    </div>
                </div>
            </article>

            <?php endwhile;else:endif;?>
        </div>
    </div>
</div>