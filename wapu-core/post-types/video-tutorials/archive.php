<?php
/**
 * How To archive page
 */

wapu_core_popup()->init();

/**
 * Show page title
 */
do_action( 'wapu_core/' . wapu_core_video_tutorials()->slug . '/archive/page_title' );

?>
<div class="row">
	<?php
		while ( have_posts() ) :
			the_post();
			?>
				<div class="col-xl-4 col-md-6 col-sm-12">
					<div class="wapu-video-item">
						<?php echo wapu_core_video_tutorials()->loop_video(); ?>
						<h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						<div class="short_description"><?php
							if( has_excerpt() ){
								the_excerpt();
							} 
						?></div>
					</div>
				</div>
			<?php
		endwhile;
	?>
</div>
<?php