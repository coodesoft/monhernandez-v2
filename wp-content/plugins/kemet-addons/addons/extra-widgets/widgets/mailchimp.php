<?php
/**
 * Mailchimp Widget.
 *
 * @package Kemet Addons
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mail_chimp_widgets = array(
  'title'       => __('Kemet Mailchimp', 'kemet-addons' ),
  'classname'   => 'kfw-widget-mail-chimp',
  'id'          => 'kemet-widget-mail-chimp',
  'description' => __('Mailchimp subscribe widget', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Subscribe', 'kemet-addons' ),
    ),
    array(
      'id'      => 'submit-text',
      'type'    => 'text',
      'title'   => __('Submit Text', 'kemet-addons' ),
      'default'   => __('Subscribe', 'kemet-addons' ),
    ),
    array(
        'id'          => 'button-align',
        'type'        => 'select',
        'title'       => __('Align button', 'kemet-addons' ),
        'options'     => array(
            'left' => __('Left', 'kemet-addons' ),
            'center' => __('Center', 'kemet-addons' ),
            'right' => __('Right', 'kemet-addons' ),   
        ),
        'default'   => 'left' 
    )
  )
);

if( ! function_exists( 'kemet_widget_mail_chimp' ) ) {
  function kemet_widget_mail_chimp( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }

     $submit_text = isset($instance['submit-text']) ? $instance['submit-text'] : 'Subscribe';
     $button_align = isset($instance['button-align']) ? $instance['button-align'] : 'left';
     $align = '';
     switch($button_align){
        case 'left':
            $align = 'margin-left: 0';
            break;
        case 'right':
            $align = 'margin-left: auto; margin-right: 0';
            break;
        case 'center':
            $align = 'margin: auto';
            break;    
     }
     $list = kmt_get_panel_option('kmt-mailchimp-list-id');

    $output = "";
    $output .='<div class="mailchimp-form">';

        $output .='<form class="kmt-mailchimp-form" name="kmt-mailchimp-form" action="'.esc_url( admin_url('admin-post.php') ).'" method="POST">';
            $output .='<div>';
                $output .='<input type="text" value="" name="email" placeholder="'.esc_html__("Email", 'kemet-addons').'">';
                $output .='<span class="alert warning">'.esc_html__('Invalid or empty email', 'kemet-addons').'</span>';
            $output .= '</div>';
                
            $output .='<div class="send-div">';
                $output .='<input type="submit" class="button" style="'.$align.'" value="'.esc_html__( $submit_text , 'kemet-addons').'" name="subscribe">';
                $output .='<div class="sending"></div>';
            $output .='</div>';

            $output .='<div class="kmt-mailchimp-success alert final success">'.esc_html__('You have successfully subscribed to the newsletter.', 'kemet-addons').'</div>';
            $output .='<div class="kmt-mailchimp-error alert final error">'.esc_html__('Something went wrong. Your subscription failed.', 'kemet-addons').'</div>';
                
            $output .='<input type="hidden" value="'.$list.'" name="list">';
            $output .='<input type="hidden" name="action" value="kmt_mailchimp" />';
            $output .= wp_nonce_field( "kmt_mailchimp_action", "kmt_mailchimp_nonce", false, false );

        $output .='</form>';
    $output .='</div>';

    echo $output; ?>

    <?php
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_mail_chimp" , $mail_chimp_widgets) );