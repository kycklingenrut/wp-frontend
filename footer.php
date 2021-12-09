</div>


<footer class="footer d-flex justify-content-center align-items-center">
    <nav id="footer-widget" class="new-widget-area">
        <?php if (function_exists('wpes_search_form')) {
    wpes_search_form(array(
        'wpessid' => 118,
        'search_form_css_class' => 'form-inline my-2 my-lg-0',
        'search_button_css_class' => 'btn post-btn my-2 my-sm-0',
        'search_input_css_class' => 'form-control mr-sm-2',
        'aria_label' => 'Sitewide',
    ));
}
?>
    </nav>
    <?php if (is_active_sidebar('footer-sidebar')): ?>

    <?php custom_sidebar('footer-sidebar');?>

    <?php endif;?>

</footer>
<button class="scrollToTopBtn btn"><i class="fas fa-angle-double-up"></i></button>

<?php wp_footer();?>

</body>

</html>