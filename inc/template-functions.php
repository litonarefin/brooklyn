<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Brooklyn
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function brooklyn_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'brooklyn_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function brooklyn_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'brooklyn_pingback_header' );


// Read More
function brooklyn_read_more(){ ?>
	<a href="<?php the_permalink();?>" class="btn read-more">
		<?php echo esc_html__('Read more', 'brooklyn');?>
	</a>
<?php }





/**
 * Returns Custom Blog Posts Pagination
 * @author Jewel Theme
 * @since v1.0.0
 */

if(!( function_exists('brooklyn_pagination') )){
	function brooklyn_pagination($pages = '', $range = 2){
		global $brooklyn_options;
		$showitems = ($range * 1)+1;

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
				if(!$pages) {
					$pages = 1;
				}
		}

		if(1 != $pages){
			echo '<nav class="page-navigation"><ul class="pagination">';

			if($paged > 1 && $paged > $range+1 && $showitems < $pages){
				echo '<li class="page-item"><a href="'.get_pagenum_link(1).'" class="page-link prev"><i class="fa fa-arrow-left"></i> ' . esc_html__('Prev','brooklyn') . '</a></li>';
			}

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<li class='page-item'><a href='#' class='page-link active'>".$i."</a></li>":"<li class='page-item'><a class='page-link' href='".get_pagenum_link($i)."'>".$i."</a></li>";
				}
			}

			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
				echo '<li class="page-item"><a href="'.get_pagenum_link($pages).'" class="page-link next">' . esc_html__('Next','brooklyn') . ' <i class="fa fa-arrow-right"></i></a></li>';
			}


			echo "</ul></nav>";
		}
	}
}





function brooklyn_brand_logo(){ 

    if( function_exists( 'the_custom_logo' ) && has_custom_logo() ){
        the_custom_logo();
    } else{ ?>
        <div class="d-flex flex-column">
            <a class="navbar-brand hidden-xs site-title p-2" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_html(bloginfo( 'name' )); ?> - <?php esc_html(bloginfo( 'description' )); ?>">
                <?php esc_html(bloginfo( 'name' )); ?>
            </a>
            <p class="site-description p-2">
                <?php esc_html(bloginfo( 'description' )); ?>                            
            </p>                    
        </div>
    <?php }

}
