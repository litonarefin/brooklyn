<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Brooklyn
 */

?>


    <footer class="site-footer text-center">
        <div class="container">
            
            <?php brooklyn_footer_social();?>

            <div class="copyright">
                
                <?php brooklyn_copyrights_text();?>

				<?php printf( esc_html__( 'Developed by %1$s', 'brooklyn' ), '<a href="' . esc_url( __('https://master-addons.com/', 'brooklyn')) . '" rel="nofollow">Master Addons</a>' ); ?>
            </div><!-- /.copyright -->
        </div>
    </footer><!-- /.site-footer -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
