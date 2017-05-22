<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wapuula
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<figure class="post-thumbnail">
		<?php the_post_thumbnail( '__tm-thumb-l', array(
				'class' => 'post-thumbnail__img wp-post-image',
				'alt'   => get_the_title(),
			) );
		?>
		</figure><!-- .post-thumbnail -->
		<?php wapu_get_post_category(); ?>
		<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
		<div class="entry-content">
			<?php wapu()->utility()->attributes->get_content( array(
					'length'       => 32,
					'content_type' => 'post_excerpt',
					'echo'         => true,
				) ); ?>
		</div><!-- .entry-content -->
		<div class="entry-meta">
			<?php 
				wapu_entry_meta(); 
				wapu_get_post_tags(); 
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<?php 
			wapu()->utility()->attributes->get_button( array(
					'class' => 'btn btn-primary',
					'text'  => esc_html__( 'Read More', 'wapu' ),
					'html'  => '<a href="%1$s" %3$s>%4$s</a>',
					'echo'  => true,
				) );
			wapu_share_buttons(); 
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
