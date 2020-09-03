<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Brooklyn
 */

get_header();
?>
	<section class="blog-posts">
	    <div class="padding">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-8">
						<?php if ( have_posts() ) { ?>

						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->


						<?php while ( have_posts() ) { the_post(); 
								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );
							
							} } else { 
								get_template_part( 'template-parts/content', 'none' ); 
							}
	                        echo function_exists('brooklyn_pagination') ? brooklyn_pagination() : posts_nav_link(); 
	                    ?>
	                </div>

	                <div class="col-md-4">
	                	<?php get_sidebar('blog-sidebar');?>
	                </div>
	            </div>
	        </div>
	    </div><!-- /.padding -->
	</section><!-- /.blog-posts -->

<?php
get_footer();