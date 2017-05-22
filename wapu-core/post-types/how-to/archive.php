<?php
/**
 * How To archive page
 */

do_action( 'wapu_core/' . wapu_core_how_to()->slug . '/archive/page_title' );

wapu_core_listing_by_terms( wapu_core_how_to(), array( 'taxonomy' => 'category', 'posts_order' => 'rating' ) );
