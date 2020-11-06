<?php
$defaults = Kemet_Theme_Options::defaults();
/**
* Option: General
*/
/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-on-sale-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'On Sale Badge', 'kemet-addons' ),
            'section'  => 'section-woo-general',
            'priority' => 5,
            'settings' => array(),
        )
    )
);
/**
* Option: Sale Notification
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[sale-style]', array(
        'default'           => $defaults['sale-style'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[sale-style]', array(
        'type'     => 'select',
        'section'  => 'section-woo-general',
        'priority' => 5,
        'label'    => __( 'Sale Notification', 'kemet-addons' ),
        'choices'  => array(
            '100%' => __( 'Circle', 'kemet-addons' ),
            '0'   => __( 'Square', 'kemet-addons' ),
        ),
    )
);
/**
* Option: Sale Notification
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[sale-content]', array(
        'default'           => $defaults['sale-content'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[sale-content]', array(
        'type'     => 'select',
        'section'  => 'section-woo-general',
        'priority' => 10,
        'label'    => __( 'Sale Notification Content', 'kemet-addons' ),
        'choices'  => array(
            'sale-text' => __( 'Text', 'kemet-addons' ),
            'percent'   => __( 'Percentage', 'kemet-addons' ),
        ),
    )
);

/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-wishlist]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Wishlist', 'kemet-addons' ),
            'description' => __( 'You need to activate the <a target="_blank" href="https://wordpress.org/plugins/ti-woocommerce-wishlist/">TI WooCommerce Wishlist</a> plugin to add a wishlist button and icon', 'kemet-addons' ),
            'section'  => 'section-woo-general',
            'priority' => 14,
            'settings' => array(),
        )
    )
);
/**
 * Option: Vertical Headers Enable Box Shadow
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[wishlist-in-header]', array(
        'default'           => $defaults[ 'wishlist-in-header' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[wishlist-in-header]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-general',
        'label'           => __( 'Add Wishlist Header', 'kemet-addons' ),
        'priority'        => 15,
    )
);
/**
* Option: Shop
*/

