<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wapuula
 */
$layout = wapu_layout_class( 'sidebar' );

if ( ! $layout ) {
	return;
}

?>

<aside class="widget-area <?php echo $layout; ?>">
	<?php
		if ( ( is_single() || is_archive() || is_home() ) && 'post' === get_post_type() ) {
			do_action( 'wapu_render_widget_area', 'blog-sidebar' );
		} else {
			do_action( 'wapu_render_widget_area', 'primary-sidebar' );
		}
	?>
</aside><!-- #secondary -->
