<?php

if (have_posts()):
    while (have_posts()):
        the_post();
        the_content();
        $text = get_field('newpost-text');

        ?>
<div class="container">
    <h1><?php the_title();?></h1>
    <p><?php echo $text; ?></p>
</div>
<?php endwhile;else:endif;?>