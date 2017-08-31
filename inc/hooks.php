<?php
/**
 * Theme hooks.
 *
 * @package Wapu
 */

// Search placeholder
add_filter( 'cherry_search_placeholder', 'wapu_cherry_search_placeholder' );

// Search thumbnail
add_filter( 'cherry_search_thumbnail_size', 'wapu_search_thumbnail_set_size', 9, 1 );

// Body sidebar class
add_filter( 'body_class', 'wapu_body_sidebar_class' );

// Cherry search info content secondary
add_filter( 'wapu_core/shortcodes/docs_search/messages', 'wapu_core_theme_search_shortcode_messages' );

// Cherry search negative message
add_filter( 'cherry_search-negative_search_message', 'wapu_search_negative_search_message' );

// Department ID related class to body
add_filter( 'body_class', 'wapu_add_blog_id_class' );

// Changes "All categories" text in search-form
add_filter( 'cherry_search-select_placeholder', 'wapu_search_select_placeholder' );

add_filter( 'post_class', 'wapu_post_classes' );

//Adds svg to media library
add_filter('upload_mimes', 'cc_mime_types');

/*
add_filter( 'jet_themes/post_type/required_taxonomies', 'custom_required_taxonomies' );

function custom_required_taxonomies($args) {
	$args['template-category'] = array(
		'name'   => esc_html__( 'Catergory test', 'jet-elements' ),
	);
	return $args;
}*/

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

/**
 * Additional classes for posts.
 *
 * @param  array $classes Default classes.
 * @return array
 */
function wapu_post_classes( $classes ) {

	if ( ! is_singular() ) {
		$classes[] = has_post_thumbnail() ? 'has-thumb' : 'no-thumb';
	}

	return $classes;
}

/**
 * Cherry search negative message
 * @param $array
 * @return $array
 */
function wapu_search_select_placeholder() {
	$select_placeholder = sprintf(
		esc_html__( 'All Categories', 'wapu' )
		);
	return $select_placeholder;
}

/**
 * Add blog ID class
 *
 * @since  1.0.2
 * @return array
 */
function wapu_add_blog_id_class( $classes ) {

	if ( is_multisite() ) {
		$classes[] = 'dept-' . get_current_blog_id();
	}

	return $classes;
}


// Cherry search info content primary
/*add_filter( 'cherry_search_info_content_primary', 'wapu_search_info_content_primary' );
// Cherry search info content secondary
add_filter( 'cherry_search_info_content_secondary', 'wapu_search_info_content_secondary' );
*/

/**
* Cherry search info content primary
 *
 * @param $array
 * @return $array
 */
/*function wapu_search_info_content_primary() {
	$content = sprintf(
		'<p>%1$s <a href="%5$s" target="_blank">%2$s</a> %3$s <a href="%6$s" target="_blank">%4$s</a> %7$s<a href="%9$s" target="_blank"> %8$s</a>.</p>',
		esc_html__( 'Check your spelling & try again. If you still have a question,', 'wapu' ),
		esc_html__( 'submit a ticket', 'wapu' ),
		esc_html__( 'or use a', 'wapu' ),
		esc_html__( 'chat', 'wapu' ),
		esc_url( 'https://support.template-help.com/index.php?/Tickets/Submit' ),
		esc_url( 'http://chat.template-help.com/' ),
		esc_html__( 'or use', 'wapu' ),
		esc_html__( 'knowledge base', 'wapu' ),
		esc_url( 'http://192.168.9.82/2017/4.April/wapu/support/knowledge-base/' )
	);
	return $content;
}*/



/**
* Cherry search info content primary
 *
 * @param $array
 * @return $array
 */
/*function wapu_search_info_content_secondary() {
	$content = sprintf(
		'<p>%1$s <a href="%5$s" target="_blank">%2$s</a> %3$s <a href="%6$s" target="_blank">%4$s</a> %7$s<a href="%9$s" target="_blank"> %8$s</a>.</p>',
		esc_html__( 'Check your spelling & try again. If you still have a question,', 'wapu' ),
		esc_html__( 'submit a ticket', 'wapu' ),
		esc_html__( 'or use a', 'wapu' ),
		esc_html__( 'chat', 'wapu' ),
		esc_url( 'https://support.template-help.com/index.php?/Tickets/Submit' ),
		esc_url( 'http://chat.template-help.com/' ),
		esc_html__( 'or use', 'wapu' ),
		esc_html__( 'knowledge base', 'wapu' ),
		esc_url( 'http://192.168.9.82/2017/4.April/wapu/support/knowledge-base/' )
	);
	return $content;
}*/

