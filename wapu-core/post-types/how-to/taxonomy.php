<?php
/**
 * Taxonomy archive
 */

global $wp_query;

$object   = get_queried_object();
$taxonomy = $object->taxonomy;

?>
<div class="wapu_posts_wrap"><?php
?><h2 class="wapu-post__title"><?php echo $object->name; ?></h2><?php

do_action( 'wapu_core/taxonomy/' . $taxonomy . '/loop_start', $taxonomy );

while ( have_posts() ) {

	the_post();

	do_action( 'wapu_core/taxonomy/' . $taxonomy . '/loop', $taxonomy );
}

do_action( 'wapu_core/taxonomy/' . $taxonomy . '/loop_end', $taxonomy );
?></div>
