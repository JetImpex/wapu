<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wapuula
 */

/**
 * Display the header logo.
 *
 * @since  1.0.0
 * @return void
 */
function wapu_header_logo() {

	$logo     = get_bloginfo( 'name' );
	$logo_url = wapu_get_mod( 'header_logo_url' );

	$format = apply_filters(
		'wapu_header_logo_format',
		'<div class="site-logo"><a class="site-logo__link" href="%1$s" rel="home">%2$s</a></div>'
	);

	if ( is_multisite() ) {
		$home_url = esc_url( network_home_url( '/' ) );
	} else {
		$home_url = esc_url( home_url( '/' ) );
	}

	if ( ! $logo_url ) {
		printf( $format, $home_url, $logo );
		return;
	}

	$retina_logo     = '';
	$logo_url        = wapu_render_theme_url( $logo_url );
	$retina_logo_url = get_theme_mod( 'retina_header_logo_url' );
	$retina_logo_url = wapu_render_theme_url( $retina_logo_url );
	$logo_id         = wapu_get_image_id_by_url( $logo_url );

	if ( $retina_logo_url ) {
		$retina_logo = sprintf( 'srcset="%s 2x"', esc_url( $retina_logo_url ) );
	}

	$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo_id && $logo_src ) {
		$atts = ' width="' . $logo_src[1] . '" height="' . $logo_src[2] . '"';
	} else {
		$atts = '';
	}

	$format_image = apply_filters( 'wapu_header_logo_image_format',
		'<img src="%1$s" alt="%2$s" class="site-link__img" %3$s%4$s>'
	);

	$image = sprintf( $format_image, esc_url( $logo_url ), esc_attr( $logo ), $retina_logo, $atts );

	printf( $format, $home_url, $image );
}

/**
 * Show nav menu by location
 *
 * @param  string $location Location name
 * @return void
 */
function wapu_nav_menu( $location = 'primary', $format = '%s', $toggle = false, $custom_args = array() ) {

	$toggle = '';

	if ( true === $toggle ) {
		$toggle = printf(
			'<button class="menu-toggle" aria-controls="%1$s-menu" aria-expanded="false">%2$s</button>',
			$location,
			esc_html__( 'Menu', 'wapu' )
		);
	}

	$args = wp_parse_args( $custom_args, array(
		'theme_location' => $location,
		'menu_id'        => $location . '-menu',
		'menu_class'     => $location . '-menu',
		'fallback_cb'    => '__return_empty_string',
		'before'  => '<div class="menu-link-wrapper">',
		'after'  => '</div>',
		'echo'           => false,
	) );

	$menu = wp_nav_menu( $args );

	printf( $format, $menu );
}

/**
 * Display the site description.
 *
 * @since  1.0.0
 * @return void
 */
function wapu_site_description() {

	$show_desc = wapu_get_mod( 'show_tagline' );

	if ( ! $show_desc ) {
		return;
	}

	$description = get_bloginfo( 'description', 'display' );
	$description = apply_filters( 'wapu_tagline', $description );

	if ( ! ( $description || is_customize_preview() ) ) {
		return;
	}

	$format = apply_filters( 'wapu_site_description_format', '<div class="site-description">%s</div>' );

	printf( $format, $description );
}

/**
 * Display the breadcrumbs.
 *
 * @return void
 */
function wapu_breadcrumbs() {

	$breadcrumbs_settings = apply_filters( 'wapu_breadcrumbs_settings', array(
		'wrapper_format'    => '<div class="container"><div class="breadcrumbs__title">%1$s</div><div class="breadcrumbs__items">%2$s</div><div class="clear"></div></div>',
		'page_title_format' => '<h5 class="page-title">%s</h5>',
		'show_on_front'     => false,
		'separator'         => '&#124;',
		'path_type'         => 'minified',
		'labels'            => array(
			'browse' => '',
		),
		'css_namespace' => array(
			'module'    => 'breadcrumbs',
			'content'   => 'breadcrumbs__content',
			'wrap'      => 'breadcrumbs__wrap',
			'browse'    => 'breadcrumbs__browse',
			'item'      => 'breadcrumbs__item',
			'separator' => 'breadcrumbs__item-sep',
			'link'      => 'breadcrumbs__item-link',
			'target'    => 'breadcrumbs__item-target',
		)
	) );

	wapu()->get_core()->init_module( 'cherry-breadcrumbs', $breadcrumbs_settings );
	do_action('cherry_breadcrumbs_render');
}

/*
 * Display a link to all posts by an author.
 *
 * @link https://developer.wordpress.org/reference/functions/get_the_author_posts_link
 *
 * @since  1.0.0
 * @param  array $args Arguments.
 * @return string      An HTML link to the author page.
 */
function wapu_get_the_author_posts_link() {

	if ( function_exists( 'get_the_author_posts_link' ) ) {
		return get_the_author_posts_link();
	}

	// This is a fallback code, due to `get_the_author_posts_link` function
	// is available only since WordPress 4.4.0
	ob_start();
	the_author_posts_link();
	$link = ob_get_clean();

	return $link;
}

/**
 * Dispaply box with information about author.
 *
 * @since  1.0.0
 * @return void
 */
function wapu_post_author_bio() {
	get_template_part( 'template-parts/content', 'author-bio' );
}


if ( ! function_exists( 'wapu_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wapu_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'wapu' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$posted_by = sprintf(
		esc_html_x( '%s', 'post author', 'wapu' ),
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);

	echo '<span class="posted-by"><i class="nc-icon-mini users_single-body"></i>' . $posted_by . '</span><span class="posted-on"><i class="nc-icon-mini ui-1_calendar-60"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'wapu_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wapu_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'wapu' ) );
		if ( $categories_list && wapu_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'wapu' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'wapu' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wapu' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'wapu' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'wapu' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'wapu_get_post_category' ) ) :
/**
 * Prints HTML with meta information for the categories.
 */
function wapu_get_post_category() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( '<span>' . esc_html__( ', ', 'wapu' ) . '</span>' );
		if ( $categories_list && wapu_categorized_blog() ) {
			printf( '<div class="post__cats">' . esc_html__( '%1$s', 'wapu' ) . '</div>', $categories_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'wapu_get_post_tags' ) ) :
/**
 * Prints HTML with meta information for the categories.
 */
function wapu_get_post_tags() {
	// Hide category and tag text for pages.
	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'wapu' ) );
	if ( $tags_list ) {
		printf( '<div class="post__tags"><i class="nc-icon-mini shopping_tag-content"></i>' . esc_html__( '%1$s', 'wapu' ) . '</div>', $tags_list ); // WPCS: XSS OK.
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wapu_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wapu_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wapu_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wapu_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wapu_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wapu_categorized_blog.
 */
function wapu_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wapu_categories' );
}
add_action( 'edit_category', 'wapu_category_transient_flusher' );
add_action( 'save_post',     'wapu_category_transient_flusher' );
