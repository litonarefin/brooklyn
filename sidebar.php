<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Brooklyn
 */

if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
	return;
}
?>

<aside class="sidebar">
	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside><!-- #secondary -->
