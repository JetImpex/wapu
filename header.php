<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wapuula
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wapu' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="header-container__flex">
				<div class="site-branding"><?php
					wapu_header_logo();
					wapu_site_description();
				?></div><!-- .site-branding -->
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php
						wapu_nav_menu(
							'primary',
							'<nav id="site-navigation" class="main-navigation" role="navigation">%s</nav>',
							true
						);
					?>
				<?php endif; ?>
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<?php
						wapu_nav_menu(
							'social',
							'<div id="social-list" class="social-list social-list--header">%s</div>',
							true
						);
					?>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php if ( wapu_is_header_sidebar_visible() ) : ?>
	<div class="header-area-wrap">
		<div class="container"><?php
			do_action( 'wapu_render_widget_area', 'header' );
		?></div>
	</div>
	<?php endif; ?>

	<div id="content" class="site-content">
