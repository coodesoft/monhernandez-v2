<?php
$login_form_widgets = array(
  'title'       => __('Kemet Login Form', 'kemet-addons' ),
  'classname'   => 'kfw-widget-login-form',
  'id'          => 'kemet-widget-login-form',
  'description' => __('Login Form', 'kemet-addons' ),
  'fields'      => array(
    array(
      'id'      => 'title',
      'type'    => 'text',
      'title'   => __('Title:', 'kemet-addons' ),
      'default'   => __('Login Form', 'kemet-addons' ),
    ),
  )
);

if( ! function_exists( 'kemet_widget_login_form' ) ) {
  function kemet_widget_login_form( $args, $instance ,$id) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', esc_attr($instance['title'], 'kemet-addons' ) ) . $args['after_title'];
    }
    global $user_identity;
    $redirect = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    ?>
    <?php if ( is_user_logged_in() ) : ?>
        <p><?php esc_html_e( 'You are logged in as', 'kemet-addons' ); ?> <strong><?php echo esc_attr($user_identity, 'kemet-addons' ); ?></strong>.</p>	
        <ul>
            <li><a href="<?php echo esc_url( get_dashboard_url() ); ?>"><?php echo esc_attr( 'Dashboard', 'kemet-addons' ); ?> </a></li>
            <li><a href="<?php echo esc_url( get_edit_user_link() ); ?>"><?php echo esc_attr( 'Your Profile', 'kemet-addons' ); ?> </a></li>
            <li><a href="<?php echo esc_url( wp_logout_url( $redirect ) ); ?>"><?php echo esc_attr( 'Logout', 'kemet-addons' ); ?> </a></li>
        </ul>
    <?php else : ?>
        <div>
            <?php wp_login_form( array() ); ?>
        </div>
        <ul>
            <?php if ( get_option( 'users_can_register' ) ) : ?>
                <li><a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php echo esc_attr( 'Register', 'kemet-addons' ); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php echo esc_attr( 'Lost your password?', 'kemet-addons' ); ?></a></li>
        </ul>
    <?php   
    endif;
    echo $args['after_widget']; 
  } 
}

register_widget( Kemet_Create_Widget::instance( "kemet_widget_login_form" , $login_form_widgets) );