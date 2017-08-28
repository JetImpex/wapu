<?php get_header('pages'); ?>
	<?php
		if ( wapu_need_rewrite() ) {
			wapu_breadcrumbs();
		}
	?>
	<div class="site-content_wrap container">
		<div class="row">
			<div id="primary" class="<?php echo wapu_layout_class( 'content' ); ?>">
				<main id="main" class="site-main" role="main">
					<div class="main__content">
						<?php include wapu_template_path(); ?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php
				if ( wapu_need_rewrite() ) {
					get_sidebar();
				}
			?>
		</div><!-- .row -->
	</div><!-- .container -->
<?php get_footer(); ?>