</div>


<footer class="footer">

    <?php
wp_nav_menu(
    array(
        'menu' => 'footer-menu',
        'menu_class' => 'footer-menu',
        'container' => 'div',
        'container_class' => 'footer-wrapper',
        'theme_location' => 'footer-menu')
);

?>

</footer>
<button class="scrollToTopBtn btn"><i class="fas fa-angle-double-up"></i></button>

<?php wp_footer();?>

</body>

</html>