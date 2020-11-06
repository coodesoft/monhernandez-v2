<?php
/**
 * Kemet Notification Helper
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.4
 */

class Kemet_Notification_Helper{
    /**
     * Instance
     *
     * @access private
     * @var object
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
     * Get Button Html
     */
    public static function get_btn_html($slug){
        $plugin_path = $slug . '/'. $slug . '.php';
        $install_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='.$slug.'' ), 'install-plugin_'.$slug );
        $activate_url   = wp_nonce_url( 'plugins.php?action=activate&plugin=' . $plugin_path . '&plugin_status=all&paged=1&amp;s', 'activate-plugin_' . $plugin_path ); 
        if ( is_file( ABSPATH . 'wp-content/plugins/' . $plugin_path ) ) {
            if ( ! is_plugin_active($plugin_path) ) {
                $button_label = __( 'Activate', 'kemet' );
                $status = 'activate';
                $button = '<a class="button button-primary kmt-plugin" data-status = '.$status.'  data-url-activate = '.$activate_url.' onclick="plugin_action(event)" >' . $button_label . '</a>';
            }
        } else {
            if ( current_user_can( 'install_plugins' ) ) {
                $status = 'install';
                $button_label = __( 'Install and Activate', 'kemet' );
                $button = '<a class="button button-primary kmt-plugin" data-status = '.$status.' data-url-install = '.$install_url.'  data-url-activate = '.$activate_url.' onclick="plugin_action(event)" >' . $button_label . '</a>'; 
            }
         }
        
        return $button;
    }
}
