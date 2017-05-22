<?php
/**
 * Knowledge base archive page
 */

/**
 * Show page title
 */
do_action( 'wapu_core/' . wapu_core_knowldege_base()->slug . '/archive/page_title' );

wapu_core_listing_by_terms( wapu_core_knowldege_base(), array( 'taxonomy' => 'category', 'posts_order' => 'rating' ) );