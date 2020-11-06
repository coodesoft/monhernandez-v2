<?php
/**
 * Extra Headers
 * 
 * @package Kemet Addons
 */

if ( !class_exists( 'Kemet_Extra_Headers_Partials' )) {
    /**
	 * Extra Headers Settings
	 *
	 * @since 1.0.0
	 */
    class Kemet_Extra_Headers_Partials {
        
        private static $instance;
        
        /**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
        /**
		 *  Constructor
		 */
		public function __construct() {
            
			add_filter( 'body_class', array( $this,'kemet_body_classes' ));
			add_action( 'kemet_sitehead', array( $this, 'sitehead_markup_loader'), 1);
			add_action( 'kemet_get_css_files', array( $this, 'add_styles' ) );
            add_action( 'kemet_get_js_files', array( $this, 'add_scripts' ) );
			add_filter( 'kemet_header_class', array( $this, 'header_classes' ), 10, 1 );
			add_action( 'kemet_before_top_bar', array( $this, 'header_with_top_bar' ) );
			add_action( 'kemet_after_main_header', array( $this, 'after_main_header' ) );
			add_filter( 'header_container_classes', array( $this,'kemet_header_container' ));
        } 
        
		/**
		  * Kemet Header Container Classes
		 */
		function kemet_header_container($classes){
			$header_width = kemet_get_option('header-main-layout-width');

			if($header_width == 'boxed' ||$header_width == 'stretched' ){
				$classes[] = 'main-header-content'; 
			}

			return $classes;
		}

        function html_markup_loader() {
            ?>
    
            <header itemtype="https://schema.org/WPHeader" itemscope="itemscope" id="sitehead" <?php kemet_header_classes();?> role="banner">
    
                <?php kemet_sitehead_top(); ?>
    
                <?php kemet_sitehead(); ?>
    
                <?php kemet_sitehead_bottom(); ?>

			</header><!-- #sitehead -->
            <?php
		}
		
       function sitehead_markup_loader() {
            
			$kemet_header_layout = kemet_get_option( 'header-layouts' );
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', $kemet_header_layout );
			$options = get_option( 'kmt_framework' );
			
			if ( $kemet_header_layout !== 'disable' ) {
				if ( 'header-main-layout-1' !== $kemet_header_layout && 'header-main-layout-2' !== $kemet_header_layout  && 'header-main-layout-3' !== $kemet_header_layout) {
					add_action( 'kemet_header', array( $this,'html_markup_loader'));	
					remove_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' ); 
					kemetaddons_get_template( 'extra-headers/templates/'. esc_attr( $kemet_header_layout ) . '.php' );
					
				} else if ( 1 !== ( $options['extra-headers'] ) ) {
					add_action( 'kemet_sitehead', 'kemet_sitehead_primary_template' );
				}		  
			}        
		}
		function header_with_top_bar(){
			$merge_top_bar_with_header = kemet_get_option( 'merge-top-bar-header' );
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );	
			$unsupported_headers = array('header-main-layout-5' , 'header-main-layout-6' , 'header-main-layout-7');
			if($merge_top_bar_with_header && (!empty(kemet_get_option( 'top-section-1' )) || !empty(kemet_get_option( 'top-section-2' ))) && !in_array($kemet_header_layout , $unsupported_headers)){
				$combined = 'kemet-merged-top-bar-header';
				printf(
					'<div class="%1$s">',
					$combined
				);
			}
		}
		function after_main_header(){
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );	
			$unsupported_headers = array('header-main-layout-5' , 'header-main-layout-6' , 'header-main-layout-7');
			$merge_top_bar_with_header = kemet_get_option( 'merge-top-bar-header' );
			if( $merge_top_bar_with_header && (!empty(kemet_get_option( 'top-section-1' )) || !empty(kemet_get_option( 'top-section-2' ))) && !in_array($kemet_header_layout , $unsupported_headers)) {
				echo '</div><!-- .kemet-merged-top-bar-header -->';
			}

		}
        function kemet_body_classes($classes) {
            $kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true);

            if('header-main-layout-5' == $kemet_header_layout) {
                
                $classes[] = 'header-main-layout-5';
                $classes[] = 'kemet-main-v-header-align-'. kemet_get_option('v-headers-position') ;
			} 
			if('header-main-layout-7' == $kemet_header_layout) {
                
                $classes[] = 'header-main-layout-7';
                $classes[] = 'kemet-main-v-header-align-'. kemet_get_option('v-headers-position') ;
			}
			if ( is_singular() ) {
				if(isset($meta['kemet-main-header-display']) && $meta['kemet-main-header-display'] == '1'){
					$header_align_class = 'kemet-main-v-header-align-'. kemet_get_option('v-headers-position');
					if(in_array($header_align_class , $classes)){
						$align_header = array_search($header_align_class, $classes);
						unset($classes[$align_header]);
					}
				}
			}

			$header_transparent = kemet_get_option( 'enable-transparent' ) ? 'enable' : 'disable';
			$header_transparent       = apply_filters('kemet_trnsparent_header' , $header_transparent );
			$top_bar_enable = apply_filters( 'kemet_top_bar_enabled', true );
			$top_bar_1 = kemet_get_option('top-section-1');
			$top_bar_2 = kemet_get_option('top-section-2');
			
			if( $header_transparent == 'enable' && $top_bar_enable && (!empty($top_bar_1) || !empty($top_bar_2)) ){
				$classes[] = 'merged-header-transparent';
			}else if($header_transparent == 'enable' && ( !$top_bar_enable || (empty($top_bar_1) && empty($top_bar_2) ) ) ){
				$classes[] = 'header-transparent';
			}
			

            return $classes;
		}
		
        function header_classes( $classes ) {
			$header_transparent       = kemet_get_option( 'enable-transparent' );
			if($header_transparent){
				$classes[] = 'kmt-header-transparent';
			}
			
			$meta = get_post_meta( get_the_ID(), 'kemet_page_options', true);
			$kemet_header_layout = apply_filters( 'kemet_primary_header_layout', kemet_get_option( 'header-layouts' ) );
			$vheader_has_box_shadow   = kemet_get_option('vheader-box-shadow');
			if('header-main-layout-7' == $kemet_header_layout || 'header-main-layout-5' == $kemet_header_layout || 'header-main-layout-6' == $kemet_header_layout){
				if(in_array('kmt-header-transparent' , $classes)){
					$overlay_enabled = array_search('kmt-header-transparent', $classes);
					unset($classes[$overlay_enabled]);
				}
			}
			if('header-main-layout-7' == $kemet_header_layout) {
				if ($vheader_has_box_shadow == true) {
					$classes[] = 'has-box-shadow';
				}
				$classes[] = 'v-header-align-'. kemet_get_option('v-headers-position') ;
			}
			if( 'header-main-layout-5' == $kemet_header_layout ) {

				if ($vheader_has_box_shadow == true) {
					$classes[] = 'has-box-shadow';
				}
				
				$classes[] = 'v-header-align-'. kemet_get_option('v-headers-position') ;
			}
			if ( is_singular() ) {
				if(isset($meta['kemet-main-header-display']) && $meta['kemet-main-header-display'] == '1'){
					$header_align_class = 'v-header-align-'. kemet_get_option('v-headers-position');
					if(in_array($header_align_class , $classes)){
						$align_header = array_search($header_align_class, $classes);
						unset($classes[$align_header]);
					}
				}	
			}

			$kemet_header_content_width = kemet_get_option('header-main-layout-width');
			$classes[] = 'header-' . $kemet_header_content_width . '-width';
			return $classes;
         }
        
        
         /**
		  * Enqueues scripts and styles for the header layouts
		 */
		function add_styles() {

			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$css_prefix = '.css';
				$dir        = 'unminified';
			}
			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}
 
			Kemet_Style_Generator::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/'. $dir .'/extra-header-layouts' . $css_prefix );
			Kemet_Style_Generator::kmt_add_css(KEMET_EXTRA_HEADERS_DIR.'assets/css/minified/simple-scrollbar.min.css');
		}

		public function add_scripts() {

			$js_prefix  = '.min.js';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$dir        = 'unminified';
			}

			Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/'. $dir .'/extra-header-layouts' . $js_prefix);
			Kemet_Style_Generator::kmt_add_js(KEMET_EXTRA_HEADERS_DIR.'assets/js/minified/simple-scrollbar.min.js');

		}
    }
}
Kemet_Extra_Headers_Partials::get_instance();