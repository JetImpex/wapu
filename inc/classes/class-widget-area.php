<?php
/**
 * Class for widget areas registration.
 *
 * @package    Wapu
 * @subpackage Class
 */

if ( ! class_exists( 'Wapu_Widget_Area' ) ) {

	class Wapu_Widget_Area {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Settings.
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public $widgets_settings = array();

		/**
		 * Public holder thats save widgets state during page loading.
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public $active_sidebars = array();

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 * @since 1.0.1 Removed argument in constructor.
		 */
		function __construct() {
			add_action( 'widgets_init',            array( $this, 'register' ) );
			add_action( 'wapu_render_widget_area', array( $this, 'render' ) );
		}

		/**
		 * Register widget areas.
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function register() {
			global $wp_registered_sidebars;

			foreach ( $this->widgets_settings as $id => $settings ) {

				register_sidebar( array(
					'name'          => $settings['name'],
					'id'            => $id,
					'description'   => $settings['description'],
					'before_widget' => $settings['before_widget'],
					'after_widget'  => $settings['after_widget'],
					'before_title'  => $settings['before_title'],
					'after_title'   => $settings['after_title'],
				) );

				if ( isset( $settings['is_global'] ) ) {
					$wp_registered_sidebars[ $id ]['is_global'] = $settings['is_global'];
				}
			}
		}

		/**
		 * Render widget areas.
		 *
		 * @since  1.0.0
		 * @param  string $area_id Widget area ID.
		 * @return void
		 */
		public function render( $area_id ) {

			if ( ! is_active_sidebar( $area_id ) ) {
				$this->active_sidebars[ $area_id ] = false;
				return;
			}

			$this->active_sidebars[ $area_id ] = true;

			$settings = $this->widgets_settings[ $area_id ];

			// Conditional page tags checking.
			if ( isset( $settings['conditional'] )
				&& ! empty( $settings['conditional'] )
				) {

				$visibility = false;

				foreach ( $settings['conditional'] as $conditional ) {
					if ( is_callable( $conditional ) ) {
						$visibility = call_user_func( $conditional ) ? true : false;
					}

					if ( true === $visibility ) {
						break;
					}
				}

				if ( false === $visibility ) {
					return;
				}
			}

			$area_id        = apply_filters( 'wapu_rendering_current_widget_area', $area_id );
			$before_wrapper = isset( $settings['before_wrapper'] ) ? $settings['before_wrapper'] : '<div id="%1$s" %2$s>';
			$after_wrapper  = isset( $settings['after_wrapper'] ) ? $settings['after_wrapper'] : '</div>';

			$classes = array(
				'widget-area',
				sprintf( '%s-area', $area_id ),
				isset( $settings['wrapper_classes'] ) ? esc_attr( $settings['wrapper_classes'] ) : false
			);

			$classes = apply_filters( 'wapu_widget_area_classes', $classes, $area_id );

			if ( is_array( $classes ) ) {
				$classes = 'class="' . join( ' ', array_filter( $classes ) ) . '"';
			}

			printf( $before_wrapper, $area_id, $classes );
				dynamic_sidebar( $area_id );
			printf( $after_wrapper );
		}

		/**
		 * Check if passed sidebar was already rendered and it's active.
		 *
		 * @since  1.0.0
		 * @param  string    $index Sidebar ID.
		 * @return bool|null
		 */
		public function is_active_sidebar( $index ) {

			if ( isset( $this->active_sidebars[ $index ] ) ) {
				return $this->active_sidebars[ $index ];
			}

			return null;
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
				self::$instance = new self();
			}

			return self::$instance;
		}
	}

	function wapu_widget_area() {
		return Wapu_Widget_Area::get_instance();
	}

	wapu_widget_area();
}
