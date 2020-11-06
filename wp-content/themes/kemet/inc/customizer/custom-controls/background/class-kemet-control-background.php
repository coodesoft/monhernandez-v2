<?php
/**
 * Customizer Control: background.
 *
 * Creates a jQuery background control.
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       1.0.0
 */

/**
 * Field overrides.
 */
if ( ! class_exists( 'Kemet_Control_Background' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Background Control
	 */
	class Kemet_Control_Background extends WP_Customize_Control {

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'kmt-background';

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

		if ( ! is_array( $val ) || is_numeric( $val ) || empty($val)) {

			$val = array(
				'background-color'    => '',
				'background-image'    => '',
				'background-repeat'   => 'repeat',
				'background-position' => 'center center',
				'background-size'  => 'auto',
				'background-attachment'  => 'scroll',
			);
			}

			$this->json['value']  = $val;
			$this->json['link']  = $this->get_link();
			$this->json['id']    = $this->id;
			$this->json['label'] = esc_html( $this->label );
			
			$this->json['inputAttrs'] = '';
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
		}
		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$js_uri  = KEMET_THEME_URI . 'inc/customizer/custom-controls/background/';

			wp_enqueue_script( 'kemet-background', $js_uri . 'background.js', array(), KEMET_THEME_VERSION, true );
			wp_localize_script(
				'kemet-background', 'kemetCustomizerControlBackground', array(
					'placeholder'  => __( 'No file selected', 'kemet' ),
					'lessSettings' => __( 'Less Settings', 'kemet' ),
					'moreSettings' => __( 'More Settings', 'kemet' ),
				)
			);
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
			<label>
				<span class="customize-control-title">{{{ data.label }}}</span>
				<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
			</label>
			<div class="background-wrapper">
			
				<!-- background-color -->
				<div class="background-color">
					<h4><?php esc_html_e( 'Background Color', 'kemet' ); ?></h4>
					<input type="text" data-default-color="{{ data.default['background-color'] }}" data-alpha="true" value="{{ data.value['background-color'] }}" class="kmt-color-control"/>
				</div>
				<!-- background-image -->
				<div class="background-image">
					<h4><?php esc_html_e( 'Background Image', 'kemet' ); ?></h4>
					<div class="attachment-media-view background-image-upload">
						<# if ( data.value['background-image'] ) { #>
							<div class="thumbnail thumbnail-image"><img src="{{ data.value['background-image'] }}" alt="thumbnail-image" /></div>
						<# } else { #>
							<div class="placeholder"><?php esc_html_e( 'No File Selected', 'kemet' ); ?></div>
						<# } #>
						<div class="actions">
							<button class="button background-image-upload-remove-button<# if ( ! data.value['background-image'] ) { #> hidden <# } #>"><?php esc_html_e( 'Remove', 'kemet' ); ?></button>
							<button type="button" class="button background-image-upload-button"><?php esc_html_e( 'Select File', 'kemet' ); ?></button>
							<# if ( data.value['background-image'] ) { #>
								<a href="#" class="more-settings" data-direction="up"><span class="message"><?php esc_html_e( 'Less Settings', 'kemet' ); ?></span></a>
							<# } else { #>
								<a href="#" class="more-settings" data-direction="down"><span class="message"><?php esc_html_e( 'More Settings', 'kemet' ); ?></span></a>
							<# } #>
						</div>
					</div>
				</div>

				<!-- background-repeat -->
				<div class="background-repeat">
					<select {{{ data.inputAttrs }}}>
						<option value="no-repeat"<# if ( 'no-repeat' === data.value['background-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'No Repeat', 'kemet' ); ?></option>
						<option value="repeat"<# if ( 'repeat' === data.value['background-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat All', 'kemet' ); ?></option>
						<option value="repeat-x"<# if ( 'repeat-x' === data.value['background-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat Horizontally', 'kemet' ); ?></option>
						<option value="repeat-y"<# if ( 'repeat-y' === data.value['background-repeat'] ) { #> selected <# } #>><?php esc_html_e( 'Repeat Vertically', 'kemet' ); ?></option>
					</select>
				</div>

				<!-- background-position -->
				<div class="background-position">
					<select {{{ data.inputAttrs }}}>
						<option value="left top"<# if ( 'left top' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Left Top', 'kemet' ); ?></option>
						<option value="left center"<# if ( 'left center' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Left Center', 'kemet' ); ?></option>
						<option value="left bottom"<# if ( 'left bottom' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Left Bottom', 'kemet' ); ?></option>
						<option value="right top"<# if ( 'right top' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Right Top', 'kemet' ); ?></option>
						<option value="right center"<# if ( 'right center' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Right Center', 'kemet' ); ?></option>
						<option value="right bottom"<# if ( 'right bottom' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Right Bottom', 'kemet' ); ?></option>
						<option value="center top"<# if ( 'center top' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Center Top', 'kemet' ); ?></option>
						<option value="center center"<# if ( 'center center' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Center Center', 'kemet' ); ?></option>
						<option value="center bottom"<# if ( 'center bottom' === data.value['background-position'] ) { #> selected <# } #>><?php esc_html_e( 'Center Bottom', 'kemet' ); ?></option>
					</select>
				</div>

				<!-- background-size -->
				<div class="background-size">
					<h4><?php esc_html_e( 'Background Size', 'kemet' ); ?></h4>
					<div class="buttonset">
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="cover" name="_customize-bg-{{{ data.id }}}-size" id="{{ data.id }}cover" <# if ( 'cover' === data.value['background-size'] ) { #> checked="checked" <# } #>>
							<label class="switch-label switch-label-<# if ( 'cover' === data.value['background-size'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}cover"><?php esc_html_e( 'Cover', 'kemet' ); ?></label>
						</input>
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="contain" name="_customize-bg-{{{ data.id }}}-size" id="{{ data.id }}contain" <# if ( 'contain' === data.value['background-size'] ) { #> checked="checked" <# } #>>
							<label class="switch-label switch-label-<# if ( 'contain' === data.value['background-size'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}contain"><?php esc_html_e( 'Contain', 'kemet' ); ?></label>
						</input>
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="auto" name="_customize-bg-{{{ data.id }}}-size" id="{{ data.id }}auto" <# if ( 'auto' === data.value['background-size'] ) { #> checked="checked" <# } #>>
							<label class="switch-label switch-label-<# if ( 'auto' === data.value['background-size'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}auto"><?php esc_html_e( 'Auto', 'kemet' ); ?></label>
						</input>
					</div>
				</div>

				<!-- background-attachment -->
				<div class="background-attachment">
					<h4><?php esc_html_e( 'Background Attachment', 'kemet' ); ?></h4>
					<div class="buttonset">
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="inherit" name="_customize-bg-{{{ data.id }}}-attachment" id="{{ data.id }}inherit" <# if ( 'inherit' === data.value['background-attachment'] ) { #> checked="checked" <# } #>>
							<label class="switch-label switch-label-<# if ( 'inherit' === data.value['background-attachment'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}inherit"><?php esc_html_e( 'Inherit', 'kemet' ); ?></label>
						</input>
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="scroll" name="_customize-bg-{{{ data.id }}}-attachment" id="{{ data.id }}scroll" <# if ( 'scroll' === data.value['background-attachment'] ) { #> checked="checked" <# } #>>
							<label class="switch-label switch-label-<# if ( 'scroll' === data.value['background-attachment'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}scroll"><?php esc_html_e( 'Scroll', 'kemet' ); ?></label>
						</input>
						<input {{{ data.inputAttrs }}} class="switch-input screen-reader-text" type="radio" value="fixed" name="_customize-bg-{{{ data.id }}}-attachment" id="{{ data.id }}fixed" <# if ( 'fixed' === data.value['background-attachment'] ) { #> checked="checked" <# } #>>
							<label class="switch-label switch-label-<# if ( 'fixed' === data.value['background-attachment'] ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}fixed"><?php esc_html_e( 'Fixed', 'kemet' ); ?></label>
						</input>
					</div>
				</div>
				<input class="background-hidden-value" value="{{JSON.stringify( data.value )}}" type="hidden" {{{ data.link }}}>
			<?php
		}

		/**
		 * Render the control's content.
		 *
		 * @see WP_Customize_Control::render_content()
		 */
		protected function render_content() {}
	}
endif;
