<?php
/**
 * Template Name: Themes
 *
 * @package Acumenship
 */

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content-page', 'page' );

endwhile; // End of the loop.
