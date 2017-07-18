<?php
/**
 * The template for displaying the footer-main
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wapuula
 */

?>
	</div><!-- #content -->

	<div class="footer-area-wrap invert">
		<?php do_action( 'wapu_render_widget_area', 'footer-main-head' ); ?>
		<?php do_action( 'wapu_render_widget_area', 'footer-main' ); ?>
	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="footer-conatiner__flex">
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<?php
						wapu_nav_menu(
							'footer',
							'<nav id="footer-navigation" class="footer-navigation" role="navigation">%s</nav>',
							true
						);
					?>
				<?php endif; ?>
				<div class="site-info">
					<span class="sep"> &copy; </span>
					<?php printf( esc_html__( '2017 Jetimpex', 'wapu' ), 'wapu' ); ?>
				</div><!-- .site-info -->
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
