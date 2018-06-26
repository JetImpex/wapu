<?php
/**
 * Wapuula Theme Customizer
 *
 * @package Wapuula
 */
function wapu_get_customizer_options() {
	return apply_filters( 'wapu_customizer_options', array(
		'prefix'     => 'wapu',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(
			'header_logo_url' => array(
				'title'           => esc_html__( 'Logo Upload', 'wapu' ),
				'description'     => esc_html__( 'Upload logo image', 'wapu' ),
				'section'         => 'title_tagline',
				'default'         => '%s/assets/images/logo.png',
				'field'           => 'image',
				'type'            => 'control',
			),
			'linked_logo' => array(
				'title'    => esc_html__( 'Linked Logo', 'tattoized' ),
				'section'  => 'title_tagline',
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'retina_header_logo_url' => array(
				'title'           => esc_html__( 'Retina Logo Upload', 'wapu' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', 'wapu' ),
				'section'         => 'title_tagline',
				'field'           => 'image',
				'type'            => 'control',
			),
			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', 'tattoized' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			/** landing panel */
			'landing_options' => array(
				'title'    => esc_html__( 'Landing options', 'wapu' ),
				'priority' => 130,
				'type'     => 'section',
			),
			'landing_first_image' => array(
				'title'   => esc_html__( 'First landing image', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),

			'landing_first_image_retina' => array(
				'title'   => esc_html__( 'First landing image retina', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),
			'landing_second_image' => array(
				'title'   => esc_html__( 'Second landing image', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),

			'landing_second_image_retina' => array(
				'title'   => esc_html__( 'Second landing image retina', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),
			'landing_third_image' => array(
				'title'   => esc_html__( 'Third landing image', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),

			'landing_third_image_retina' => array(
				'title'   => esc_html__( 'Third landing image retina', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),
			'landing_fourth_image' => array(
				'title'   => esc_html__( 'Fourth landing image', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),

			'landing_fifth_image' => array(
				'title'   => esc_html__( 'Fifth landing image', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),

			'landing_sixth_image' => array(
				'title'   => esc_html__( 'Sixth landing image', 'wapu' ),
				'section' => 'landing_options',
				'field'   => 'image',
				'type'    => 'control',
			),
		),
	) );
}

/**
 * Return sanitized theme mod value.
 *
 * @param  string       $mod               Mod name to get.
 * @param  bool         $use_default       User or not default value.
 * @param  string|array $sanitize_callback Sanitize callback name.
 * @return mixed
 */
function wapu_get_mod( $mod = null, $use_default = false, $sanitize_callback = null ) {

	if ( ! $mod ) {
		return false;
	}

	$default = false;

	if ( true === $use_default ) {
		$default = wapu()->customizer->get_default( $mod );
	}

	$value = get_theme_mod( $mod, $default );

	if ( is_callable( $sanitize_callback ) ) {
		return call_user_func( $sanitize_callback, $value );
	} else {
		return $value;
	}

}
