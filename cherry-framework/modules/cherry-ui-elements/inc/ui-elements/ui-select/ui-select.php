<?php
/**
 * Class for the building ui-select elements.
 *
 * @package    Cherry_Framework
 * @subpackage Class
 * @author     Cherry Team <support@cherryframework.com>
 * @copyright  Copyright (c) 2012 - 2015, Cherry Team
 * @link       http://www.cherryframework.com/
 * @license    http://www.gnu.org/licenses/gpl-3.0.en.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'UI_Select' ) ) {

	/**
	 * Class for the building UI_Select elements.
	 */
	class UI_Select extends UI_Element implements I_UI {

		/**
		 * Default settings.
		 *
		 * @since 1.0.0
		 * @var array
		 */
		private $defaults_settings = array(
			'id'           => 'cherry-ui-select-id',
			'name'         => 'cherry-ui-select-name',
			'multiple'     => false,
			'filter'       => false,
			'size'         => 1,
			'inline_style' => 'width: 100%',
			'value'        => 'select-8',
			'lock'         => false,
			'options'      => array(
				'select-1' => 'select 1',
				'select-2' => 'select 2',
				'select-3' => 'select 3',
				'select-4' => 'select 4',
				'select-5' => array(
					'label' => 'Group 1',
					'slave' => 'slave',
				),
				'optgroup-1' => array(
					'label'         => 'Group 1',
					'group_options' => array(
						'select-6' => 'select 6',
						'select-7' => 'select 7',
						'select-8' => 'select 8',
					),
				),
				'optgroup-2' => array(
					'label'         => 'Group 2',
					'group_options' => array(
						'select-9'  => 'select 9',
						'select-10' => 'select 10',
						'select-11' => 'select 11',
					),
				),
			),
			'label'  => '',
			'class'  => '',
			'master' => '',
		);

		/**
		 * Constructor method for the UI_Select class.
		 *
		 * @since 1.0.0
		 */
		function __construct( $args = array() ) {
			$this->defaults_settings['id'] = 'cherry-ui-select-' . uniqid();
			$this->settings = wp_parse_args( $args, $this->defaults_settings );

			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
		}

		/**
		 * Render html UI_Select.
		 *
		 * @since 1.0.0
		 */
		public function render() {
			$html = '';
			$input_lock = ( ! empty( $this->settings['lock'] ) ) ? 'disabled' : '' ;
			$lock_lable = ! empty( $this->settings['lock']['label'] )? sprintf('<div class="cherry-lock-label">%1$s</div>', $this->settings['lock']['label'] ) : '' ;
			$class = implode( ' ',
				array(
					$this->settings['class'],
					$this->settings['master'],
					( $input_lock ) ? 'cherry-ui-elements-lock' : '' ,
				)
			);

			$html .= '<div class="cherry-ui-container ' . esc_attr( $class ) . '">';

				( $this->settings['filter'] ) ? $filter_state = 'data-filter="true"' : $filter_state = 'data-filter="false"' ;

				( $this->settings['multiple'] ) ? $multi_state = 'multiple="multiple"' : $multi_state = '' ;
				( $this->settings['multiple'] ) ? $name = $this->settings['name'] . '[]' : $name = $this->settings['name'] ;

				if ( '' !== $this->settings['label'] ) {
					$html .= '<label class="cherry-label" for="' . esc_attr( $this->settings['id'] ) . '">' . $this->settings['label'] . '</label> ';
				}

				$inline_style = $this->settings['inline_style'] ? 'style="' . esc_attr( $this->settings['inline_style'] ) . '"' : '' ;

				$html .= '<select id="' . esc_attr( $this->settings['id'] ) . '" class="cherry-ui-select" name="' . esc_attr( $name ) . '" size="' . esc_attr( $this->settings['size'] ) . '" ' . $multi_state . ' ' . $filter_state . ' placeholder="' . $this->settings['placeholder'] . '" ' . $inline_style . ' ' . $input_lock . '>';

				if ( $this->settings['options'] && ! empty( $this->settings['options'] ) && is_array( $this->settings['options'] ) ) {
					foreach ( $this->settings['options'] as $option => $option_value ) {
						if ( ! is_array( $this->settings['value'] ) ) {
							$this->settings['value'] = array( $this->settings['value'] );
						}
						if ( false === strpos( $option, 'optgroup' ) ) {
							$selected_state = '';
							if ( $this->settings['value'] && ! empty( $this->settings['value'] ) ) {
								foreach ( $this->settings['value'] as $key => $value ) {
									$selected_state = selected( $value, $option, false );
									if ( " selected='selected'" == $selected_state ) {
										break;
									}
								}
							}

							if ( is_array( $option_value ) ) {
								$lable = $option_value['label'];
								$data  = !empty( $option_value['slave'] ) ? 'data-slave="' . $option_value['slave'] . '"' : '' ;
							} else {
								$lable = $option_value;
								$data  = '';
							}

							$option_lock = ( ! empty( $option_value['lock'] ) ) ? 'disabled' : '' ;
							$option_lable = ! empty( $option_value['lock']['label'] )? $option_value['lock']['label'] : '' ;

							$html .= '<option value="' . esc_attr( $option ) . '" ' . $selected_state . ' ' . $data . ' ' . $option_lock . '>' . esc_html( $lable ) . $option_lable . '</option>';
						} else {
							$html .= '<optgroup label="' . esc_attr( $option_value['label'] ) . '">';
								$selected_state = '';
								foreach ( $option_value['group_options'] as $group_item => $group_value ) {
									foreach ( $this->settings['value'] as $key => $value ) {
										$selected_state = selected( $value, $group_item, false );
										if ( " selected='selected'" == $selected_state ) {
											break;
										}
									}
									$html .= '<option value="' . esc_attr( $group_item ) . '" ' . $selected_state . '>' . esc_html( $group_value ) . '</option>';
								}
							$html .= '</optgroup>';
						}
					}
				}
				$html .= '</select>';
				$html .= $lock_lable;
			$html .= '</div>';

			return $html;
		}

		/**
		 * Enqueue javascript and stylesheet UI_Select
		 *
		 * @since 1.0.0
		 */
		public static function enqueue_assets() {
			wp_enqueue_script(
				'ui-select-select2',
				esc_url( Cherry_Core::base_url( 'assets/min/select2.min.js', __FILE__ ) ),
				array( 'jquery' ),
				'4.0.3',
				true
			);

			wp_enqueue_script(
				'ui-select-min',
				esc_url( Cherry_Core::base_url( 'assets/min/ui-select.min.js', __FILE__ ) ),
				array( 'jquery' ),
				'1.3.2',
				true
			);

			wp_enqueue_style(
				'ui-select-select2',
				esc_url( Cherry_Core::base_url( 'assets/min/select2.min.css', __FILE__ ) ),
				array(),
				'4.0.3',
				'all'
			);

			wp_enqueue_style(
				'ui-select-min',
				esc_url( Cherry_Core::base_url( 'assets/min/ui-select.min.css', __FILE__ ) ),
				array(),
				'1.3.2',
				'all'
			);
		}
	}
}