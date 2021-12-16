<?php
get_header();?>

<!-- Custom 404-page -->
<div class="container d-flex flex-column align-items-center py-2 my-3">
    <h1>Page not found</h1>
    <button class="btn post-btn" id="go-back"><i class="fas fa-angle-double-left"></i> Go Back</button>
    <div class="container d-flex flex-column align-items-center py-2 my-3">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/moarinc-cat-svg.svg'; ?>" alt="Cat logo"
            class="cat-img align-self-center">
    </div>
</div>
<?php
get_footer();