<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wapuula
 */
?>

<section class="error-404 not-found">
	 <header class="page-header">
		<figure class="img-404"></figure>
	</header> <!-- .page-header -->
	<div class="page-content">
		<h2 class="page-title"><?php esc_html_e( 'Page Not Found', 'wapu' ); ?></h2>
		<p><?php esc_html_e( 'Map where your photos were taken and discover local points of interest.
There’s also a flip-out.', 'wapu' ); ?></p>
		<a href="<?php echo home_url( '/' ); ?>" class="btn btn-primary large-button"><?php
			esc_html_e( 'Go Home', 'wapu' )
		?></a>
	</div><!-- .page-content -->
</section><!-- .error-404 -->