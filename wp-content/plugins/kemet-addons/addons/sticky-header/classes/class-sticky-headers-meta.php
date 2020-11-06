<?php
/**
 * Sticky Headers Meta Box
 */

if ( ! class_exists( 'Kemet_Addon_Sticky_Headers_Meta_Box' ) ) {

	class Kemet_Addon_Sticky_Headers_Meta_Box {
        /**
         * Instance
         *
         * @var $instance
         */
        private static $instance;

        /**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
            self::add_sticky_headers_meta_box();
            add_action( 'wp', array( $this, 'meta_options_hooks' ) );
        }
        
        /**
		 * Metabox Hooks
		 */
		function meta_options_hooks() {

			if ( is_singular() ) {
                add_filter( 'kemet_disable_sticky_header', array( $this, 'disable_sticky_header' ) );
			}
           
        }

        function add_sticky_headers_meta_box(){
    
            KFW::createSection( 'kemet_page_options', array(
                'title'  => __('Sticky Header', 'kemet-addons'),
                'icon'   => 'dashicons dashicons-admin-site-alt2',
                'priority_num' => 4,
                'fields' => array(
                    array(
                        'id'         => 'kemet-disable-sticky-header',
                        'type'       => 'button_set',
                        'title'      => __('Disable Sticky Header', 'kemet-addons'),
                        'options'     => array(
                            'default'     => __('Default', 'kemet-addons'),
                            'enable'     => __('Enable', 'kemet-addons'),
                            'disable'    => __('Disable', 'kemet-addons'),
                        ),
                        'label'   => __('Disable The Sticky Header in The Current Page/Post.', 'kemet-addons'),
                        'default'    => 'default'
                    ),          
                  ) 
                )
            );
        }

         /**
		 * Sticky Header Option
		 */
        function disable_sticky_header( $default ) {
			
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true ); 
		    $disable_sticky_header = (isset( $meta['kemet-disable-sticky-header'] ) ) ? $meta['kemet-disable-sticky-header'] : 'default';

			if ( $disable_sticky_header === 'disable' ) {
				$default = false;
            }else if($disable_sticky_header === 'enable'){
                $default = true;
            }
			
            return $default;
        }
    }
}

new Kemet_Addon_Sticky_Headers_Meta_Box;