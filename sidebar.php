<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wapuula
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}

$layout = wapu_layout_class( 'sidebar' );

if ( ! $layout ) {
	return;
}

?>

<aside class="widget-area <?php echo $layout; ?>">
	<?php do_action( 'wapu_render_widget_area', 'primary-sidebar' ); ?>
</aside><!-- #secondary -->
