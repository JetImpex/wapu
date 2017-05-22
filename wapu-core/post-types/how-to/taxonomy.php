<?php
/**
 * Taxonomy archive
 */

global $wp_query;

$object   = get_queried_object();
$taxonomy = $object->taxonomy;

do_action( 'wapu_core/taxonomy/' . $taxonomy . '/loop_start', $taxonomy );

while ( have_posts() ) {

	the_post();

	do_action( 'wapu_core/taxonomy/' . $taxonomy . '/loop', $taxonomy );
}

do_action( 'wapu_core/taxonomy/' . $taxonomy . '/loop_end', $taxonomy );
