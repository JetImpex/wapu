<?php get_header('landing'); ?>
	<div class="site-content_wrap container__fluid">
		<div class="row">
			<div id="primary" class="<?php echo wapu_layout_class( 'content' ); ?> col-sm-12">
				<main id="main" class="site-main" role="main">
					<div class="landing__content">
						<?php include wapu_template_path(); ?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row -->
	</div><!-- .container -->
<?php get_footer('landing'); ?>