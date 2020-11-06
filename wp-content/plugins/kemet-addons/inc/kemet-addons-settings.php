<?php
/**
 * Kemet Panel Settings
 */

// Control core classes for avoid errors
if (class_exists('KFW')) {

    // Set a unique slug-like ID
    $prefix = 'kmt_framework';

    //
    // Create options
    KFW::createOptions($prefix, array(
    'menu_title' => __( 'Kemet', 'kemet-addons' ),
    'menu_slug' => 'kmt-framework',
    'class'  => 'kemet-addons-options',
    'show_search' => false,
    'show_all_options'  => false,
    'theme'   => 'light',
  ));

  $options = array(
    // A switcher field
    array(
      'id' => 'metabox',
      'type' => 'switcher',
      'title' => __( 'Single Page/Post Options', 'kemet-addons' ),
      'subtitle' => __('Enable/Disable the single page/post options that will allow you to individually customize your single page or post.', 'kemet-addons'),
      'default' => true,
    ),array(
      'id' => 'extra-headers',
      'type' => 'switcher',
      'title' => __( 'Advanced Headers', 'kemet-addons' ),
      'subtitle' => __('Enable/Disable more header layouts and no header option in both customizer and page/post options.', 'kemet-addons'),
      'default' => false,
    ),array(
      'id' => 'sticky-header',
      'type' => 'switcher',
      'title' => __( 'Sticky Header', 'kemet-addons'),
      'subtitle' => __('Enable/Disable Kemet sticky header options.', 'kemet-addons'),
      'default' => false,
    ),array(
      'id' => 'top-bar-section',
      'type' => 'switcher',
      'title' => __('Top Bar Section', 'kemet-addons'),
      'subtitle' => __('Enable/Disable the top bar area that includes right and left sections with unlimited content possibilities.', 'kemet-addons'),
      'default' => false,
      ),array(
      'id' => 'page-title',
      'type' => 'switcher',
      'title' => __('Page Title', 'kemet-addons'),
      'subtitle' => __('Enable/Disable the page title area that includes page/post title and breadcrumbs.', 'kemet-addons'),
      'default' => false,
    ),array(
      'id' => 'go-top',
      'type' => 'switcher',
      'title' => __( 'Go to Top Button', 'kemet-addons' ),
      'subtitle' => __('Enable/Disable the Go to Top button including its customization options.', 'kemet-addons'),
      'default' => false,
    ),array(
      'id' => 'extra-widgets',
      'type' => 'switcher',
      'title' => __('Extra Widgets', 'kemet-addons'),
      'subtitle' => __('Enable/Disable Kemet extra widgets that have been built to enrich your WordPress website.', 'kemet-addons'),
      'default' => false,
    ),array(
      'id' => 'blog-layouts',
      'type' => 'switcher',
      'title' => __('Blog Layouts', 'kemet-addons'),
      'subtitle' => __('Enable/Disable Extra Blog Layouts', 'kemet-ddons'),
      'default' => false,
    ),
    array(
      'id' => 'single-post',
      'type' => 'switcher',
      'title' => __('Single Post Options', 'kemet-addons'),
      'subtitle' => __('Enable/Disable the extra options that will allow you to customize your single post content.', 'kemet-addons'),
      'default' => false,
    ),
  );

  $woo_option = array(
    'id' => 'woocommerce',
    'type' => 'switcher',
    'title' => __('Woocommerce', 'kemet-addons'),
    'subtitle' => __('Enable/Disable the extra options that allows you to control & customize WooCommerce product page and product listing.', 'kemet-addons'),
    'default' => false,
  );
  if( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
    
    $woo_option += ['class' => 'hidden-field-input'];
    $woo_option += ['desc' => __('To use this add-on, please activate WooCommerce plugin.', 'kemet-addons')];
  }
  
  array_push( $options, $woo_option );
  
    $reset_import = array(
      'id' => 'reset-import-export',
      'type' => 'switcher',
      'title' => __('Customizer Reset, Import, and Export Buttons', 'kemet-addons'),
      'subtitle' => __('Enable/Disable the import, export and reset buttons that will give you the ability to apply any of those actions to the customizer settings.', 'kemet-addons'),
      'default' => false,
    );

    array_push( $options, $reset_import );
    //
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'primary_tab',
    'title' => __( 'Customizer & Page Options', 'kemet-addons' ),
    'priority' => '1',
    'fields' => $options,
  ),
    // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'integrations_tab',
    'title' => __( 'Integrations', 'kemet-addons'),
    'priority' => '5',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'kmt-mailchimp-api-key',
        'type' => 'text',
        'title' => __( 'Mailchimp API Key', 'kemet-addons' ),
        'subtitle' => sprintf(esc_html__('Used for the MailChimp widget which working with Extra Widgets Addon. %1$sFollow this article%2$s to get your API Key.', 'kemet-addons'), '<a href="https://mailchimp.com/help/about-api-keys/" target="_blank">', '</a>' ),
      ),array(
        'id' => 'kmt-mailchimp-list-id',
        'type' => 'text',
        'title' => __( 'Mailchimp List ID', 'kemet-addons' ),
        'subtitle' => sprintf(esc_html__('Used for the MailChimp widget which working with Extra Widgets Addon. %1$sFollow this article%2$s to get your List ID.', 'kemet-addons'), '<a href="https://mailchimp.com/help/find-audience-id/" target="_blank">', '</a>' ),
      ),
    ),
  ),
      // Create a sub-tab
      KFW::createSection($prefix, array(
      'id' => 'plugins_tab',
      'title' => __( 'Plugins', 'kemet-addons'),
      'priority' => '10',
      'reset_options' => false,
      'fields' => array(
        // A Card field
        array(
          'id' => 'plugins',
          'type' => 'plugins',
          'plugins' => array(
            'elementor',
            'premium-addons-for-elementor',
            'premium-blocks-for-gutenberg',
          ),
        ),
      ),
    )),
      // Create a sub-tab
    KFW::createSection($prefix, array(
    'id' => 'info_tab',
    'title' => __( 'System Info', 'kemet-addons'),
    'reset_options' => false,
    'priority' => '15',
    'fields' => array(
      // A switcher field
      array(
        'id' => 'system-info-php',
        'type' => 'systeminfo',
      ),
    ),
  )
    )));

  
}

