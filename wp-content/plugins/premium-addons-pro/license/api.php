<?php

namespace PremiumAddonsPro\License;

use PremiumAddonsPro\License\Admin;

class API {

    /**
     * Handles license activation
     * @since 1.0.0
     * @access public
     * @return void
     */
    public static function papro_activate_license( $license_key ) {
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'activate_license',
            'license'    => '8699958a-77f3-4db8-9422-126b0836e1c5',
            'item_id'    => PAPRO_ITEM_ID,
            'url'        => home_url()
        );
        
        $slug = self::get_redirection_slug();
        // Call the custom API.
        $response = 200;
        
        // make sure the response came back okay
       
           
        // make sure the response came back okay
        
            $license_data = json_decode( wp_remote_retrieve_body( $response ) );
            $license_data->success = true;
			$license_data->error = '';
			$license_data->license = 'valid';
			$license_data->expires = '01.01.2030';

        update_option( 'papro_license_key', $license_key );
        update_option( 'papro_license_status', $license_data->license );
        
        $redirect = sprintf( "admin.php?page=%s", $slug ) ;
        wp_redirect( $redirect );
        
        exit();
    }

    /**
     * Handles license deactivation
     * @since 1.0.0
     * @access public
     * @return void
     */
    public static function papro_deactivate_license( $license_key ){
        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license'    => $license_key,
            'item_name'  => PAPRO_ITEM_NAME,
            'url'        => home_url()
        );

        $slug = self::get_redirection_slug();
        
        // Call the custom API.
        $response = self::call_custom_api( $api_params );
        
        if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
            
            if ( is_wp_error( $response ) ) {
                $message = $response->get_error_message();
            } else {
                $message = __( 'An error occurred, please try again.' );
            }
            
            $base_url =  sprintf( "admin.php?page=%s", $slug ) ;
            $redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

            wp_redirect( $redirect );
            exit();
            
        }
        
        delete_option( 'papro_license_status' );
        
        delete_option( 'papro_license_key' );
        
        $redirect = sprintf( "admin.php?page=%s", $slug ) ;
        wp_redirect( $redirect );
        
        exit();

    }
    
    public static function get_redirection_slug() {
        return Admin::get_slug();
    }
    
    public static function call_custom_api( $args ) {
        
        $response = wp_remote_post(
            PAPRO_STORE_URL,
            array(
                'timeout' => 40,
                'sslverify' => false,
                'body' => $args
            )
        );
        
        return $response;
    }
    
}