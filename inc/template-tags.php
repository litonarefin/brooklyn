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
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'brooklyn' ),
			'<span class="author vcard"><a class="url fn n author-name" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		
		$post_avatar = brooklyn_blog_post_author_avatar();

		echo $post_avatar . $byline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

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

        <p><?php esc_html('Pingback:','quote');?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'quote' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
        break;
        default :

        global $post;
        ?>

        <li <?php comment_class('comment parent media'); ?> id="li-comment-<?php comment_ID(); ?>">

            <div class="comment-item">
                <div class="author-avatar media-left">
                    <?php echo get_avatar( $comment, 60,'', '', array('class' => 'author-img rounded-circle')); ?>
                </div><!-- /.author-avatar -->
                <div class="comment-body media-body">
                    <div class="comment-metadata">
                        <span class="name">
                        	<?php comment_author_link(); ?>
                        </span>
                        <span class="quote-btn read-more reply">
                        	<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'quote' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>		
                        	<i class="fa fa-mail-reply"></i>
                        </span>
                        <span class="time">
                            <time datetime="<?php echo get_the_modified_date( 'c' );?>">
                            	<?php echo get_the_date('M j, Y'); ?>
                            	<?php echo esc_html__('at','quote');?> <?php echo get_comment_time(); ?>		
                            </time>
                        </span>
                    </div><!-- /.comment-metadata -->
                    <p class="description">
                        <?php echo get_comment_text(); ?>
                    </p>
                </div><!--/.comment-body-->
            </div><!-- /.comment-item -->

			<div class="btm-brder-single"></div>

            <?php
            break;
            endswitch;
        }

}
