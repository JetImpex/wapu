<?php
/**
 * Template Name: Coming-soon
 *
 * @package Acumenship
 */

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content-page', 'page' );

endwhile; // End of the loop.
