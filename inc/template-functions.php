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
function brooklyn_read_more(){ 
	$read_more = get_theme_mod( 'brooklyn_read_more_text' );
	if(!empty($read_more)){ ?>
		<a href="<?php the_permalink();?>" class="btn read-more">
			<?php echo wp_specialchars_decode($read_more); ?>
		</a>
	<?php }else{ ?>
	<a href="<?php the_permalink();?>" class="btn read-more">
		<?php echo esc_html__('Read more', 'brooklyn');?>
	</a>
<?php }
}



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


// Navbar Brand Logo
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



// Copyright Text
function brooklyn_copyrights_text(){
    $copyright_text = get_theme_mod( 'copyright_text' );

    if(!empty($copyright_text)){
        echo wp_specialchars_decode( $copyright_text );
    } else {
		/* translators: 1: Theme name, 2: Theme author. */
		printf( __( '&copy; %1$s - %2$s | %3$s', 'brooklyn' ), 
			'Brooklyn', 
			date('Y'), 
			__('All Rights Reserved', 'brooklyn')
		);
    }
}





// Header Top Social
function brooklyn_footer_social(){

    $facebook   = get_theme_mod( 'brooklyn_facebook' );
    $twitter    = get_theme_mod( 'brooklyn_twitter' );
    $skype      = get_theme_mod( 'brooklyn_skype' );
    $instagram  = get_theme_mod( 'brooklyn_instagram' );
    $dribble    = get_theme_mod( 'brooklyn_dribble' );
    $vimeo      = get_theme_mod( 'brooklyn_vimeo' );


    if( $twitter || $skype || $instagram || $dribble || $vimeo || $facebook ) { ?>

        <div class="footer-social">
            <?php if(!empty($facebook)){ ?><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fab fa-facebook"></i></a> <?php } ?>
            <?php if(!empty($twitter)){ ?><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fab fa-twitter"></i></a> <?php } ?>
            <?php if(!empty($skype)){ ?><a href="<?php echo esc_url( $skype ) ; ?>" target="_blank"><i class="fab fa-skype"></i></a> <?php } ?>
            <?php if(!empty($instagram)){ ?><a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fab fa-instagram"></i></a> <?php } ?>
            <?php if(!empty($dribble)){ ?><a href="<?php echo esc_url( $dribble ); ?>" target="_blank"><i class="fab fa-dribbble"></i></a> <?php } ?>
            <?php if(!empty($vimeo)){ ?><a href="<?php echo esc_url( $vimeo ); ?>" target="_blank"><i class="fab fa-vimeo"></i></a> <?php } ?>

        </div>

    <?php }

}



/**
 * Brooklyn Excerpt Length
 * @since Brooklyn 1.0.0
 *
 */
function brooklyn_excerpt_length( $length ) {
	if(!is_admin () ){
		$excerpt_length = absint(get_theme_mod('brooklyn_blog_excerpt'));
		return $excerpt_length;
	}
}
add_filter( 'excerpt_length', 'brooklyn_excerpt_length', 999 );


/**
 * Brooklyn Excerpt More
 * @since Brooklyn 1.0.0
 *
 * @param null
 * @return void
 */
if ( !function_exists('brooklyn_excerpt_more') ) :
function brooklyn_excerpt_more( $more ) {
    if(!is_admin() ){
        return '';
    }
}
endif;
add_filter('excerpt_more', 'brooklyn_excerpt_more');
