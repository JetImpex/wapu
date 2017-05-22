<?php
/**
 * Base page structure.
 *
 * @package Monstroid2
 */
?>
<?php get_header(); ?>
	<?php wapu_breadcrumbs(); ?>
	<div class="site-content_wrap container">
		<div class="row">
			<div id="primary" class="<?php echo wapu_layout_class( 'content' ); ?>">
				<main id="main" class="site-main" role="main">
					<?php include wapu_template_path(); ?>
				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); // Loads the sidebar.php template.  ?>
		</div><!-- .row -->
	</div><!-- .container -->
<?php get_footer(); ?>
