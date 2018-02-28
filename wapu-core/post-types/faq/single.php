<?php
/**
 * The template for displaying all single posts
 */

while ( have_posts() ) : the_post();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content"><?php
			the_title( '<h1 class="entry-title">', '</h1>' );

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wapu-core' ),
				'after'  => '</div>',
			) );

		?></div><!-- .entry-content -->
		<footer class="entry-footer"><?php
			/**
			 * This is required for like/dislike button!
			 */
			do_action( 'wapu_core/handlers/post_rating/show' );
		?></footer>
	</article><!-- #post-## -->

<?php

endwhile; // End of the loop.
