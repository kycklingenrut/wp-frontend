<?php
// Dynamically add Title for Pages
function myowntheme_theme_support()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'myowntheme_theme_support');

// Custom Excerpt for Frontpage (Strip by chars)
function custom_field_excerpt()
{
    global $post;
    $text = get_field('newpost-text');
    if ('' != $text) {
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = strip_tags($text);
        $text = str_replace(']]>', ']]>', $text);
        $text = preg_replace(array('/\s{2,}|&nbsp;/', '/[\t\n]/'), ' ', $text); // deletes extra whitespace/NBS
        $text_length = strlen($text);
        $excerpt_length = 150; // 100 chars
        $excerpt_more = "...";

        $text = substr($text, 0, $excerpt_length);

        if ($text_length > $excerpt_length) {
            $text .= $excerpt_more;
        }
    }
    return apply_filters('the_excerpt', $text);
}

// Custom excerpt for Blog-Page (Strip by words, don't delete formatting)
function content_excerpt($excerpt_length = 5, $id = false, $echo = true)
{
    global $post;
    $text = get_field('newpost-text');
    if ('' != $text) {
        $text = strip_shortcodes($text);
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
        $excerpt_more = "...";

        if (count($words) > $excerpt_length) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }
    }
    if ($echo) {
        echo apply_filters('the_content', $text);
    } else {
        return $text;
    }

}

// Add Menu-options in WP-admin
function myowntheme_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', 'Main menu location'),
            'footer-menu' => __('Footer Menu', 'Footer menu location'),
        )
    );
}
add_action('init', 'myowntheme_menus');

// Add stylesheets
function myowntheme_register_styles(): void
{
    $mytheme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('myowntheme-bootstrap',
        "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css", array(), "5.1.3");

    wp_enqueue_style('myowntheme-fonts',
        "https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400&family=Voces&display=swap", array());

    wp_enqueue_style('myowntheme-style', get_template_directory_uri() . "/style.css",
        array('myowntheme-bootstrap'), $mytheme_version);

}
add_action('wp_enqueue_scripts', 'myowntheme_register_styles');

// Add javascript
function myowntheme_register_scripts(): void
{

    wp_enqueue_script('myowntheme-bootstrap',
        "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", array(), "5.1.3", true);

    wp_enqueue_script('myowntheme-fontawesome', "https://kit.fontawesome.com/ac3108e79d.js", array(), "",
        true);

    wp_enqueue_script('myowntheme-gsap', "https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js",
        array());

    wp_enqueue_script('myowntheme-script', get_template_directory_uri() . "/assets/js/main.js", array(),
        "1.0", true);

}
add_action('wp_enqueue_scripts', 'myowntheme_register_scripts');

// Hide default title in wp-admin
add_action('admin_head', 'hide_wp_title_input');
function hide_wp_title_input()
{
    $screen = get_current_screen();
    // var_dump($screen);
    if ($screen->id === 'acf-field-group') {
        return;
    }
    if ($screen->id === 'edit-page') {
        return;
    }
    ?>
<style type="text/css">
#titlediv {
    display: none;
}
</style>

<?php
}

// Function for displaying and using ACF as default on posts in WP-admin
add_action('acf/save_post', 'upd_cust_post_title', 20); // fires after ACF
function upd_cust_post_title($post_id)
{
    $post_type = get_post_type($post_id);
    if ($post_type != 'post') {
        return;
    }
    $post_title = get_field('newpost-title', $post_id);
    $post_name = sanitize_title($post_title);
    $post = array(
        'ID' => $post_id,
        'post_name' => $post_name,
        'post_title' => $post_title,

    );
    wp_update_post($post);
}

// add default image setting to ACF image fields
// let's you select a defualt image
add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
function add_default_value_to_image_field($field)
{
    acf_render_field_setting($field, array(
        'label' => 'Default Image',
        'instructions' => 'Appears when creating a new post',
        'type' => 'image',
        'name' => 'default_value',
    ));
}

add_filter('acf/load_value/type=image', 'reset_default_image', 10, 3);
function reset_default_image($value, $post_id, $field)
{
    if (!$value) {
        $value = $field['default_value'];
    }
    return $value;
}

// Register Custom Navigation Walker for Bootstrap-header Functionality
function register_navwalker()
{
    require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

// add filter for Bootstrap5 NavWalker
add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
{
    if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
        if (array_key_exists('data-toggle', $atts)) {
            unset($atts['data-toggle']);
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

// adds custom image-sizes
function add_image_sizes()
{

    add_image_size('fp-projects', 450, 300, true);
    // add_image_size( 'header-medium', 1024, 576, true );
    // add_image_size( 'header-small', 640, 360, true );
}
add_action('after_setup_theme', 'add_image_sizes');

// acf img srcset
function acf_responsive_image($image_id, $image_size, $max_width)
{

    // check the image ID is not blank
    if ($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url($image_id, $image_size);

        // set the srcset with various image sizes
        $image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

        // generate the markup for the responsive image
        echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '"';

    }
}

// Bootstrap pagination
function bootstrap_pagination(\WP_Query$wp_query = null, $echo = true, $params = [])
{
    if (null === $wp_query) {
        global $wp_query;
    }

    $add_args = [];

    //add query (GET) parameters to generated page URLs
    /*if (isset($_GET[ 'sort' ])) {
    $add_args[ 'sort' ] = (string)$_GET[ 'sort' ];
    }*/

    $pages = paginate_links(array_merge([
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
        'show_all' => false,
        'end_size' => 3,
        'mid_size' => 1,
        'prev_next' => true,
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'add_args' => $add_args,
        'add_fragment' => '',
    ], $params)
    );

    if (is_array($pages)) {
        //$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
        $pagination = '<nav aria-label="Page navigation" class="page-nav my-4"><ul class="pagination justify-content-center">';

        foreach ($pages as $page) {
            $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
        }

        $pagination .= '</ul></nav>';

        if ($echo) {
            echo $pagination;
        } else {
            return $pagination;
        }
    }

    return null;
}

// Register Sidebars
function custom_sidebar()
{
    register_sidebar(array(
        'id' => 'footer-sidebar',
        'name' => __('Footer Sidebar', 'text_domain'),
        'description' => __('Appears in the footer section of the site.', 'text_domain'),
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>')
    );

    register_sidebar(array(
        'id' => 'blogpage-sidebar',
        'name' => __('Blogpage Sidebar', 'text_domain'),
        'description' => __('Appears in the right section of the site.', 'text_domain'),
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>')
    );

}
add_action('widgets_init', 'custom_sidebar');

function my_restrict_access()
{
    global $pagenow;

    if (current_user_can('client') && $pagenow == 'post-new.php' && !current_user_can('publish_posts')) {
        wp_redirect(admin_url() . '/edit.php?post_type=page');
    }

}
add_action('admin_init', 'my_restrict_access', 0);

function wpb_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'wpb_move_comment_field_to_bottom');