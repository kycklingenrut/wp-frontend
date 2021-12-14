<?php
get_header();
?>

<?php if (have_posts()): get_template_part('inc/section', 'search');

else: ?>
<div class="container d-flex flex-column align-items-center text-center py-2 my-3">
    <h3>No Posts matched your search, try searching for something else</h3>
    <button class="btn post-btn" id="go-back"><i class="fas fa-angle-double-left"></i> Go Back</button>
    <div class="container d-flex flex-column align-items-center py-2 my-3">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/moarinc-cat-svg.svg'; ?>" alt="Cat logo"
            class="cat-img align-self-center">
    </div>
</div>
<?php
endif;

get_footer();
?>