<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wapuula
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wapu_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'wapu_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wapu_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wapu_pingback_header' );

/**
 * Returns layot class depends on config and passed context.
 *
 * @param  string $context content or sidebar.
 * @return string|bool
 */
function wapu_layout_class( $context = 'content' ) {

	$layouts = wapu()->get_config( 'layout' );

	if ( empty( $layouts ) ) {
		return false;
	}

	$result = $layouts[0];

	unset( $layouts[0] );

	foreach ( $layouts as $callback => $layout ) {

		if ( ! is_callable( $callback ) ) {
			continue;
		}

		if ( ! empty( $layout['args'] ) ) {
			$is_active = call_user_func_array( $callback, $layout['args'] );
		} else {
			$is_active = call_user_func( $callback );
		}

		if ( $is_active ) {
			$result = $layout;
			break;
		}

	}

	return isset( $result[ $context ] ) ? esc_attr( $result[ $context ] ) : false;
}

/**
 * Replace %s with theme URL.
 *
 * @param  string $url Formatted URL to parse.
 * @return string
 */
function wapu_render_theme_url( $url ) {
	return sprintf( $url, get_template_directory_uri() );
}

/**
 * Get image ID by URL.
 *
 * @param  string $image_src Image URL to search it in database.
 * @return int|bool false
 */
function wapu_get_image_id_by_url( $image_src ) {
	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid = %s";
	$id    = $wpdb->get_var( $wpdb->prepare( $query, esc_url( $image_src ) ) );

	return $id;
}

/**
 * Check if header sidebar is visible on current page
 *
 * @return bool
 */
function wapu_is_header_sidebar_visible() {

	$is_visible = false;

	if ( function_exists( 'wapu_core' )
		&& method_exists( wapu_core(), 'is_core_page' )
		&& wapu_core()->is_core_page() ) {
		$is_visible = true;
	}

	return $is_visible;
}