<?php get_header( 'themes' ); ?>
	<div class="download-header">
		<?php wapu_breadcrumbs(); ?>
		<div class="container">
			<?php the_title( '<h1 class="download-title">', '</h1>' ); ?>
			<?php wapu_core()->edd->single->render_nav_links(); ?>
		</div>
	</div>
	<?php wp_enqueue_script( 'wapu-core' ); ?>
	<div class="download-content">
		<div class="site-content_wrap container">
			<div class="row">
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
				<div class="col-md-4">
					<aside class="downloads-content-box">
						<div class="download-single-price">
							<?php wapu_core()->edd->single->price_label(); ?>
							<?php
								add_filter( 'edd_currency_decimal_count', '__return_zero' );
								edd_price( get_the_ID(), true );
								remove_filter( 'edd_currency_decimal_count', '__return_zero' );
							?>
							<div class="download-single-price__features"><?php
								wapu_core()->edd->single->price_features( 'download-single-price__features-item' );
							?></div>
						</div>
						<button class="download-add-to-cart" data-download="<?php echo get_the_ID(); ?>">
							Add to Cart
						</button>
						<?php wapu_core()->edd->single->price_notes(); ?>
					</aside>
					<aside class="downloads-content-box">
						<div class="downloads-single-sales downloads-single-stats-row"><?php
							wapu_core()->edd->single->sales(
								'<i class="nc-icon-mini shopping_cart-simple"></i> <span>%s</span> Sales'
							);
						?></div>
						<div class="downloads-single-rating"><?php
							wapu_core()->edd->single->rating();
						?></div>
					</aside>
					<aside class="downloads-content-box">
						<div class="download-terms-row">
							<div class="download-terms-row__title">Created</div>
							<div class="download-terms-row__items"><time><?php the_date( 'd F y' ); ?></time></div>
						</div>
						<?php wapu_core()->edd->single->terms(); ?>
					</aside>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
<?php get_footer( 'main' ); ?>