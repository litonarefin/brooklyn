<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'brooklyn' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'brooklyn' ) . '</span> <span class="nav-title">%title</span>',
							)
						);

						get_template_part( 'template-parts/author','bio' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

                </div>

                <div class="col-md-4">
                	<?php get_sidebar('blog-sidebar');?>
                </div>
            </div>
        </div>
    </div><!-- /.padding -->
</section><!-- /.blog-posts -->

<?php get_footer();
