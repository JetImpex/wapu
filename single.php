<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wapuula
 */

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content-single', get_post_format() );

	the_post_navigation( array(
		'next_text' => '<div class="post-title">%title</div><div class="meta-nav">' . esc_html__( 'Next Post', 'wapu' ) . '</div>',
		'prev_text' => '<div class="post-title">%title</div><div class="meta-nav">' . esc_html__( 'Previous Post', 'wapu' ) . '</div>',
	) );

	// If comments are open or we have at least one comment, load up the comment template.
	
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
