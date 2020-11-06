<?php

// check if the extension exists
if( ! function_exists('hfe_header_enabled') ){
    return;
}

/**
 * Kemet HFE Plugin Compatiblity
 */
class Kemet_HFE_Compat {

	/**
	 *  Initiator
	 */
	public function __construct() {
        
        add_action( 'wp', array( $this, 'hooks' ) );
        remove_action( 'init', array( \Header_Footer_Elementor::instance(), 'setup_unsupported_theme' ) );
	}

	/**
     * Disable footer from the theme.
     */
    public function setup_footer() {
        remove_action( 'kemet_footer', 'kemet_footer_markup'  );
        
    }

    /**
	 * Disable header from the theme.
	 */
	public function kemet_setup_header() {
		remove_action( 'kemet_header', 'kemet_header_markup' );
    }
    
    /**
     * Run all the Actions / Filters.
     */
    public function hooks() {

        if ( hfe_header_enabled() ) {
			add_action( 'template_redirect', array( $this, 'kemet_setup_header' ) );
			add_action( 'kemet_header', 'hfe_render_header' );
		}

		if ( hfe_footer_enabled() ) {
            add_action( 'template_redirect', array( $this, 'setup_footer' ) );
            add_action( 'kemet_footer', 'hfe_render_footer' );
        }        
    }

}

new Kemet_HFE_Compat();
