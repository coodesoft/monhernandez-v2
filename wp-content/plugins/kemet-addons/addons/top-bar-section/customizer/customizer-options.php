<?php
/**
 * Top Bar Section Customizer
 * 
 * @package Kemet Addons
 */
$defaults = Kemet_Theme_Options::defaults();
	/**
	 * Option: Top Bar Section 1 Item/s
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-1]', array(
			'default'           => $defaults[ 'top-section-1' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Sortable(
			$wp_customize, KEMET_THEME_SETTINGS . '[top-section-1]', array(
			'type'     => 'kmt-sortable',
			'section'  => 'section-topbar-header',
			'priority' => 5,
			'label'    => __( 'Top Bar Section 1 Item/s', 'kemet-addons' ),
			'choices'  => array(
					'search'    => __( 'Search', 'kemet-addons' ),
					'menu' => __( 'Menu', 'kemet-addons' ),
					'widget'    => __( 'Widget', 'kemet-addons' ),
					'text-html' => __( 'Text/HTML', 'kemet-addons' ),
				),
			)
		)
	);
	/**
	 * Option: Right Section Text / HTML
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-1-html]', array(
			'default'           => $defaults[ 'top-section-1-html' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[top-section-1]', 
				'conditions' => 'inarray', 
				'values' => 'text-html',
			), 
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-section-1-html]', array(
			'type'     => 'textarea',
			'section'  => 'section-topbar-header',
			'priority' => 10,
			'label'    => __( 'Custom Text/HTML', 'kemet-addons' ),
		)
	);
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			KEMET_THEME_SETTINGS . '[topbar-section-1-html]', array(
				'selector'            => '.kemet-top-header-section-1',
				'container_inclusive' => true,
				'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_1_html' ),
			)
		);
	}
	/**
	 * Option: Top Bar Section 1 Item/s Alignment
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[section1-content-align]', array(
			'default'           => $defaults[ 'section1-content-align' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[top-section-1]', 
				'conditions' => 'notEmpty', 
				'values' => '',
			),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Icon_Select(
			$wp_customize, KEMET_THEME_SETTINGS . '[section1-content-align]', array(
				'priority'       => 15,
				'section' => 'section-topbar-header',
				'label'   => __( 'Section 1 Item/s Alignment', 'kemet-addons' ),
				'choices'  => array(
					'flex-start' => array(
						'icon' => 'dashicons-editor-alignleft'
					),
					'center' => array(
						'icon' => 'dashicons-editor-aligncenter'
					),
					'flex-end' => array(
						'icon' => 'dashicons-editor-alignright'
					),	
				),
			)
		)
	);
	/**
	 * Option: Top Bar Section 2 Item/s
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-2]', array(
			'default'           => $defaults[ 'top-section-2' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Sortable(
			$wp_customize, KEMET_THEME_SETTINGS . '[top-section-2]', array(
			'type'     => 'kmt-sortable',
			'section'  => 'section-topbar-header',
			'priority' => 20,
			'label'    => __( 'Top Bar Section 2 Item/s', 'kemet-addons' ),
			'choices'  => 
				array(
					'search'    => __( 'Search', 'kemet-addons' ),
					'menu' => __( 'Menu', 'kemet-addons' ),
					'widget'    => __( 'Widget', 'kemet-addons' ),
					'text-html' => __( 'Text/HTML', 'kemet-addons' ),
				),
			)
		)
	);

	/**
	 * Option: Right Section Text / HTML
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
			'default'           => $defaults[ 'top-section-2-html' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[top-section-2]', 
				'conditions' => 'inarray', 
				'values' => 'text-html',
			), 
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
			'type'     => 'textarea',
			'section'  => 'section-topbar-header',
			'priority' => 25,
			'label'    => __( 'Custom Text/HTML', 'kemet-addons' ),
		)
	);

		if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			KEMET_THEME_SETTINGS . '[top-section-2-html]', array(
				'selector'            => '.kemet-top-header-section-2',
				'container_inclusive' => true,
				'render_callback'     => array( 'Kemet_Customizer_Partials', '_render_topbar_section_2_html' ),
			)
		);
	}
	/**
	 * Option: Top Bar Section 2 Item/s Alignment
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[section2-content-align]', array(
			'default'           => $defaults[ 'section2-content-align' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[top-section-2]', 
				'conditions' => 'notEmpty', 
				'values' => '',
			),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Icon_Select(
			$wp_customize, KEMET_THEME_SETTINGS . '[section2-content-align]', array(
				'priority'       => 28,
				'section' => 'section-topbar-header',
				'label'   => __( 'Section 2 Item/s Alignment', 'kemet-addons' ),
				'choices'  => array(
					'flex-start' => array(
						'icon' => 'dashicons-editor-alignleft'
					),
					'center' => array(
						'icon' => 'dashicons-editor-aligncenter'
					),
					'flex-end' => array(
						'icon' => 'dashicons-editor-alignright'
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
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-top-bar-title]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Top Bar Settings', 'kemet-addons' ),
				'section'  => 'section-topbar-header',
				'priority' => 30,
				'settings' => array(),
			)
		)
	);
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-item-padding]', array(
			'default'           => $defaults[ 'topbar-item-padding' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-item-padding]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 35,
				'label'          => __( 'Item Spacing', 'kemet-addons' ),
				'linked_choices' => true,
				'unit_choices'   => array( 'px', 'em', '%' ),
				'choices'        => array(
						'top'    => __( 'Top', 'kemet-addons' ),
						'right'  => __( 'Right', 'kemet-addons' ),
						'bottom' => __( 'Bottom', 'kemet-addons' ),
						'left'   => __( 'Left', 'kemet-addons' ),
				),
			)
		)
	);    
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-padding]', array(
			'default'           => $defaults[ 'topbar-padding' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-padding]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 33,
				'label'          => __( 'Padding', 'kemet-addons' ),
				'linked_choices' => true,
				'unit_choices'   => array( 'px', 'em', '%' ),
				'choices'        => array(
						'top'    => __( 'Top', 'kemet-addons' ),
						'right'  => __( 'Right', 'kemet-addons' ),
						'bottom' => __( 'Bottom', 'kemet-addons' ),
						'left'   => __( 'Left', 'kemet-addons' ),
				),
			)
		)
	);
    /**
    * Option - Top Bar Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-border-size]', array(
			'default'           => $defaults[ 'topbar-border-size' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-border-size]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-topbar-header',
				'priority'       => 40,
				'label'          => __( 'Border Size', 'kemet-addons' ),
				'linked_choices' => true,
				'unit_choices'   => array( 'px', 'em'),
				'choices'        => array(
						'top'    => __( 'Top', 'kemet-addons' ),
						'right'  => __( 'Right', 'kemet-addons' ),
						'bottom' => __( 'Bottom', 'kemet-addons' ),
						'left'   => __( 'Left', 'kemet-addons' ),
				),
			)
		)
	);
	
	/**
	 * Option: Top Bar Font Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-font-size]', array(
			'default'           => $defaults[ 'topbar-font-size' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-font-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-topbar-header',
				'priority'       => 45,
				'label'          => __( 'Font Size', 'kemet-addons' ),
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
		KEMET_THEME_SETTINGS . '[top-bar-font-family]', array(
			'default'           => $defaults[ 'top-bar-font-family' ],
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new Kemet_Control_Typography(
			$wp_customize, KEMET_THEME_SETTINGS . '[top-bar-font-family]', array(
				'type'        => 'kmt-font-family',
				'section'     => 'section-topbar-header',
				'priority'    => 46,
				'label'       => __( 'Font Family', 'kemet' ),
				'connect'     => KEMET_THEME_SETTINGS . '[top-bar-font-weight]',
			)
		)
	);

	/**
	 * Option: Font Weight
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-bar-font-weight]', array(
			'default'           => $defaults[ 'top-bar-font-weight' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Typography(
			$wp_customize, KEMET_THEME_SETTINGS . '[top-bar-font-weight]', array(
				'type'        => 'kmt-font-weight',
				'section'     => 'section-topbar-header',
				'priority'    => 46,
				'label'       => __( 'Font Weight', 'kemet' ),
				'connect'     => KEMET_THEME_SETTINGS . '[top-bar-font-family]',
			)
		)
	);

	/**
	 * Option: Top Bar Text Transform
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-bar-text-transform]', array(
			'default'           => $defaults[ 'top-bar-text-transform' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-bar-text-transform]', array(
			'type'     => 'select',
			'section'  => 'section-topbar-header',
			'priority' => 47,
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
	 * Option: Top Bar Line Height
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-bar-line-height]', array(
			'default'           => $defaults[ 'top-bar-line-height' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[top-bar-line-height]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-topbar-header',
				'priority'       => 48,
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
	* Option: Top Bar Letter Spacing
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-bar-letter-spacing]', array(
			'default'           => $defaults[ 'top-bar-letter-spacing' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[top-bar-letter-spacing]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-topbar-header',
				'priority'       => 49,
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
     * Option:Top Bar Responsive
     */
    $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-responsive]',array(
				'default'           => $defaults['topbar-responsive'],
				'type'              => 'option',
				'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
			)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[topbar-responsive]' ,array(
			'priority'   => 50,
			'section'    => 'section-topbar-header',
			'type'     => 'select',
			'label'    => __( 'Visibility', 'kemet-addons' ),
			'choices'  => array(
					'all-devices'        => __( 'Show on All Devices', 'kemet-addons' ),
					'hide-tablet'        => __( 'Hide on Tablet', 'kemet-addons' ),
					'hide-mobile'        => __( 'Hide on Mobile', 'kemet-addons' ),
					'hide-tablet-mobile' => __( 'Hide on Tablet and Mobile', 'kemet-addons' ),
			),
		)
	);
	/**
	 * Option: Title
	 */
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-top-bar-style]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Top Bar Style', 'kemet-addons' ),
				'section'  => 'section-topbar-header',
				'priority' => 55,
				'settings' => array(),
			)
		)
	);
    /**
	 * Option: Top Bar Header Background
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
			'default'           => $defaults[ 'topbar-bg-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-bg-color]', array(
                'priority'       => 60,
                'section' => 'section-topbar-header',
				'label'   => __( 'Background Color', 'kemet-addons' ),
			)
		)
	);

	/**
	 * Option:Top Bar Text Color
	*/
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-text-color]', array(
			'default'           => $defaults['topbar-text-color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-text-color]', array(
				'label'   => __( 'Text Color', 'kemet-addons' ),
				'priority'       => 65,
				'section' => 'section-topbar-header',
			)
		)
	);

	 /**
      * Option:Top Bar Link Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-link-color]', array(
			'default'           => $defaults['topbar-link-color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-link-color]', array(
				'label'   => __( 'Link Color', 'kemet-addons' ),
				'priority'       => 70,
				'section' => 'section-topbar-header',
			)
		)
	);

	/**
      * Option:Top Bar Link Hover Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-link-h-color]', array(
			'default'           => $defaults['topbar-link-h-color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-link-h-color]', array(
				'label'   => __( 'Link Hover Color', 'kemet-addons' ),
				'priority'       => 75,
				'section' => 'section-topbar-header',
			)
		)
	);

	/**
	 * Option: Top Bar Border Bottom Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-border-color]', array(
			'default'           => $defaults[ 'topbar-border-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-border-color]', array(
				'section'  => 'section-topbar-header',
				'priority' => 80,
				'label'    => __( 'Border Color', 'kemet-addons' ),
			)
		)
	);
	/**
	 * Option:Top Bar SubMenu Background Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-bg-color]', array(
			'default'           => $defaults[ 'topbar-submenu-bg-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-bg-color]', array(
				'priority'       => 85,
				'section' => 'section-topbar-header',
				'label'   => __( 'Submenu Background Color', 'kemet-addons' ),
			)
		)
	);
	/**
	 * Option:Top Bar SubMenu Items Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-items-color]', array(
			'default'           => $defaults[ 'topbar-submenu-items-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-items-color]', array(
				'priority'       => 90,
				'section' => 'section-topbar-header',
				'label'   => __( 'Submenu Link Color', 'kemet-addons' ),
			)
		)
	);
	/**
	 * Option:Top Bar SubMenu Items Hover Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[topbar-submenu-items-h-color]', array(
			'default'           => $defaults[ 'topbar-submenu-items-h-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[topbar-submenu-items-h-color]', array(
				'priority'       => 95,
				'section' => 'section-topbar-header',
				'label'   => __( 'Submenu Link Hover Color', 'kemet-addons' ),
			)
		)
	);
	
	/**
	 * Option: Search Style
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[top-bar-search-style]', array(
			'default'           => $defaults[ 'top-bar-search-style' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[top-bar-search-style]', array(
			'type'     => 'select',
			'section'  => 'section-topbar-header',
			'priority' => 100,
			'label'    => __( 'Search Box Style', 'kemet-addons' ),
			'choices'  => array(
				'search-icon'   => __( 'Icon', 'kemet-addons' ),
				'search-box'    => __( 'Search Box', 'kemet-addons' ),
			),
		)
	);