/**
* Option: Shop Layout
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-layout]', array(
        'default'           => $defaults['shop-layout'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[shop-layout]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 36,
        'label'    => __( 'Shop Layout', 'kemet-addons' ),
        'choices'  => array(
            'shop-grid'   => __( 'Grid', 'kemet-addons' ),
            'hover-style' => __( 'Hover Style', 'kemet-addons' ),
        ),
    )
);

/**
 * Option: Enable Sticky Header 
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-quick-view]', array(
        'default'           => $defaults[ 'enable-quick-view' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[enable-quick-view]', array(
        'type'            => 'checkbox',
        'section'         => 'woocommerce_product_catalog',
        'label'           => __( 'Enable Quick View', 'kemet-addons' ),
        'priority'        => 36,
    )
);
/**
 * Option: Title
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-quick-view-title]', array(
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[enable-quick-view]/'.KEMET_THEME_SETTINGS . '[shop-layout]', 
            'conditions' => '==/!=', 
            'values' => '1/hover-style',
            'operators' => "&&",
        ), 
        'sanitize_callback' 	=> 'wp_kses',
    )
);
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-quick-view-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Quick View Settings', 'kemet-addons' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 36,
        )
    )
);
/**
* Option: Quick View
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[quick-view-style]', array(
        'default'           => $defaults['quick-view-style'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-layout]/' . KEMET_THEME_SETTINGS . '[enable-quick-view]', 
            'conditions' => '==/==', 
            'values' => 'shop-grid/'.true,
            'operators' => '&&',
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[quick-view-style]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 36,
        'label'    => __( 'Quick View Position', 'kemet-addons' ),
        'choices'  => array(
            'qv-icon'   => __( 'Icon', 'kemet-addons' ),
            'on-image'   => __( 'On Image Click', 'kemet-addons' ),
            'after-summary'   => __( 'After Summary', 'kemet-addons' ),
        ),
    )
);

/**
* Option: Shop Structure 
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-list-product-structure]', array(
        'default'           => kemet_get_option( 'shop-list-product-structure' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-layout]', 
            'conditions' => '==', 
            'values' => 'hover-style',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-list-product-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'woocommerce_product_catalog',
            'priority' => 55,
            'label'    => __( 'Product Structure', 'kemet' ),
            'choices'  => array(
                'title'      => __( 'Title', 'kemet' ),
                'price'      => __( 'Price', 'kemet' ),
                'ratings'    => __( 'Ratings', 'kemet' ),
                'short_desc' => __( 'Short Description', 'kemet' ),
                'add_cart'   => __( 'Add To Cart', 'kemet' ),
                'category'   => __( 'Category', 'kemet' ),
            ),
        )
    )
);
/**
* Option: Shop Structure 
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-list-style-structure]', array(
        'default'           => kemet_get_option( 'shop-list-style-structure' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-layout]', 
            'conditions' => '==', 
            'values' => 'hover-style',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-list-style-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'woocommerce_product_catalog',
            'priority' => 55,
            'label'    => __( 'List Style Structure', 'kemet' ),
            'choices'  => array(
                'title'      => __( 'Title', 'kemet' ),
                'price'      => __( 'Price', 'kemet' ),
                'ratings'    => __( 'Ratings', 'kemet' ),
                'short_desc' => __( 'Short Description', 'kemet' ),
                'add_cart'   => __( 'Add To Cart', 'kemet' ),
                'category'   => __( 'Category', 'kemet' ),
            ),
        )
    )
);
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-pagination-group-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Pagination Settings', 'kemet-addons' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 59,
            'settings' => array(),
        )
    )
);
/**
* Option: Pagination Style
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[woo-pagination-style]', array(
        'default'           => $defaults['woo-pagination-style'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[woo-pagination-style]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 60,
        'label'    => __( 'Pagination Style', 'kemet-addons' ),
        'choices'  => array(
            'standard' => __( 'Standard', 'kemet-addons' ),
            'infinite-scroll'   => __( 'Infinite Scroll', 'kemet-addons' ),
        ),
    )
);
/**
 * Option: Infinite Scroll: Last Text
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[infinite-scroll-last-text]', array(
        'default'           => $defaults[ 'infinite-scroll-last-text' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[woo-pagination-style]', 
            'conditions' => '==', 
            'values' => 'infinite-scroll',
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[infinite-scroll-last-text]', array(
        'section'  => 'woocommerce_product_catalog',
        'priority' => 65,
        'label'    => __( 'Infinite Scroll: Last Text', 'kemet-addons' ),
        'type'     => 'text',
    )
);
/**
 * Option: Loader Color
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[infinite-scroll-loader-color]', array(
        'default'           => $defaults[ 'infinite-scroll-loader-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[woo-pagination-style]', 
            'conditions' => '==', 
            'values' => 'infinite-scroll',
        ),
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize, KEMET_THEME_SETTINGS . '[infinite-scroll-loader-color]', array(
            'section' => 'woocommerce_product_catalog',
            'label'   => __( 'Infinite Scroll Loader Color', 'kemet-addons' ),
            'priority'=>70,
        )
    )
);
/**
* Option: Shop Product Structure
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-product-structure]', array(
        'default'           => kemet_get_option( 'shop-product-structure' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-layout]', 
            'conditions' => '==', 
            'values' => 'shop-grid',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-product-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'woocommerce_product_catalog',
            'priority' => 60,
            'label'    => __( 'Shop Product Structure', 'kemet' ),
            'choices'  => array(
                'short_desc' => __( 'Short Description', 'kemet' ),
                'add_cart'   => __( 'Add To Cart', 'kemet' ),
                'category'   => __( 'Category', 'kemet' ),
            ),
        )
    )
);
/**
* Option: Product Content Alignment
*/

$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-alignment]', array(
        'default'           => $defaults[ 'product-content-alignment' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Icon_Select(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-alignment]', array(
            'priority'       => 36,
            'section' => 'woocommerce_product_catalog',
            'label'   => __( 'Product Content Alignment', 'kemet-addons' ),
            'choices'  => array(
                'left' => array(
                    'icon' => 'dashicons-editor-alignleft'
                ),
                'center' => array(
                    'icon' => 'dashicons-editor-aligncenter'
                ),
                'right' => array(
                    'icon' => 'dashicons-editor-alignright'
                ),	
            ),
        )
    )
);

/**
* Option: Enable Filter Button
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-filter-button]', array(
        'default'           => $defaults[ 'enable-filter-button' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[enable-filter-button]', array(
        'type'            => 'checkbox',
        'section'         => 'woocommerce_product_catalog',
        'label'           => __( 'Enable Filter Button', 'kemet-addons' ),
        'priority'        => 80,
    )
);

/**
 * Option: Title
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[kmt-filter-title]', array(
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[enable-filter-button]', 
            'conditions' => '==', 
            'values' => '1',
        ), 
        'sanitize_callback' 	=> 'wp_kses',
    )
);
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-filter-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Filter Settings', 'kemet-addons' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 80,
        )
    )
);

/**
 * Option: Filter Button Text
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[off-canvas-filter-label]', array(
        'default'           => $defaults[ 'off-canvas-filter-label' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[enable-filter-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[off-canvas-filter-label]', array(
        'section'  => 'woocommerce_product_catalog',
        'priority' => 80,
        'label'    => __( 'Filter Button Text', 'kemet-addons' ),
        'type'     => 'text',
    )
);
/**
* Option: Single Product
*/

