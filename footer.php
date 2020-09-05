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
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-behance"></i></a>
            </div><!-- /.footer-social -->

            <div class="copyright">
                
                <!--  -->
                <?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( __( '&copy; %1$s - %2$s | %3$s', 'brooklyn' ), 
						'Brooklyn', 
						date('Y'), 
						__('All Rights Reserved', 'brooklyn')
					);
				?>

				<?php printf( esc_html__( 'Developed by %1$s', 'brooklyn' ), '<a href="' . esc_url( __('https://master-addons.com/', 'brooklyn')) . '" rel="nofollow">Master Addons</a>' ); ?>
            </div><!-- /.copyright -->
        </div>
    </footer><!-- /.site-footer -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
