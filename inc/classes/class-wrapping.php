<?php
/**
 * Class for template hierarchy.
 *
 * @package    Wapu
 * @subpackage Class
 */

/**
 * This filter hook is executed immediately
 * before WordPress includes the predetermined template file.
 */
add_filter( 'template_include', array( 'Wapu_Wrapping', 'wrap' ), 99 );
add_filter( 'wapu_wrap_base', 'wapu_wrap_base_cpts' );

/**
 * Retrieve the full path to the main template file.
 *
 * @since  1.0.0
 * @return string Path to the file.
 */
function wapu_template_path() {
	return apply_filters( 'wpau_wrapping/main_template', Wapu_Wrapping::$main_template );
}

/**
 * Retrieve the base name of the template file.
 *
 * @since  4.0.0
 * @return string File name.
 */
function wapu_template_base() {
	return Wapu_Wrapping::$base;
}

if ( ! class_exists( 'Wapu_Wrapping' ) ) {

	/**
	 * Class for template hierarchy.
	 * Based on Sage Starter Theme by Roots.
	 *
	 * @author  Cristi Burcă <mail@scribu.net>
	 * @author  Roots
	 * @author  Cherry Team
	 * @link    https://roots.io/sage/
	 * @license http://opensource.org/licenses/MIT
	 * @since   1.0.0
	 */
	class Wapu_Wrapping {

		/**
		 * Stores the full path to the main template file.
		 *
		 * @since 1.0.0
		 * @access public
		 * @var string $main_template Full path to the main template.
		 */
		public static $main_template;

		/**
		 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
		 *
		 * @since 1.0.0
		 * @access public
		 * @var string $base Template name.
		 */
		public static $base;

		/**
		 * Initialize new instance of Wapu_Wrapping class by setting a variable for the $slug (which defaults to base)
		 * and create a new $templates array with the fallback template base.php as the first item.
		 *
		 * @since 1.0.0
		 * @param string $template Default base's file name.
		 */
		public function __construct( $template = 'base.php' ) {
			$this->slug      = basename( $template, '.php' );
			$this->templates = array( $template );

			/**
			 * Check to see if the $base exists (i.e. confirming we're not starting on index.php)
			 * and shift a more specific template to the front of the $templates array.
			 */
			if ( self::$base ) {
				$str = substr( $template, 0, -4 );
				array_unshift( $this->templates, sprintf( $str . '-%s.php', self::$base ) );
			}
		}

		/**
		 * To apply a filter to final $templates array, before returning the full path to the most specific existing base
		 * template via the inbuilt WordPress function locate_template.
		 *
		 * @since 1.0.0
		 */
		public function __toString() {
			$this->templates = apply_filters( 'wapu_wrap_' . $this->slug, $this->templates );
			return locate_template( $this->templates );
		}

		/**
		 * Function that saves the $main_template path
		 * and $base as static variables in Wapu_Wrapping class.
		 *
		 * @since 1.0.0
		 * @param string $main The path of the template to include
		 */
		public static function wrap( $main ) {
			self::$main_template = $main;

			self::$base = basename( self::$main_template, '.php' );

			if ( 'index' == self::$base ) {
				self::$base = false;
			}

			return new Wapu_Wrapping();
		}
	}
}

/**
 * Filters to $templates array, before returning the full path
 * to the most specific existing base template.
 *
 * @since  1.0.0
 * @param  array $templates Set of templates.
 * @return array            Filtered set of templates.
 */
function wapu_wrap_base_cpts( $templates ) {
	$post_type = get_post_type();

	if ( $post_type && ( 'page' !== $post_type ) ) {
		array_unshift( $templates, 'base-' . $post_type . '.php' );
	}

	if ( $post_type && ( 'page' !== $post_type ) && is_singular() ) {
		array_unshift( $templates, 'base-single-' . $post_type . '.php' );
	}

	if ( $post_type && ( 'page' !== $post_type ) && is_post_type_archive() ) {
		array_unshift( $templates, 'base-archive-' . $post_type . '.php' );
	}

	// Return modified array with base-$cpt.php at the front of the queue.
	return $templates;
}
