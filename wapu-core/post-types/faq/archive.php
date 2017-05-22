<?php
/**
 * How To archive page
 */

/**
 * Show page title
 */
do_action( 'wapu_core/' . wapu_core_faq()->slug . '/archive/page_title' );

wapu_core_listing_by_terms(
	wapu_core_faq(),
	array(
		'taxonomy'    => 'category',
		'number'      => -1,
		'posts_order' => 'order',
		'posts_args'  => array( 'order' => 'ASC' ),
		'terms_order' => 'order',
		'terms_args'  => array( 'order' => 'ASC' ),
		'terms_start' => wapu_core()->get_template( 'post-types/faq/taxonomy/terms-loop-start.php' ),
		'terms_loop'  => wapu_core()->get_template( 'post-types/faq/taxonomy/terms-loop.php' ),
		'terms_end'   => wapu_core()->get_template( 'post-types/faq/taxonomy/terms-loop-end.php' ),
		'posts_start' => wapu_core()->get_template( 'post-types/faq/taxonomy/loop-start.php' ),
		'posts_loop'  => wapu_core()->get_template( 'post-types/faq/taxonomy/loop.php' ),
		'posts_end'   => wapu_core()->get_template( 'post-types/faq/taxonomy/loop-end.php' ),
	)
);

wp_enqueue_script( 'wapu-core' );
