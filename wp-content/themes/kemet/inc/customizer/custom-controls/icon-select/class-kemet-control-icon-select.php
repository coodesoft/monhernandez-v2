<?php
/**
* Customizer Control: icon-select
*
* @package     Kemet
* @author      Kemet
* @copyright   Copyright ( c ) 2019, Kemet
* @link        https://kemet.io/
* @since       1.0.0
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Icon Select
*/

class Kemet_Control_Icon_Select extends WP_Customize_Control {

    /**
    * The control type.
    *
    * @access public
    * @var string
    */
    public $type = 'kmt-icon-select';

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
        foreach ( $this->choices as $key => $value ) {
            $this->json['choices_icon'][ $key ] = $value['icon'];
        }

        $this->json['value'] 	   = maybe_unserialize( $this->value() );
        $this->json['choices']     = $this->choices;
        $this->json['link']        = $this->get_link();
        $this->json['id']          = $this->id;

    }

    /**
    * An Underscore ( JS ) template for this control's content ( but not its container ).
    *
    * Class variables for this control class are available in the `data` JS object;
    * export custom variables by overriding {
        *@see WP_Customize_Control::to_json()}
        *.
        *
        * @see WP_Customize_Control::print_template()
        *
        * @access protected
        */
        protected function content_template() {
            $rtl_class = is_rtl() ? 'rtl' : '';
		?>
		<label class="customizer-text">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{{ data.label }}}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
		</label>
		<div id="input_{{ data.id }}" class="icon-select <?php echo $rtl_class; ?>">  
			<# for ( key in data.choices ) { #>	
				<label>
					<input class="icon-select-input" type="radio" value="{{ key }}" name="_customize-icon-select-{{ data.id }}" {{{ data.link }}}<# if ( data.value === key ) { #> checked<# } #> />
					<span class="icon-select-label">
						<div class="dashicons {{ data.choices_icon[ key ] }}"></div>
					</span>
				</label>
			<# } #>
		</div>
		<?php
	}
}
