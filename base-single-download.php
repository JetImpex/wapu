<?php get_header( 'themes' ); ?>
	<?php wapu_breadcrumbs(); ?>
	<div class="site-content_wrap container">
		<div class="row">
			<div class="col-md-12">
				<div class="download-header">
					<?php the_title( '<h1 class="download-title">', '</h1>' ); ?>
					<?php wapu_core()->edd->single->render_nav_links(); ?>
				</div>
			</div>
			<div id="primary" class="<?php echo wapu_layout_class( 'content' ); ?>">
				<main id="main" class="site-main" role="main">
					<div class="main__content"><?php
						while ( have_posts() ) {
							the_post();
							wapu_core()->edd->single->get_subpage_template_part();
						}
					?></div>
				</main><!-- #main -->
			</div><!-- #primary -->
			<div class="col-md-4"><?php
				edd_price( get_the_ID(), true );
				echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) );
			?></div>
		</div><!-- .row -->
	</div><!-- .container -->
<?php get_footer( 'main' ); ?>