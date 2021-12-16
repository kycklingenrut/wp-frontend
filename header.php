<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head();?>
</head>

<body>
    <header>
        <!-- Responsive Navbar -->
        <nav class="navbar navbar-expand-md" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <img src="<?php echo get_template_directory_uri() . '/assets/images/moarinc-logo-svg.svg'; ?>"
                    alt="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
                    aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug');?>">
                    <i class="fas fa-bars"></i>
                </button>

                <?php
wp_nav_menu(
    array(
        'menu' => 'main-menu',
        'menu_class' => 'navbar-nav mr-auto',
        'container' => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id' => 'bs-example-navbar-collapse-1',
        'depth' => 2,
        'theme_location' => 'main-menu',
        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker(),
    )
);
?>

            </div>
        </nav>
    </header>

    <!-- Render different Titles of pages depending on which page it is -->
    <?php if (is_front_page()) {?>
    <div class="main-wrapper"><?php
} else {?>
        <div class="main-wrapper py-5"><?php
}?>

            <div class="container">
                <?php

$projects_title = get_field('projects_title');

// target the correct Post Id to get the blogpage-title
$blogpage_id = 9;
$blogpage_title = get_field("blogpage_title", $blogpage_id);

if (is_page() && !is_front_page()) {?>
                <h1 class="mb-5"><?php echo $projects_title; ?></h1><?php
} else if (is_home()) {?>
                <h1 class="mb-5"><?php echo $blogpage_title; ?></h1><?php
}?>
            </div>