<?php
/**
* WooCommerce Options for Kemet Theme.
*
* @package     Kemet
* @author      Kemet
* @copyright   Copyright ( c ) 2019, Kemet
* @link        https://kemet.io/
* @since       Kemet 1.1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$defaults = Kemet_Theme_Options::defaults();

/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-shop-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Shop Settings', 'kemet' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 10,
            'settings' => array(),
        )
    )
);
/**
* Option: Blog - Disable Breadcrumb
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[disable-shop-breadcrumb]', array(
        'default'           => $defaults[ 'disable-shop-breadcrumb' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[disable-shop-breadcrumb]', array(
        'type'    => 'checkbox',
        'section' => 'woocommerce_product_catalog',
        'label'   => __( 'Disable Breadcrumb', 'kemet' ),
        'priority'          => 10,
    )
);
/**
* Option: Shop Columns
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-grids]', array(
        'default'           => kemet_get_option('shop-grids'),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_select' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Select(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-grids]', array(
            'type'           => 'kmt-responsive-select',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 10,
            'label'          => __( 'Shop Columns', 'kemet' ),
            'choices'   => array(
                '1' => 'One',
                '2' => 'Two',
                '3' => 'Three',
                '4' => 'Four',
                '5' => 'Five',
                '6' => 'Six',
            ),
        )
    )
);

/**
* Option: Products Per Page
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-no-of-products]', array(
        'default'           => kemet_get_option( 'shop-no-of-products' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[shop-no-of-products]', array(
        'section'     => 'woocommerce_product_catalog',
        'label'       => __( 'Products Per Page', 'kemet' ),
        'type'        => 'number',
        'priority'    => 15,
        'input_attrs' => array(
            'min'  => 1,
            'step' => 1,
            'max'  => 50,
        ),
    )
);

/**
* Option: Product Hover Style
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-hover-style]', array(
        'default'           => kemet_get_option( 'shop-hover-style' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);

$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[shop-hover-style]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 20,
        'label'    => __( 'Product Image Hover Style', 'kemet' ),
        'choices'  => apply_filters(
            'kemet_woo_shop_hover_style',
            array(
                ''     => __( 'None', 'kemet' ),
                'swap' => __( 'Swap Images', 'kemet' ),
            )
        ),
    )
);

/**
* Option: Single Post Meta
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-product-structure]', array(
        'default'           => kemet_get_option( 'shop-product-structure' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
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
* Option: Shop Archive Content Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-archive-width]', array(
        'default'           => kemet_get_option( 'shop-archive-width' ),
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[shop-archive-width]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 35,
        'label'    => __( 'Shop Archive Content Width', 'kemet' ),
        'choices'  => array(
            'default' => __( 'Default', 'kemet' ),
            'custom'  => __( 'Custom', 'kemet' ),
        ),
    )
);
/**
* Option: Enter Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[shop-archive-max-width]', array(
        'default'           => 1200,
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[shop-archive-width]', 
            'conditions' => '==', 
            'values' => 'custom',
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[shop-archive-max-width]', array(
            'type'        => 'kmt-slider',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 36,
            'label'       => __( 'Enter Width', 'kemet' ),
            'suffix'      => '',
            'input_attrs' => array(
                'min'  => 768,
                'step' => 1,
                'max'  => 1920,
            ),
        )
    )
);
/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-product-title-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Product Title Style', 'kemet' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 37,
            'settings' => array(),
        )
    )
);
/**
* Option: Content Text Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-title-text-color]', array(
        'default'           => $defaults[ 'product-title-text-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-title-text-color]', array(
            'label'   => __( 'Font Color', 'kemet' ),
            'priority'       => 37,
            'section' => 'woocommerce_product_catalog',
        )
    )
);
 /**
* Option:  Product Title Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-title-font-size]', array(
        'default'           => kemet_get_option( 'product-title-font-size' ),
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-title-font-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 37,
            'label'          => __( 'Font Size', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 1,
                    'step' => 1,
                    'max' =>200,
                ),
                'em' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);

/**
* Option: Font Family
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-title-font-family]', array(
        'default'           => $defaults[ 'product-title-font-family' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-title-font-family]', array(
            'type'        => 'kmt-font-family',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 37,
            'label'       => __( 'Font Family', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[product-title-font-weight]',
        )
    )
);

/**
* Option: Font Weight
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-title-font-weight]', array(
        'default'           => $defaults[ 'product-title-font-weight' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-title-font-weight]', array(
            'type'        => 'kmt-font-weight',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 37,
            'label'       => __( 'Font Weight', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[product-title-font-family]',
        )
    )
);

/**
* Option: Text Transform
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-title-text-transform]', array(
        'default'           => $defaults[ 'product-title-text-transform' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[product-title-text-transform]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 37,
        'label'    => __( 'Text Transform', 'kemet' ),
        'choices'  => array(
            ''           => __( 'Default', 'kemet' ),
            'none'       => __( 'None', 'kemet' ),
            'capitalize' => __( 'Capitalize', 'kemet' ),
            'uppercase'  => __( 'Uppercase', 'kemet' ),
            'lowercase'  => __( 'Lowercase', 'kemet' ),
        ),
    )
);

/**
* Option: Line Height
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-title-line-height]', array(
        'default'           => $defaults[ 'product-title-line-height' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-title-line-height]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 37,
            'label'          => __( 'Line Height', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' =>100,
                ),
                'em' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 10,
                ),
                '%' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 100,
                ),
            ),
        )
    )
);
/**
* Option: Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[letter-spacing-product-title]', array(
        'default'           => $defaults[ 'letter-spacing-product-title' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[letter-spacing-product-title]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 37,
            'label'          => __( 'Letter Spacing', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);


/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-product-content-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Product Content Style', 'kemet' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 38,
            'settings' => array(),
        )
    )
);
/**
* Option: Content Text Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-text-color]', array(
        'default'           => $defaults[ 'product-content-text-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-text-color]', array(
            'label'   => __( 'Font Color', 'kemet' ),
            'priority'       => 38,
            'section' => 'woocommerce_product_catalog',
        )
    )
);

 /**
* Option:  Product Content Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-font-size]', array(
        'default'           => kemet_get_option( 'product-content-font-size' ),
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-font-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 38,
            'label'          => __( 'Font Size', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 1,
                    'step' => 1,
                    'max' =>200,
                ),
                'em' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);

/**
* Option: Font Family
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-font-family]', array(
        'default'           => $defaults[ 'product-content-font-family' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-font-family]', array(
            'type'        => 'kmt-font-family',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 38,
            'label'       => __( 'Font Family', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[product-content-font-weight]',
        )
    )
);

/**
* Option: Font Weight
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-font-weight]', array(
        'default'           => $defaults[ 'product-content-font-weight' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-font-weight]', array(
            'type'        => 'kmt-font-weight',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 38,
            'label'       => __( 'Font Weight', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[product-content-font-family]',
        )
    )
);

/**
* Option: Text Transform
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-text-transform]', array(
        'default'           => $defaults[ 'product-content-text-transform' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[product-content-text-transform]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 38,
        'label'    => __( 'Text Transform', 'kemet' ),
        'choices'  => array(
            ''           => __( 'Default', 'kemet' ),
            'none'       => __( 'None', 'kemet' ),
            'capitalize' => __( 'Capitalize', 'kemet' ),
            'uppercase'  => __( 'Uppercase', 'kemet' ),
            'lowercase'  => __( 'Lowercase', 'kemet' ),
        ),
    )
);

/**
* Option: Line Height
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-content-line-height]', array(
        'default'           => $defaults[ 'product-content-line-height' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-content-line-height]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 38,
            'label'          => __( 'Line Height', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' =>100,
                ),
                'em' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 10,
                ),
                '%' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 100,
                ),
            ),
        )
    )
);
/**
* Option: Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[letter-spacing-product-content]', array(
        'default'           => $defaults[ 'letter-spacing-product-content' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[letter-spacing-product-content]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 38,
            'label'          => __( 'Letter Spacing', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);

/**
 * Option: Title
 */
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-product-price-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Product Price Style', 'kemet' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 39,
            'settings' => array(),
        )
    )
);
/**
* Option: Content Text Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-price-text-color]', array(
        'default'           => $defaults[ 'product-price-text-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-price-text-color]', array(
            'label'   => __( 'Font Color', 'kemet' ),
            'priority'       => 39,
            'section' => 'woocommerce_product_catalog',
        )
    )
);

 /**
* Option:  Product Price Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-price-font-size]', array(
        'default'           => kemet_get_option( 'product-price-font-size' ),
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-price-font-size]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 39,
            'label'          => __( 'Product Price Font Size', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 1,
                    'step' => 1,
                    'max' =>200,
                ),
                'em' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);
/**
* Option: Font Family
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-price-font-family]', array(
        'default'           => $defaults[ 'product-price-font-family' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-price-font-family]', array(
            'type'        => 'kmt-font-family',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 39,
            'label'       => __( 'Font Family', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[product-price-font-weight]',
        )
    )
);

/**
* Option: Font Weight
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-price-font-weight]', array(
        'default'           => $defaults[ 'product-price-font-weight' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-price-font-weight]', array(
            'type'        => 'kmt-font-weight',
            'section'     => 'woocommerce_product_catalog',
            'priority'    => 39,
            'label'       => __( 'Font Weight', 'kemet' ),
            'connect'     => KEMET_THEME_SETTINGS . '[product-price-font-family]',
        )
    )
);

/**
* Option: Text Transform
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-price-text-transform]', array(
        'default'           => $defaults[ 'product-price-text-transform' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[product-price-text-transform]', array(
        'type'     => 'select',
        'section'  => 'woocommerce_product_catalog',
        'priority' => 39,
        'label'    => __( 'Text Transform', 'kemet' ),
        'choices'  => array(
            ''           => __( 'Default', 'kemet' ),
            'none'       => __( 'None', 'kemet' ),
            'capitalize' => __( 'Capitalize', 'kemet' ),
            'uppercase'  => __( 'Uppercase', 'kemet' ),
            'lowercase'  => __( 'Lowercase', 'kemet' ),
        ),
    )
);

/**
* Option: Line Height
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[product-price-line-height]', array(
        'default'           => $defaults[ 'product-price-line-height' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[product-price-line-height]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 39,
            'label'          => __( 'Line Height', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' =>100,
                ),
                'em' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 10,
                ),
                '%' => array(
                    'min' => 0,
                    'step' => 1,
                    'max' => 100,
                ),
            ),
        )
    )
);
/**
* Option: Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[letter-spacing-product-price]', array(
        'default'           => $defaults[ 'letter-spacing-product-price' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[letter-spacing-product-price]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'woocommerce_product_catalog',
            'priority'       => 39,
            'label'          => __( 'Letter Spacing', 'kemet' ),
            'unit_choices'   => array(
                'px' => array(
                    'min' => 0.1,
                    'step' => 0.1,
                    'max' => 10,
                ),
            ),
        )
    )
);
