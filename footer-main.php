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
				<div class="site-info-wrap">
					<?php wapu_footer_logo(); ?>
					<div class="site-info">
						<?php printf( __( 'Copyright &copy; %s. All Rights Reserved', 'wapu' ), date( 'Y' ) ); ?>
					</div><!-- .site-info -->
				</div>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<?php
						wapu_nav_menu(
							'footer',
							'<nav id="footer-navigation" class="footer-navigation" role="navigation">%s</nav>',
							true
						);
					?>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
