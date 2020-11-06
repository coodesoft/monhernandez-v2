<?php
/**
*  Kemet Customizer Export
*/

class Import {
    /**
    *  WP_Customize_Manager.
    *
    * @access private
    * @var object $wp_customize
    */
    private $wp_customize;

    /**
    * Class constructor
    *
    * @param object
    */

    public function __construct( $wp_customize = null ) {
        $this->wp_customize = $wp_customize;
    }

    /**
    * Setup customizer import.
    */

    public function import() {
        global $wp_customize;

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $filename = $_FILES['import_file']['name'];

        if ( empty( $filename ) ) {
            return;
        }
        $file_ext  = explode( '.', $filename );
        $extension = end( $file_ext );

        if ( 'json' !== $extension ) {
            wp_die( esc_html__( 'Please upload a valid .json file', 'kemet-addons' ) );
        }

        $import_file = $_FILES['import_file']['tmp_name'];

        if ( empty( $import_file ) ) {
            wp_die( esc_html__( 'Please upload a file to import', 'kemet-addons' ) );
        }

        global $wp_filesystem;
        if ( empty( $wp_filesystem ) ) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }
        $file_contants = $wp_filesystem->get_contents( $import_file );
        $settings      = json_decode( $file_contants, 1 );

        delete_option( 'kemet-settings' );
        update_option( 'kemet-settings', $settings['customizer-settings'] );

        // Call the customize_save action.
		do_action( 'customize_save_after', $wp_customize );
       // die();
    }
}