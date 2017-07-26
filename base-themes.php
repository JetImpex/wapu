<?php get_header('themes'); ?>
	<div class="site-content_wrap container">
		<div class="row">
			<div id="primary" class="<?php echo wapu_layout_class( 'content' ); ?>">
				<main id="main" class="site-main" role="main">
					<div class="main__content">
						<?php include wapu_template_path(); ?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row -->
	</div><!-- .container -->
<?php get_footer('main'); ?>