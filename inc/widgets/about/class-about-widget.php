<?php
/*
Widget Name: About widget
Description: This widget is used to display information about your site.
Settings:
 Title - Widget's text title
 Logo - You can select a logo for the widget
 Enable Social Buttons - Enable/disable social buttons
 Enable Tagline - Enable/disable tagline
 Content - Add content to this field
*/

/**
 * @package Wapu
 */

if ( ! class_exists( 'Wapu_About_Widget' ) ) {

	class Wapu_About_Widget extends Cherry_Abstract_Widget {

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->widget_cssclass    = 'widget-about';
			$this->widget_description = esc_html__( 'Display an information about your site.', 'wapu' );
			$this->widget_id          = 'wapu_widget_about';
			$this->widget_name        = esc_html__( 'About Wapu', 'wapu' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'value' => '',
					'label' => esc_html__( 'Title:', 'wapu' ),
				),
				'media_id' => array(
					'type'               => 'media',
					'multi_upload'       => false,
					'library_type'       => 'image',
					'upload_button_text' => esc_html__( 'Upload', 'wapu' ),
					'value'              => '',
					'label'              => esc_html__( 'Logo:', 'wapu' ),
				),
				'enable_social' => array(
					'type'  => 'checkbox',
					'value' => array(
						'enable_social' => 'true',
					),
					'options' => array(
						'enable_social' => esc_html__( 'Enable Social Buttons', 'wapu' ),
					),
				),
				'enable_tagline' => array(
					'type'  => 'checkbox',
					'value' => array(
						'enable_tagline' => 'true',
					),
					'options' => array(
						'enable_tagline' => esc_html__( 'Enable Tagline', 'wapu' ),
					),
				),
				'content'  => array(
					'type'              => 'textarea',
					'placeholder'       => esc_html__( 'Text or HTML', 'wapu' ),
					'value'             => '',
					'label'             => esc_html__( 'Content:', 'wapu' ),
					'sanitize_callback' => 'wp_kses_post',
				),
			);

			parent::__construct();
		}

		/**
		 * Get social navigation menu
		 *
		 * @param  string $wrapper Formated wrapper string.
		 * @return string
		 */
		public function get_social_nav( $wrapper ) {
			$content        = '';
			$social_enabled = ( ! empty( $this->instance['enable_social'] ) ) ? $this->instance['enable_social'] : false;

			if ( is_array( $social_enabled ) && 'true' === $social_enabled['enable_social'] ) {
				$content = sprintf( $wrapper, wapu_get_social_list( 'widget' ) );
			}

			return $content;
		}

		/**
		 * Widget function.
		 *
		 * @see   WP_Widget
		 * @since 1.0.1
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$template = locate_template( 'inc/widgets/about/views/about.php', false, false );

			if ( empty( $template ) ) {
				return;
			}

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			$title     = ! empty( $instance['title'] ) ? $instance['title'] : $this->settings['title']['value'];
			$media_id  = isset( $instance['media_id'] ) ? absint( $instance['media_id'] ) : 0;
			$src       = wp_get_attachment_image_src( $media_id, 'medium' );
			$site_name = esc_attr( get_bloginfo( 'name' ) );
			$home_url  = esc_url( home_url( '/' ) );
			$logo_url  = $logo_width = $logo_height = '';

			if ( false !== $src ) {
				$logo_url = esc_url( $src[0] );
			}

			$content = $this->use_wpml_translate( 'content' );

			/**
			 * Filters the content of the widget.
			 *
			 * @param string            $content  The widget content.
			 * @param array             $instance Array of settings for the current widget.
			 * @param Wapu_About_Widget $this     Current widget instance.
			 */
			$content = apply_filters( 'widget_text', $content, $instance, $this );

			$tagline = '';
			$tagline_enabled = ( ! empty( $instance['enable_tagline'] ) ) ? $instance['enable_tagline'] : false;

			if ( is_array( $tagline_enabled ) && 'true' === $tagline_enabled['enable_tagline'] ) {
				$tagline_enabled = true;
			} else {
				$tagline_enabled = false;
			}

			if ( $tagline_enabled ) {
				$format   = apply_filters( 'wapu_about_widget_tagline_format', '<p>%s</p>', $this->settings, $this->args );
				$_tagline = get_bloginfo( 'description', 'display' );
				$tagline  = ( ! empty( $_tagline ) ) ? sprintf( $format, $_tagline ) : '';
			}

			include $template;

			$this->widget_end( $args );
			$this->reset_widget_data();
		}
	}
}

add_action( 'widgets_init', 'wapu_register_about_widget' );
function wapu_register_about_widget() {
	register_widget( 'Wapu_About_Widget' );
}
