<?php
/**
 * Wapuula functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wapuula
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Wapu_Theme' ) ) {

	/**
	 * Define Wapu_Theme class
	 */
	class Wapu_Theme {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * A reference to an instance of cherry framework core class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $core = null;

		/**
		 * Holder for current customizer module instance.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $customizer = null;

		/**
		 * Constructor for the class
		 */
		function __construct() {

			add_action( 'after_setup_theme', require( get_template_directory() . '/cherry-framework/setup.php' ), 0 );
			add_action( 'after_setup_theme', array( $this, 'get_core' ), 1 );
			add_action( 'after_setup_theme', array( $this, 'setup' ), 5 );
			add_action( 'after_setup_theme', array( $this, 'load_files' ), 10 );
			add_action( 'after_setup_theme', array( $this, 'init_modules' ), 15 );
			add_action( 'after_setup_theme', array( $this, 'register_sidebars' ), 25 );

			// Overrides the load textdomain function for the 'cherry-framework' domain.
			add_filter( 'override_load_textdomain', array( $this, 'override_load_textdomain' ), 5, 3 );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		}

		/**
		 * Theme setup
		 *
		 * @return void
		 */
		public function setup() {

			$GLOBALS['content_width'] = apply_filters( 'wapu_content_width', 640 );

			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on Wapuula, use a find and replace
			 * to change 'wapu' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'wapu', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );
			$this->set_thumb_sizes();

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( $this->get_config( 'nav-menus' ) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );
		}

		/**
		 * Get theme version
		 *
		 * @return string
		 */
		public function get_version() {
			$theme = wp_get_theme();
			return $theme->get( 'Version' );
		}

		/**
		 * Returns core instance
		 *
		 * @return Cherry_Core
		 */
		public function get_core() {

			/**
			 * Fires before loads the core theme functions.
			 *
			 * @since 1.0.0
			 */
			do_action( 'wapu_core_before' );

			global $chery_core_version;

			if ( null !== $this->core ) {
				return $this->core;
			}

			if ( 0 < sizeof( $chery_core_version ) ) {
				$core_paths = array_values( $chery_core_version );

				require_once( $core_paths[0] );
			} else {
				die( 'Class Cherry_Core not found' );
			}

			$this->core = new Cherry_Core( array(
				'base_dir' => get_template_directory() . '/cherry-framework',
				'base_url' => get_template_directory_uri() . '/cherry-framework',
				'modules'  => array(
					'cherry-js-core' => array(
						'autoload' => true,
					),
					'cherry-ui-elements' => array(
						'autoload' => false,
					),
					'cherry-interface-builder' => array(
						'autoload' => false,
					),
					'cherry-utility' => array(
						'autoload' => true,
						'args'     => array(
							'meta_key' => array(
								'term_thumb' => 'cherry_terms_thumbnails'
							),
						)
					),
					'cherry-widget-factory' => array(
						'autoload' => true,
					),
					'cherry-customizer' => array(
						'autoload' => false,
					),
					'cherry-dynamic-css' => array(
						'autoload' => false,
					),
					'cherry-term-meta' => array(
						'autoload' => false,
					),
					'cherry-post-meta' => array(
						'autoload' => false,
					),
					'cherry-breadcrumbs' => array(
						'autoload' => false,
					),
				),
			) );

			return $this->core;

		}

		/**
		 * Returns utility instance
		 *
		 * @return object
		 */
		function utility() {
			$utility = $this->get_core()->modules['cherry-utility'];
			return $utility->utility;
		}

		/**
		 * Initalize required modules
		 *
		 * @return void
		 */
		public function init_modules() {
			$this->customizer = $this->get_core()->init_module( 'cherry-customizer', wapu_get_customizer_options() );
		}

		/**
		 * Register tehme sidebars
		 *
		 * @return void
		 */
		public function register_sidebars() {
			wapu_widget_area()->widgets_settings = $this->get_config( 'sidebars' );
		}

		/**
		 * Return URL to assets folder
		 *
		 * @return string
		 */
		public function assets_url() {
			return get_template_directory_uri() . '/assets/';
		}

		/**
		 * Register nad enqueue required assets
		 *
		 * @return void
		 */
		public function enqueue_assets() {

			wp_enqueue_style( 'wapu-fonts', $this->fonts_url() );
			wp_enqueue_style( 'wapu-style', get_stylesheet_uri(), false, $this->get_version() );
			wp_enqueue_style( 'nucleo-mini', $this->assets_url() . 'css/nucleo-mini.css' );
			wp_enqueue_style( 'jetimpex', $this->assets_url() . 'css/jetimpex.css' );

			wp_enqueue_script( 'theme-script', $this->assets_url() . 'js/theme-script.js', array(), $this->get_version(), true );
			wp_enqueue_script( 'wapu-navigation', $this->assets_url() . 'js/navigation.js', array(), $this->get_version(), true );
			wp_enqueue_script( 'wapu-skip-link-focus-fix', $this->assets_url() . 'js/skip-link-focus-fix.js', array(), $this->get_version(), true );
			wp_enqueue_script( 'wapu-responsive-menu', $this->assets_url() . 'js/cherry-responsive-menu.js', array(), $this->get_version(), true );
			wp_enqueue_script( 'jquery-totop', $this->assets_url() . 'js/jquery.ui.totop.min.js', array(), $this->get_version(), true );

		}

		/**
		 * Return Google fonts URL
		 *
		 * @return string
		 */
		public function fonts_url() {

			$fonts = $this->get_config( 'fonts' );

			if ( empty( $fonts ) ) {
				return;
			}

			$host     = 'https://fonts.googleapis.com/css';
			$prepared = array();
			$subset   = array();

			foreach ( $fonts as $font ) {

				if ( ! in_array( $font['charset'], $subset ) ) {
					$subset[] = $font['charset'];
				}

				$prepared[] = sprintf( '%1$s:%2$s', $font['family'], $font['styles'] );
			}

			$family = implode( '|', $prepared );
			$subset = implode( ',', $subset );

			return add_query_arg(
				array(
					'family' => urlencode( $family ),
					'subset' => urlencode( $subset ),
				),
				$host
			);
		}

		/**
		 * Load required files
		 *
		 * @return void
		 */
		public function load_files() {

			require get_template_directory() . '/inc/template-tags.php';
			require get_template_directory() . '/inc/extras.php';
			require get_template_directory() . '/inc/customizer.php';
			require get_template_directory() . '/inc/template-meta.php';
			require get_template_directory() . '/inc/hooks.php';

			require get_template_directory() . '/inc/classes/class-widget-area.php';
			require get_template_directory() . '/inc/classes/class-wrapping.php';
			require_once get_template_directory() . '/inc/widgets/about/class-about-widget.php';
			
			if ( class_exists( 'Elementor\Plugin' ) ) {
				require_once get_template_directory() . '/inc/widgets/elementor-template/class-elementor-template-widget.php';
			}

		}

		/**
		 * Register image sizes, based on config.
		 */
		public function set_thumb_sizes() {

			$thumbs = $this->get_config( 'thumbnails' );
			if ( isset( $thumbs['post-thumbnail'] ) ) {
				set_post_thumbnail_size(
					$thumbs['post-thumbnail']['width'],
					$thumbs['post-thumbnail']['height'],
					$thumbs['post-thumbnail']['crop']
				);

				unset( $thumbs['post-thumbnail'] );
			}

			if ( empty( $thumbs ) ) {
				return;
			}

			foreach ( $thumbs as $name => $data ) {
				add_image_size( $name, $data['width'], $data['height'], $data['crop'] );
			}
		}
		/**
		 * Enqueue admin-specific assets.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_assets( $hook ) {

			$available_pages = array(
				'widgets.php',
			);

			if ( ! in_array( $hook, $available_pages ) ) {
				return;
			}

			wp_enqueue_style( 'wapu-admin-style', $this->assets_url() . 'css/admin.css', array(), '1.0.0' );
		}

		/**
		 * Returns specific theme configurations
		 *
		 * @param  string $config Config name to get.
		 * @return mixed
		 */
		public function get_config( $config ) {

			$file            = sprintf( 'config/%s.php', $config );
			$config_template = locate_template( array( $file ) );

			if ( $config_template ) {
				return include $config_template;
			}
		}

		/**
		 * Overrides the load textdomain functionality when 'cherry-framework' is the domain in use.
		 *
		 * @since  1.0.0
		 * @link   https://gist.github.com/justintadlock/7a605c29ae26c80878d0
		 * @param  bool   $override
		 * @param  string $domain
		 * @param  string $mofile
		 * @return bool
		 */
		public function override_load_textdomain( $override, $domain, $mofile ) {

			// Check if the domain is our framework domain.
			if ( 'cherry-framework' === $domain ) {

				global $l10n;

				// If the theme's textdomain is loaded, assign the theme's translations
				// to the framework's textdomain.
				if ( isset( $l10n['wapu'] ) ) {
					$l10n[ $domain ] = $l10n['wapu'];
				}

				// Always override.  We only want the theme to handle translations.
				$override = true;
			}

			return $override;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Wapu_Theme
 *
 * @return object
 */
function wapu() {
	return Wapu_Theme::get_instance();
}

wapu();
