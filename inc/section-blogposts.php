<div class="container">
    <?php
//Protect against arbitrary paged values
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$args = array(
    'posts_per_page' => 4,
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
            $image_id = $image['ID'];
            $image_alt = $image['alt'];
        } else {
            $image_id = "";
            $image_alt = "";
        }
        // Put Post-title in variable
        $blogpost_title = get_field('newpost-title');
        // Put Post-date in variable
        $post_date = get_the_date('l F j, Y');

        // Filters the excerpt
        $text = content_excerpt(100, false, false);
        // Strips escerpt of tags to avoid broken html
        $stripped_exc = strip_tags($text);

        ?>
            <article class="home-blogpost my-2">
                <div class="card-body d-flex flex-column">
                    <img class="my_class" <?php acf_responsive_image($image_id, 'full', '640px');?>
                        alt="<?php echo $image_alt; ?>" />
                    <div class="d-flex justify-content-end">
                        <small class="my-2 px-1 text-muted"><?php echo $post_date; ?></small>
                    </div>
                    <h3 class="card-title"><?php echo $blogpost_title; ?></h3>
                    <div class="card-text card-text-post">
                        <?php echo $stripped_exc; ?></div>
                    <div class="d-flex justify-content-end">
                        <button class="btn post-btn"><a href="<?php the_permalink();?>" class="post-nav-link">To
                                Post</a></button>
                    </div>
                </div>
            </article>
            <?php endwhile;?>
        </div>

        <div class="col col-md-4 d-flex flex-column rounded">
            <!-- Render the widgets -->
            <?php
    the_widget('WP_Widget_Recent_Posts');
    the_widget('WP_Widget_Archives');
    the_widget('WP_Widget_Categories');
    the_widget('WP_Widget_Tag_Cloud');

    // If sidebar is active, output it
    if (is_active_sidebar('blogpage-sidebar')):
        custom_sidebar('blogpage-sidebar');?>
        </div>

        <!-- Render the bootstrap navigation-function -->
        <?php
        echo bootstrap_pagination($blogpost_blog_query);
        ?>

        <?php else: ?>
        <?php _e('Sorry, no posts matched your criteria.');?>
        <?php endif;?>
        <?php endif;?>
    </div>
</div>
</div>