<?php
/**
 * Theme sidebars configuration
 */

return apply_filters( 'wapu_widget_area_default_settings', array(
	'primary-sidebar' => array(
		'name'           => esc_html__( 'Sidebar', 'wapu' ),
		'description'    => '',
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h6 class="widget-title">',
		'after_title'    => '</h6>',
		'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
		'after_wrapper'  => '</div>',
		'is_global'      => true,
	),
	'blog-sidebar' => array(
		'name'           => esc_html__( 'Blog Sidebar', 'wapu' ),
		'description'    => '',
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h6 class="widget-title">',
		'after_title'    => '</h6>',
		'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
		'after_wrapper'  => '</div>',
		'is_global'      => true,
	),
	'home-header-main' => array(
		'name'           => esc_html__( 'Header Area (main page)', 'wapu' ),
		'description'    => '',
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h5 class="widget-title">',
		'after_title'    => '</h5>',
		'before_wrapper' => '<div id="%1$s-area" %2$s>',
		'after_wrapper'  => '</div>',
		'is_global'      => true,
	),
	'home-header' => array(
		'name'           => esc_html__( 'Header Area (front page)', 'wapu' ),
		'description'    => '',
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h5 class="widget-title">',
		'after_title'    => '</h5>',
		'before_wrapper' => '<div id="%1$s-area" %2$s>',
		'after_wrapper'  => '</div>',
		'is_global'      => true,
	),
	'header' => array(
		'name'           => esc_html__( 'Header Area', 'wapu' ),
		'description'    => '',
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h5 class="widget-title">',
		'after_title'    => '</h5>',
		'before_wrapper' => '<div id="%1$s-area" %2$s>',
		'after_wrapper'  => '</div>',
		'is_global'      => true,
	),
	'footer' => array(
		'name'            => esc_html__( 'Footer Area', 'wapu' ),
		'description'     => '',
		'before_widget'   => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'    => '</aside>',
		'before_title'    => '<h5 class="widget-title">',
		'after_title'     => '</h5>',
		'before_wrapper'  => '<div id="%1$s-area" %2$s>',
		'after_wrapper'   => '</div>',
		'wrapper_classes' => 'container',
		'is_global'       => true,
	),
	'footer-main-head' => array(
		'name'            => esc_html__( 'Footer Area Head (main page)', 'wapu' ),
		'description'     => '',
		'before_widget'   => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'    => '</aside>',
		'before_title'    => '<h5 class="widget-title">',
		'after_title'     => '</h5>',
		'before_wrapper'  => '<div id="%1$s-area" %2$s>',
		'after_wrapper'   => '</div>',
		'wrapper_classes' => 'container',
		'is_global'       => true,
	),
	'footer-main' => array(
		'name'            => esc_html__( 'Footer Area (main page)', 'wapu' ),
		'description'     => '',
		'before_widget'   => '<aside id="%1$s" class="widget %2$s col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">',
		'after_widget'    => '</aside>',
		'before_title'    => '<h6 class="widget-title">',
		'after_title'     => '</h6>',
		'before_wrapper'  => '<div id="%1$s-area" %2$s><div class="row">',
		'after_wrapper'   => '</div></div>',
		'wrapper_classes' => 'container',
		'is_global'       => true,
	),
) );