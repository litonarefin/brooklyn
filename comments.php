<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Brooklyn
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
		<h2 class="comments-title">
			<?php
			$brooklyn_comment_count = get_comments_number();
			if ( '1' === $brooklyn_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'brooklyn' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $brooklyn_comment_count, 'comments title', 'brooklyn' ) ),
					number_format_i18n( $brooklyn_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
                wp_list_comments( array(
                    'style'       => 'li',
                    'short_ping'  => true,
                    'max_depth'   => 20,
                    'callback' 	  => 'brooklyn_comment',
                    'avatar_size' => 90
                ) );
                paginate_comments_links();
            ?>			
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'brooklyn' ); ?></p>
			<?php
		endif;

	} // Check for have_comments().
	?>

	<div class="respond">
		<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$fields =  array(
				'author' => '<input id="author" class="form-control col mr-2" name="author" type="text" placeholder="' . esc_html__('Name', 'brooklyn') . '" value="" size="30"' . $aria_req . '/>',
				'email'  => '<input id="email" class="form-control col ml-2" name="email" type="email" placeholder="' . esc_html__('E-Mail (required)', 'brooklyn') . '" value="" size="30"' . $aria_req . '/>',
				'url'  => '<input id="url" class="form-control" name="url" type="url" placeholder="' . esc_html__('Website', 'brooklyn') . '" value="">'
			);

			$comments_args = array(
				'fields' =>  $fields,
				'id_form'          			=> 'commentform',
				'class_form'          		=> 'comment-form',
				'title_reply'       		=> esc_html__( 'Post a Comment', 'brooklyn' ),
				'title_reply_to'    		=> esc_html__( 'Post a Comment to %s', 'brooklyn' ),
				'cancel_reply_link' 		=> esc_html__( 'Cancel Comment', 'brooklyn' ),
				'label_submit'      		=> esc_html__( 'Post Comment', 'brooklyn' ),
				'class_submit'      		=> 'btn',
				'comment_notes_before'      => '',
				'comment_notes_after' 		=> '',
				'id_submit'					=> 'submit',
				'comment_field'             => '<textarea id="comment" class="form-control" name="comment" placeholder="' . esc_html__(' Write your comment here', 'brooklyn') . '" cols="40" rows="10" required></textarea>',
				'label_submit'              => esc_html__( 'Post Comment' , 'brooklyn' )
				);


			ob_start();
			comment_form( $comments_args);
		?>

	</div> <!-- respond -->

</div><!-- #comments -->