/**
 * Cherry search negative message
 * @param $array
 * @return $array
 */
function wapu_search_negative_search_message() {
	$negative_search = sprintf(
		'<p><span class="text_error">%6$s</span> %1$s %3$s <a href="%5$s" target="_blank">%4$s</a>.</p>',
		esc_html__( 'Check your spelling & try again. If you still have a question,', 'wapu' ),
		esc_html__( 'submit a ticket', 'wapu' ),
		esc_html__( 'please use a', 'wapu' ),
		esc_html__( 'knowledge base', 'wapu' ),
		esc_url( home_url( '/support/knowledge-base/' ) ),
		esc_html__( 'Results not found. ', 'wapu' )
		);
	return $negative_search;
}


/**
 * Cherry search placeholder.
 * @param $array
 * @return $array
 */
function wapu_core_theme_search_shortcode_messages( $args ) {
	$args['not-found'] = esc_html__( 'Results not found. Try again.', 'wapu-core' );

	return $args;
}


/**
 * cherry_search_thumbnail_set_size
 *
 * @param $array
 * @return $array
 */
function wapu_search_thumbnail_set_size( $size ){
	return 'search-thumbnail';
}

/**
 * cherry_search_placeholder.
 * @param $array
 * @return $array
 */
function wapu_cherry_search_placeholder( $args ) {
	$args['width'] = 86;
	$args['height'] = 66;
	return $args;
}

/**
 * Adds 'has_sidebar' class to body if required.
 *
 * @param
 * @return
 */
function wapu_body_sidebar_class( $classes ) {

	$layout = wapu_layout_class( 'sidebar' );

	if ( ! empty( $layout ) && is_active_sidebar( 'primary-sidebar' ) ) {
		$classes[] = 'has_sidebar';
	}

	return $classes;
}

add_action( 'wapu_render_widget_area', 'wapu_start_widget_buffer', 0 );
add_action( 'wapu_render_widget_area', 'wapu_flush_widget_buffer', 99 );
add_action( 'wapu_render_widget_area', 'wapu_render_cached_widget', 0 );
add_action( 'wp_ajax_save-widget', 'wapu_clean_widgets_cache', 0 );
add_action( 'wp_ajax_widgets-order', 'wapu_clean_widgets_cache', 0 );

function wapu_clean_widgets_cache() {

	if ( ! is_multisite() ) {
		return;
	}

	if ( ! is_main_site() ) {
		return;
	}

	delete_site_option( 'cahed_footer-main' );
	delete_site_option( 'cahed_footer-main-head' );
}


function wapu_start_widget_buffer( $sidebar ) {

	if ( ! in_array( $sidebar, array( 'footer-main' ) ) ){
		return;
	}

	if ( ! is_multisite() ) {
		return;
	}

	if ( ! is_main_site() ) {
		return;
	}

	ob_start();

}

function wapu_flush_widget_buffer( $sidebar ) {

	if ( ! in_array( $sidebar, array( 'footer-main' ) ) ){
		return;
	}

	if ( ! is_multisite() ) {
		return;
	}

	if ( ! is_main_site() ) {
		return;
	}

	$widget = ob_get_clean();

	echo $widget;

	if ( ! is_user_logged_in() ) {
		return;
	}

	if ( ! get_site_option( 'cahed_' . $sidebar ) ) {
		update_site_option( 'cahed_' . $sidebar, $widget );
	}

}

function wapu_render_cached_widget( $sidebar ) {

	if ( ! in_array( $sidebar, array( 'footer-main' ) ) ){
		return;
	}

	if ( ! is_multisite() ) {
		return;
	}

	if ( is_main_site() ) {
		return;
	}

	$cahed = get_site_option( 'cahed_' . $sidebar );

	if ( $cahed ) {
		wapu_widget_area()->prevent_render( $sidebar );
		echo $cahed;
	}
}


add_action( 'template_include', 'wapu_replace_blog_template', 98 );
add_action( 'wpau_wrapping/main_template', 'wapu_set_blog_main_template' );

function wapu_replace_blog_template( $template ) {

	if ( wapu_need_rewrite() ) {
		$template = locate_template( 'page-templates/pages.php' );
	}

	return $template;

}

function wapu_set_blog_main_template( $template ) {

	if ( wapu_need_rewrite() ) {
		$template = locate_template( 'index.php' );
	}

	return $template;

}
