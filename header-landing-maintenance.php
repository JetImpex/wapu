<?php
/**
 * The header for landing-maintenance
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wapuula
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="header-landing-maintenance">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wapu_page_start' ); ?>
<div id="page" class="site">
	<div id="content" class="site-content">