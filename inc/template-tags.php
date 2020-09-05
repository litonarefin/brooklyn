<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Brooklyn
 */

if ( ! function_exists( 'brooklyn_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function brooklyn_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'brooklyn' ),
			'<i class="icon-calendar icons"></i> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'brooklyn_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function brooklyn_posted_by() {
		echo sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'brooklyn' ),
			'<span class="author vcard"><a class="url fn n author-name" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'brooklyn_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function brooklyn_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			echo '<div class="entry-meta">';
				brooklyn_posted_on();
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'brooklyn' ) );
				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links"><i class="icon-tag icons"></i> ' . esc_html__( ' %1$s', 'brooklyn' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'brooklyn' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links"><i class="icon-tag icons"></i> ' . esc_html__( ' %1$s', 'brooklyn' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}

				if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
					echo '<span class="comments-link"><i class="icon-bubbles icons"></i> ';
					comments_popup_link( esc_html__( 'Leave a Comment', 'brooklyn' ), esc_html__( '1 Comment', 'brooklyn' ), esc_html__( '% Comments', 'brooklyn' ) );
					echo '</span>';
				}

				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'brooklyn' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);

			echo '</div>';
		}


	}
endif;

if ( ! function_exists( 'brooklyn_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function brooklyn_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


// Author Avatar
if ( ! function_exists( 'brooklyn_blog_post_author_avatar' ) ) {
	function brooklyn_blog_post_author_avatar(){
		echo '<div class="author-meta">';
		echo get_avatar( get_the_author_meta('user_email'), 60,'', '', array('class' => 'author-img rounded-circle'));
		brooklyn_posted_by();
		echo '</div>';
	}
}

// Comments Numbers
if ( ! function_exists( 'brooklyn_comments_number' ) ) {
	function brooklyn_comments_number(){
		comments_number( esc_html__('0 Comment','brooklyn'), esc_html__('1 Comment','brooklyn'), esc_html__('% Comments','brooklyn') );
	}
}





/*===================================================================================
 * Brooklyn Comments
 * =================================================================================*/

if(!function_exists('brooklyn_comment')){

    function brooklyn_comment($comment, $args, $depth){

        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

        <p><?php esc_html('Pingback:','brooklyn');?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'brooklyn' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
        break;
        default :

        global $post;
        ?>

        <li <?php comment_class('comment parent'); ?> id="li-comment-<?php comment_ID(); ?>">


	        <div class="comment-body media">
				
				<?php echo get_avatar( $comment, 60,'', '', array('class' => 'rounded-circle author-avatar')); ?>

	            <div class="comment-content media-body">
	                
	                <span class="name">
	                	<?php comment_author_link(); ?>
	                </span>
                    <span class="time">
                        <time datetime="<?php echo get_the_modified_date( 'c' );?>">
                        	<?php echo get_the_date('M j, Y'); ?>
                        	<?php echo esc_html__('at','brooklyn');?> <?php echo get_comment_time(); ?>		
                        </time>
                    </span>
	                <p>
	                    <?php echo get_comment_text(); ?>
	                </p>
	                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'brooklyn' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	            </div><!-- /.comment-content -->
	        </div><!--/.comment-body-->


            <?php
            break;
            endswitch;
        }

}



// Add Class on Comment Reply Link
add_filter('comment_reply_link', 'brooklyn_comments_reply_link_class');

function brooklyn_comments_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='btn reply-btn", $class);
    return $class;
}




/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function brooklyn_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Adds sanitization callback function: Number
 *  @since Brooklyn 1.0.0
 */
if (!function_exists('brooklyn_sanitize_number')) :
    function brooklyn_sanitize_number($input)
    {
        if (isset($input) && is_numeric($input)) {
            return $input;
        }
    }
endif;

/**
 * Sanitize selection
 *
 *  @since Brooklyn 1.0.0
 */
if (!function_exists('brooklyn_sanitize_select')) :
    function brooklyn_sanitize_select($input, $setting)
    {
        // Ensure input is a slug.
        $input = sanitize_key($input);
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control($setting->id)->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
endif;