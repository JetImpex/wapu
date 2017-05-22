<?php
/**
 * Template part for posts pagination.
 *
 * @package Wapu
 */
the_posts_pagination( array(
	'prev_text' => sprintf( '<span>%s</span>', esc_html__( 'Previous', 'wapu' ) ),
	'next_text' => sprintf( '<span>%s</span>', esc_html__( 'Next', 'wapu' ) ),
) );