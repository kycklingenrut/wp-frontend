<?php
$blogpost_query = new WP_Query(array('posts_per_page' => -1, 'category_name' => 'projects'));
?>




<!-- <div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">


            <div class="col-lg-4 mb-3 d-flex align-items-stretch">
                <div class="card shadow-sm">
                    <img src=""></img>
                    <div class="card-body">
                        <h6 class="mb-0"></h6>
                        <p class="card-text"></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> -->

<!-- <section class="d-flex justify-content-center align-items-center h-100">
    <div class="container">
        <div class="row gy-2">



            <div class="col-lg-3 col-md-4">
                <div class="box bg-primary h-100 d-flex p-4 flex-column">
                    <img src="" alt="">
                    <h5 class="card-title"></h5>
                    <p class="proj-card-text"></p>
                    <div class="card-footer"></div>

                </div>
            </div>


        </div>
    </div>

</section> -->


<div class="card-deck">
    <?php
// The Loop
if ($blogpost_query->have_posts()):
    while ($blogpost_query->have_posts()):
        $blogpost_query->the_post();
        $image = get_field('newpost-image');
        $sm_img = $image['sizes']['medium'];

//Grab the excerpt
        $excerpt = custom_field_excerpt();
//Strip the excerpt of tags
        $stripped_exc = strip_tags($excerpt);

        $trimmed_title = mb_strimwidth(get_the_title(), 0, 29, '...');
        ?>
    <div class="card">
        <img class="card-img-top" src="<?php echo $sm_img; ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?php echo $trimmed_title; ?></h5>
            <p class="card-text"><?php echo $stripped_exc; ?></p>
        </div>
        <div class="card-footer">
            <small class="text-muted"><a href="#" class="btn btn-dark rm-btn">Read More</a></small>
        </div>
    </div>
    <?php
    endwhile;
else:endif;
?>
</div>