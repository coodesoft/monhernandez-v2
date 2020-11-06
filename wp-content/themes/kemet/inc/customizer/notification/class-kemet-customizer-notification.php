<?php

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer_Notification
 *
 * @since 1.0.4
 */
if ( ! class_exists( 'Kemet_Customizer_Notification' ) ) {

	/**
	 * Kemet_Customizer_Notification Initial setup
	 */
	class Kemet_Customizer_Notification extends WP_Customize_Section {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.4
		 * @access public
		 * @var    string
		 */
		public $type = 'kemet-customizer-notification';

		/**
		 * Custom pro button URL.
		 *
		 * @since  1.0.4
		 * @access public
		 * @var    string
		 */
		public $slug = '';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.4
		 * @access public
		 * @return string
		 */
		public function json() {
			$json            = parent::json();
            $json['description'] = $this->description;
            $json['button_html'] =  $this->create_plugin_install_button($this->slug);

			return $json;
		}


        /**
         * Check plugin state.
         *
         * @param string $slug plugin slug.
         *
         * @return bool
         */
        public function create_plugin_install_button( $slug ) {
            return Kemet_Notification_Helper::get_btn_html( $slug );
        }
    
		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.4
		 * @access public
		 * @return void
		 */
		protected function render_template() {
			?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand control-section-defaul" >
			
			<div class="kmt-notification">
				<h3 class="section-title">
					{{ data.title }}
				</h3>

				<# if ( data.description ) { #><p class="notification-description">{{ data.description }}</p><# } #>

				<# if ( data.button_html ) { #><div class="action-button">{{{data.button_html}}}</div><# } #>
			</div>
		</li>
			<?php
        }
        


        /**
         * Enqueue Function.
         */
        public function enqueue() {

        $uri = KEMET_THEME_URI . 'inc/customizer/notification/';
		
		wp_enqueue_script( 'kemet-customizer-notification', $uri . 'notification-helper.js', array(), KEMET_THEME_VERSION, true );
        }
	}

}
