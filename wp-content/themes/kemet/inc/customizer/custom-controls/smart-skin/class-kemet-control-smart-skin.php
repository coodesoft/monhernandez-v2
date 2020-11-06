<?php
/**
 * Customizer Control: Smart Skin.
 *
 * Creates a jQuery Smart Skin control.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Smart Skin control (range).
 */
class Kemet_Control_Smart_Skin extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'kmt-smart-skin';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {
		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
			}
			$val = maybe_unserialize( $this->value() );

			if ( ! is_array( $val ) || is_numeric( $val ) ) {

				$val = array(
					'primary'  => '',
					't1'       => '',
					't2'       => '',
					'b1' 	   => '',
					'ft'       => '',
					'fb'       => '',
				);
			}
			$this->json['value'] = $val;
			foreach ( $this->choices as $key => $value ) {
				$this->json['choices'][ $key ]        = esc_url( $value['path'] );
				$this->json['choices_titles'][ $key ] = $value['label'];
				$this->json['colors'] = $value['colors'];
			}

			$this->json['link'] = $this->get_link();
			$this->json['id']   = $this->id;
			
	}
	/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$uri  = KEMET_THEME_URI . 'inc/customizer/custom-controls/smart-skin/';

			wp_enqueue_style( 'kemet-smart-skin-css', $uri . 'smart-skin.css' , null, KEMET_THEME_VERSION );
			wp_enqueue_script( 'kemet-smart-skin-js', $uri . 'smart-skin.js', array(), KEMET_THEME_VERSION, true );
			
		}
	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<label for="">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<div id="input_{{ data.id }}" class="image">
			<# for ( key in data.choices ) { #>
					<input {{{ data.inputAttrs }}} class="image-select" data-colors="{{JSON.stringify(data.colors)}}" type="radio" value="{{ key }}" name="_customize-radio-{{ data.id }}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked="checked"<# } #>>
						<label for="{{ data.id }}{{ key }}" {{{ data.labelStyle }}} class="image">
							<img class="wp-ui-highlight" src="{{ data.choices[ key ] }}">
							<span class="image-clickable" title="{{ data.choices_titles[ key ] }}" ></span>
						</label>	
					</input>
				<# } #>
			</div>
		</label>
		<?php
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {}
}
