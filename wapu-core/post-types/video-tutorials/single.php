<?php
/**
 * The template for displaying all single posts
 */

while ( have_posts() ) : the_post();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php
				/*wapu()->utility()->meta_data->get_terms( array(
					'type'      => 'how-to_category',
					'delimiter' => '<span>, </span>',
					'before'    => '<div class="post__cats">',
					'after'     => '</div>',
					'echo'      => true,
				) );*/
			?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-video"><?php
			echo wapu_core_video_tutorials()->get_video();
		?></div>

		<div class="entry-content"><?php

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wapu-core' ),
				'after'  => '</div>',
			) );

		?></div><!-- .entry-content -->
		<?php wapu_get_post_tags(); ?>
		<div class="entry-footer-meta">
			<div class="entry-meta">
				<?php wapu_entry_meta(); ?>
			</div><!-- .entry-meta -->
			<?php
				wapu_share_buttons();
			?>
		</div>
		<div class="wapu-rating-wrapper"><?php
			/**
			 * This is required for like/dislike button!
			 */
			do_action( 'wapu_core/handlers/post_rating/show' );
		?></div><!-- .entry-content -->
	</article><!-- #post-## -->

<?php

endwhile; // End of the loop.
