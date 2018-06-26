<?php
/**
 * Template Name: Landing
 *
 * @package Acumenship
 */

while ( have_posts() ) : the_post();

	get_template_part( 'elementor_landing/landing-page', 'page' );

endwhile; // End of the loop.