/**
 * Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-single-product-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Single Product Settings', 'kemet-addons' ),
            'section'  => 'section-woo-shop-single',
            'priority' => 1,
            'settings' => array(),
        )
    )
);

/**
* Option: Ajax Add To Cart
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]', array(
        'default'           => $defaults[ 'enable-single-ajax-add-to-cart' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[enable-single-ajax-add-to-cart]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-shop-single',
        'label'           => __( 'Enable Ajax Add To Cart', 'kemet-addons' ),
        'priority'        => 15,
    )
);
/**
* Option: Enable Product Navigation
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[enable-product-navigation]', array(
        'default'           => $defaults[ 'enable-product-navigation' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[enable-product-navigation]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-shop-single',
        'label'           => __( 'Enable Product Navigation', 'kemet-addons' ),
        'priority'        => 16,
    )
);
/**
* Option: Gallary Style
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-gallery-style]', array(
        'default'           => $defaults['product-gallery-style'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[product-gallery-style]', array(
        'type'     => 'select',
        'section'  => 'section-woo-shop-single',
        'priority' => 20,
        'label'    => __( 'Gallery Style', 'kemet-addons' ),
        'choices'  => array(
            'horizontal' => __( 'Horizontal', 'kemet-addons' ),
            'vertical'   => __( 'Vertical', 'kemet-addons' ),
        ),
    )
);
/**
* Option: Image Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-image-width]', array(
        'default'           => $defaults['product-image-width'],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-image-width]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 25,
            'label'       => __( 'Image Width (%)', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 1,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);
/**
 * Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-related-products-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Related Products Settings', 'kemet-addons' ),
            'section'  => 'section-woo-shop-single',
            'priority' => 35,
            'settings' => array(),
        )
    )
);
/**
* Option: Disable Related Products
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[disable-related-products]', array(
        'default'           => $defaults[ 'disable-related-products' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[disable-related-products]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-shop-single',
        'label'           => __( 'Disable Related Products', 'kemet-addons' ),
        'priority'        => 35,
    )
);
/**
* Option: Related Products Count
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[related-products-count]', array(
        'default'           => $defaults['related-products-count'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[disable-related-products]', 
            'conditions' => '==', 
            'values' => false,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[related-products-count]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 40,
            'label'       => __( 'Related Products Count', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 3,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);
/**
* Option: Related Products Colunms
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[related-products-colunms]', array(
        'default'           => $defaults['related-products-colunms'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[disable-related-products]', 
            'conditions' => '==', 
            'values' => false,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[related-products-colunms]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 45,
            'label'       => __( 'Related Products Columns', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 1,
                'step' => 1,
                'max'  => 6,
            ),
        )
    )
);

/**
 * Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-up-sells-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Up-Sells Products Settings', 'kemet-addons' ),
            'section'  => 'section-woo-shop-single',
            'priority' => 50,
            'settings' => array(),
        )
    )
);

/**
* Option: Disable Up-Sells
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[disable-up-sells-products]', array(
        'default'           => $defaults[ 'disable-up-sells-products' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[disable-up-sells-products]', array(
        'type'            => 'checkbox',
        'section'         => 'section-woo-shop-single',
        'label'           => __( 'Disable Up-Sells Products', 'kemet-addons' ),
        'priority'        => 50,
    )
);
/**
* Option: Up-Sells Count
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[up-sells-products-count]', array(
        'default'           => $defaults['up-sells-products-count'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[disable-up-sells-products]', 
            'conditions' => '==', 
            'values' => false,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[up-sells-products-count]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 55,
            'label'       => __( 'Up-Sells Count', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 3,
                'step' => 1,
                'max'  => 100,
            ),
        )
    )
);
/**
* Option: Up-Sells Colunms
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[up-sells-products-colunms]', array(
        'default'           => $defaults['up-sells-products-colunms'],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[disable-up-sells-products]', 
            'conditions' => '==', 
            'values' => false,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[up-sells-products-colunms]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-woo-shop-single',
            'priority'    => 60,
            'label'       => __( 'Up-Sells Columns', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 1,
                'step' => 1,
                'max'  => 6,
            ),
        )
    )
);