<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wapuula
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
		<?php wapu_get_post_category(); ?>

		<div class="content_wrapper">
			<div class="entry-content">
				<?php echo get_the_excerpt(); ?>
			</div><!-- .entry-content -->
			<div class="footer_wrapper">
				<div class="entry-meta">
					<?php
						wapu_entry_meta();
						wapu_get_post_tags();
					?>
				</div><!-- .entry-meta -->
				<?php
					wapu_share_buttons();
				?>
			</div>
			<?php
				wapu()->utility()->attributes->get_button( array(
					'class' => 'btn btn-primary',
					'text'  => esc_html__( 'Read More', 'wapu' ),
					'html'  => '<a href="%1$s" %3$s>%4$s</a>',
					'echo'  => true,
				) );
			?>
		</div>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
