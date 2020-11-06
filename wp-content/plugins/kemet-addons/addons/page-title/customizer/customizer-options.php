<?php
/**
 * Page Title Section Customizer
 * 
 * @package Kemet Addons
 */
// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$defaults = Kemet_Theme_Options::defaults();
	/**
     * Option: Page Title Layouts
     */
    $wp_customize->add_setting(
 		KEMET_THEME_SETTINGS . '[page-title-layouts]', array(
 			'default'           => $defaults[ 'page-title-layouts' ],
 			'type'              => 'option',
 			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
 		)
 	);

	$wp_customize->add_control(
		new Kemet_Control_Radio_Image(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-layouts]', array(
				'section'  => 'section-page-title-header',
				'priority' => 1,
				'label'    => __( 'Page Title Layouts', 'kemet-addons' ),
				'type'     => 'kmt-radio-image',
				'choices'  => array(
					'disable' => array(
						'label' => __( 'Disable', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/disable-page-title.png',
					),
					'page-title-layout-1' => array(
						'label' => __( 'Page Title Layout 1', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-01.png',
					),
					'page-title-layout-2' => array(
						'label' => __( 'Page Title Layout 2', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-02.png',
					),
					'page-title-layout-3' => array(
						'label' => __( 'Page Title Layout 3', 'kemet-addons' ),
						'path'  => KEMET_PAGE_TITLE_URL . '/assets/images/page-title-layout-03.png',
					),
				),
			)
		)
	);

	/**
     * Option: Page Title Alignment
     */
    $wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page_title_alignment]',array(
					'default'           => $defaults['page_title_alignment'],
					'type'              => 'option',
					'transport'         => 'postMessage',
					'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices'),
					'dependency'  => array(
						'controls' =>  KEMET_THEME_SETTINGS . '[page-title-layouts]', 
						'conditions' => '==', 
						'values' => 'page-title-layout-1',
					), 
			)
	);
	$wp_customize->add_control(
		new Kemet_Control_Icon_Select(
			$wp_customize, KEMET_THEME_SETTINGS . '[page_title_alignment]', array(
				'priority'       => 5,
				'section' => 'section-page-title-header',
				'label'   => __( 'Page Title Alignment', 'kemet-addons' ),
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
		 * Option: Merge Page Title with the main header
		 */
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[merge-with-header]', array(
				'default'           => $defaults[ 'merge-with-header' ],
				'type'              => 'option',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
			)
		);
		$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[merge-with-header]', array(
				'type'            => 'checkbox',
				'section'         => 'section-page-title-header',
				'label'           => __( 'Merge/Combine Page Title With Main Header', 'kemet-addons' ),
				'priority'        => 6,
				
			)
		);
	/**
	 * Option: Page Title Divider Color
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-border-right-color]', array(
			'default'           => $defaults[ 'page-title-border-right-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
			'dependency'  => array(
				'controls' =>  KEMET_THEME_SETTINGS . '[page-title-layouts]', 
				'conditions' => '==', 
				'values' => 'page-title-layout-3',
			),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-border-right-color]', array(
			'section' => 'section-page-title-header',
			'priority' => 10,
			'label'   => __( 'Page Title Divider Color', 'kemet-addons' ),
			)
		)
	); 
	/**
	 * Option: Page Title Background
	 */
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page-title-bg-obj]', array(
				'default'           => $defaults[ 'page-title-bg-obj' ],
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_background_obj' ),
			)
		);
		$wp_customize->add_control(
			new Kemet_Control_Background(
				$wp_customize, KEMET_THEME_SETTINGS . '[page-title-bg-obj]', array(
				'type'    => 'kmt-background',
				'section' => 'section-page-title-header',
				'priority' => 15,
				'label'   => __( 'Page Title Background', 'kemet-addons' ),
				)
			)
		);

		/**
		 * Option: Title
		 */
		$wp_customize->add_control(
			new Kemet_Control_Title(
				$wp_customize, KEMET_THEME_SETTINGS . '[kmt-page-title-settings]', array(
					'type'     => 'kmt-title',
					'label'    => __( 'Page Title Settings', 'kemet-addons' ),
					'section'  => 'section-page-title-header',
					'priority' => 20,
					'settings' => array(),
				)
			)
		);

    /**
    * Option - Page Title Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-space]', array(
			'default'           => $defaults[ 'page-title-space' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-space]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-page-title-header',
				'priority'       => 30,
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
	 * Option:Page Title Responsive
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-responsive]',array(
				'default'           => $defaults['page-title-responsive'],
				'type'              => 'option',
				'sanitize_callback' => array('Kemet_Customizer_Sanitizes','sanitize_choices')
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[page-title-responsive]' ,array(
			'priority'   => 35,
			'section'    => 'section-page-title-header',
			'type'     => 'select',
			'label'    => __( 'Page Title Visibility', 'kemet-addons' ),
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
				$wp_customize, KEMET_THEME_SETTINGS . '[kmt-page-title-style]', array(
					'type'     => 'kmt-title',
					'label'    => __( 'Page Title Content Style', 'kemet-addons' ),
					'section'  => 'section-page-title-header',
					'priority' => 40,
					'settings' => array(),
				)
			)
		);
	  /**
      * Option: Page Title Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-color]', array(
			'default'           => $defaults[ 'page-title-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-color]', array(
				'label'   => __( 'Font Color', 'kemet-addons' ),
				'priority'       => 45,
				'section' => 'section-page-title-header',
			)
		)
	);
		/**
	 * Option: Page Title Font Size
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[page-title-font-size]', array(
			'default'           => $defaults[ 'page-title-font-size' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-page-title-header',
				'priority'       => 50,
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
       * Option: Page Title Font Family
       */
      $wp_customize->add_setting(
          KEMET_THEME_SETTINGS . '[page-title-font-family]', array(
              'default'           => $defaults[ 'page-title-font-family' ],
              'type'              => 'option',
              'sanitize_callback' => 'sanitize_text_field',
          )
      );
      $wp_customize->add_control(
          new Kemet_Control_Typography(
              $wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-family]', array(
                  'type'     => 'kmt-font-family',
                  'label'    => __( 'Font Family', 'kemet-addons' ),
                  'section'  => 'section-page-title-header',
                  'priority' => 55,
                  'connect'  => KEMET_THEME_SETTINGS . '[page-title-font-weight]',
              )
          )
      );
      
       /**
          * Option: Page Title Font Weight
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[page-title-font-weight]', array(
                 'default'           => $defaults[ 'page-title-font-weight' ],
                 'type'              => 'option',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Typography(
                 $wp_customize, KEMET_THEME_SETTINGS . '[page-title-font-weight]', array(
                     'type'     => 'kmt-font-weight',
                     'label'    => __( 'Font Weight', 'kemet-addons' ),
                     'section'  => 'section-page-title-header',
                     'priority' => 60,
                     'connect'  => KEMET_THEME_SETTINGS . '[page-title-font-family]',
 
                 )
             )
         );
 
         /**
          * Option: Page Title Text Transform
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-text-transform]', array(
                 'default'           => $defaults[ 'pagetitle-text-transform' ],
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
             )
         );
         $wp_customize->add_control(
             KEMET_THEME_SETTINGS . '[pagetitle-text-transform]', array(
                 'section'  => 'section-page-title-header',
                 'label'    => __( 'Text Transform', 'kemet-addons' ),
                 'type'     => 'select',
                 'priority' => 65,
                 'choices'  => array(
                     ''           => __( 'Inherit', 'kemet-addons' ),
                     'none'       => __( 'None', 'kemet-addons' ),
                     'capitalize' => __( 'Capitalize', 'kemet-addons' ),
                     'uppercase'  => __( 'Uppercase', 'kemet-addons' ),
                     'lowercase'  => __( 'Lowercase', 'kemet-addons' ),
                 ),
             )
         );
 
         /**
          * Option: Page Title Line Height
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-line-height]', array(
                 'default'           => $defaults[ 'pagetitle-line-height' ],
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
             )
         );
         $wp_customize->add_control(
			new Kemet_Control_Responsive_Slider(
				$wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-line-height]', array(
					'type'           => 'kmt-responsive-slider',
					'section'        => 'section-page-title-header',
					'priority'       => 70,
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
		 * Option: Page Title Letter Spacing
		 */
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[page-title-letter-spacing]', array(
				'default'           => $defaults[ 'page-title-letter-spacing' ],
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
			)
		);
		$wp_customize->add_control(
			new Kemet_Control_Responsive_Slider(
				$wp_customize, KEMET_THEME_SETTINGS . '[page-title-letter-spacing]', array(
					'type'           => 'kmt-responsive-slider',
					'section'        => 'section-page-title-header',
					'priority'       => 73,
					'label'          => __( 'Letter Spacing', 'kemet-addons' ),
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
		 * Option: Page Title Bottom Line Color
		*/
		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]', array(
				'default'           => $defaults['pagetitle-bottomline-color'],
				'type'              => 'option',
				'transport'         => 'postMessage',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
			)
		);
		$wp_customize->add_control(
			new Kemet_Control_Color(
				$wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-color]', array(
					'label'   => __( 'Separator Color', 'kemet-addons' ),
					'priority'       => 75,
					'section' => 'section-page-title-header',
				)
			)
		);	

		  /**
          * Option: Separator Height
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]', array(
                 'default'           => $defaults['pagetitle-bottomline-height'],
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Slider(
                 $wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-height]', array(
                     'type'        => 'kmt-slider',
                     'section'     => 'section-page-title-header',
                     'priority'    => 80,
                     'label'       => __( 'Separator Height', 'kemet-addons' ),
					 'suffix'      => '',
                     'input_attrs' => array(
                         'min'  => 0,
                         'max'  => 20,
                     ),
                 )
             )
		 );


		  /**
          * Option: Page Title Bottom Line width
          */
         $wp_customize->add_setting(
             KEMET_THEME_SETTINGS . '[pagetitle-bottomline-width]', array(
                 'default'           => $defaults['pagetitle-bottomline-width'],
                 'type'              => 'option',
                 'transport'         => 'postMessage',
                 'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
             )
         );
         $wp_customize->add_control(
             new Kemet_Control_Slider(
                 $wp_customize, KEMET_THEME_SETTINGS . '[pagetitle-bottomline-width]', array(
                     'type'        => 'kmt-slider',
                     'section'     => 'section-page-title-header',
                     'priority'    => 85,
                     'label'       => __( 'Separator Width', 'kemet-addons' ),
                     'suffix'      => '',
                     'input_attrs' => array(
                         'min'  => 0,
                         'max'  => 300,
                     ),
                 )
             )
		 );
		 /**
		 * Option: Title
		 */
		$wp_customize->add_control(
			new Kemet_Control_Title(
				$wp_customize, KEMET_THEME_SETTINGS . '[kmt-page-sub-title]', array(
					'type'     => 'kmt-title',
					'label'    => __( 'Sub Title Content Style', 'kemet-addons' ),
					'section'  => 'section-page-title-header',
					'priority' => 90,
					'settings' => array(),
				)
			)
		);
	 /**
      * Option: Sub Title Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-color]', array(
			'default'           => $defaults[ 'sub-title-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[sub-title-color]', array(
				'label'   => __( 'Text Color', 'kemet-addons' ),
				'priority'       => 95,
				'section' => 'section-page-title-header',
			)
		)
	);
	/**
	* Option: Sub Title Font Size
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-font-size]', array(
			'default'           => $defaults[ 'sub-title-font-size' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[sub-title-font-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-page-title-header',
				'priority'       => 100,
				'label'          => __( 'Font Size', 'kemet' ),
				'unit_choices'   => array(
					'px' => array(
						'min' => 1,
						'step' => 1,
						'max' =>100,
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
	* Option: Sub Title Font Family
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-font-family]', array(
			'default'           => $defaults[ 'sub-title-font-family' ],
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',

		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Typography(
			$wp_customize, KEMET_THEME_SETTINGS . '[sub-title-font-family]', array(
				'type'     => 'kmt-font-family',
				'label'    => __( 'Font Family', 'kemet' ),
				'section'  => 'section-page-title-header',
				'priority' => 120,
				'connect'  => KEMET_THEME_SETTINGS . '[sub-title-font-weight]',
			)
		)
	);

	/**
	* Option: Sub Title Font Weight
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-font-weight]', array(
			'default'           => $defaults[ 'sub-title-font-weight' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Typography(
			$wp_customize, KEMET_THEME_SETTINGS . '[sub-title-font-weight]', array(
				'type'     => 'kmt-font-weight',
				'label'    => __( 'Font Weight', 'kemet' ),
				'section'  => 'section-page-title-header',
				'priority' => 125,
				'connect'  => KEMET_THEME_SETTINGS . '[sub-title-font-family]',

			)
		)
	);

	/**
	* Option: Sub Title Text Transform
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-text-transform]', array(
			'default'           => $defaults[ 'sub-title-text-transform' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[sub-title-text-transform]', array(
			'section'  => 'section-page-title-header',
			'label'    => __( 'Text Transform', 'kemet' ),
			'type'     => 'select',
			'priority' => 130,
			'choices'  => array(
				''           => __( 'Inherit', 'kemet' ),
				'none'       => __( 'None', 'kemet' ),
				'capitalize' => __( 'Capitalize', 'kemet' ),
				'uppercase'  => __( 'Uppercase', 'kemet' ),
				'lowercase'  => __( 'Lowercase', 'kemet' ),
			),
		)
	);

	/**
	* Option: Sub Title Line Height
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-line-height]', array(
			'default'           => $defaults[ 'sub-title-line-height' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[sub-title-line-height]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-page-title-header',
				'priority'       => 135,
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
	* Option: Sub Title Letter Spacing
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[sub-title-letter-spacing]', array(
			'default'           => $defaults[ 'sub-title-letter-spacing' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[sub-title-letter-spacing]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-page-title-header',
				'priority'       => 145,
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
	 * Option: Show item title
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-enabled]', array(
			'default'           => $defaults['breadcrumbs-enabled'],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[breadcrumbs-enabled]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Enable Breadcrumbs', 'kemet-addons' ),
            'priority'        => 1,
            
		)
	);
	/**
	 * Option: Show item title
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[show-item-title]', array(
			'default'           => $defaults['show-item-title'],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[show-item-title]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Show Current Location', 'kemet-addons' ),
            'priority'        => 5,
            
		)
	);
	/**
	 * Option: Breadcrumbs Separator
	 */

	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumb-prefix]', array(
			'default'           => $defaults[ 'breadcrumb-prefix' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[breadcrumb-prefix]', array(
			'type'     => 'text',
			'section'  => 'section-breadcrumbs',
			'priority' => 10,
			'label'    => __( 'Breadcrumbs Prefix Text', 'kemet-addons' ),
		)
	);
	/**
	* Option: Breadcrumbs Font Size
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-font-size]', array(
			'default'           => $defaults[ 'breadcrumbs-font-size' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-font-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-breadcrumbs',
				'priority'       => 15,
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
	* Option: Breadcrumbs Font Family
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-font-family]', array(
			'default'           => $defaults[ 'breadcrumbs-font-family' ],
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_text_field',

		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Typography(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-font-family]', array(
				'type'     => 'kmt-font-family',
				'label'    => __( 'Font Family', 'kemet' ),
				'section'  => 'section-breadcrumbs',
				'priority' => 25,
				'connect'  => KEMET_THEME_SETTINGS . '[breadcrumbs-font-weight]',
			)
		)
	);

	/**
	* Option: Breadcrumbs Font Weight
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-font-weight]', array(
			'default'           => $defaults[ 'breadcrumbs-font-weight' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_font_weight' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Typography(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-font-weight]', array(
				'type'     => 'kmt-font-weight',
				'label'    => __( 'Font Weight', 'kemet' ),
				'section'  => 'section-breadcrumbs',
				'priority' => 30,
				'connect'  => KEMET_THEME_SETTINGS . '[breadcrumbs-font-family]',

			)
		)
	);

	/**
	* Option: Breadcrumbs Text Transform
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-text-transform]', array(
			'default'           => $defaults[ 'breadcrumbs-text-transform' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[breadcrumbs-text-transform]', array(
			'section'  => 'section-breadcrumbs',
			'label'    => __( 'Text Transform', 'kemet' ),
			'type'     => 'select',
			'priority' => 35,
			'choices'  => array(
				''           => __( 'Inherit', 'kemet' ),
				'none'       => __( 'None', 'kemet' ),
				'capitalize' => __( 'Capitalize', 'kemet' ),
				'uppercase'  => __( 'Uppercase', 'kemet' ),
				'lowercase'  => __( 'Lowercase', 'kemet' ),
			),
		)
	);

	/**
	* Option: Breadcrumbs Line Height
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-line-height]', array(
			'default'           => $defaults[ 'breadcrumbs-line-height' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-line-height]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-breadcrumbs',
				'priority'       => 40,
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
	* Option: Breadcrumbs Letter Spacing
	*/
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-letter-spacing]', array(
			'default'           => $defaults[ 'breadcrumbs-letter-spacing' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-letter-spacing]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-breadcrumbs',
				'priority'       => 41,
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
	 * Option: Home Item
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumb-home-item]', array(
			'default'           => $defaults[ 'breadcrumb-home-item' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[breadcrumb-home-item]', array(
			'type'     => 'select',
			'section'  => 'section-breadcrumbs',
			'priority' => 45,
			'label'    => __( 'Home Item', 'kemet-addons' ),
			'choices'  => array(
				'text' 	=> esc_html__( 'Text', 'kemet-addons' ),
				'icon' 	=> esc_html__( 'Icon', 'kemet-addons' ),
			),
		)
	);
	/**
	 * Option: Title
	 */
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-breadcrumbs-display-title]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Breadcrumbs Display', 'kemet-addons' ),
				'section'  => 'section-breadcrumbs',
				'priority' => 50,
				'settings' => array(),
			)
		)
	);
	/**
	 * Option: Disable on Archive
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-archive]', array(
			'default'           => $defaults['disable-breadcrumbs-in-archive'],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-archive]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Disable on Archive', 'kemet-addons' ),
            'priority'        => 65,
            
		)
	);
	/**
	 * Option: Disable on Single Page
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-page]', array(
			'default'           => $defaults['disable-breadcrumbs-in-single-page'],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-page]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Disable on Single Page', 'kemet-addons' ),
            'priority'        => 70,
            
		)
	);
	/**
	 * Option: Disable on Single Post
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-post]', array(
			'default'           => $defaults['disable-breadcrumbs-in-single-post'],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-single-post]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Disable on Single Post', 'kemet-addons' ),
            'priority'        => 75,
            
		)
	);
	/**
	 * Option: Disable on 404 Page
	 */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-404-page]', array(
			'default'           => $defaults['disable-breadcrumbs-in-404-page'],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[disable-breadcrumbs-in-404-page]', array(
			'type'            => 'checkbox',
			'section'         => 'section-breadcrumbs',
			'label'           => __( 'Disable on 404 Page', 'kemet-addons' ),
            'priority'        => 85,
            
		)
	);
	/**
	 * Option: Breadcrumbs Separator
	 */

		$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumb-separator]', array(
			'default'           => $defaults[ 'breadcrumb-separator' ],
			'type'              => 'option',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_html' ),
		)
	);
	$wp_customize->add_control(
		KEMET_THEME_SETTINGS . '[breadcrumb-separator]', array(
			'type'     => 'text',
			'section'  => 'section-breadcrumbs',
			'priority' => 95,
			'label'    => __( 'Custom Levels Divider', 'kemet-addons' ),
		)
	);

	/**
	 * Option: Breadcrumbs Taxonomy
	 */

		$wp_customize->add_setting(
			KEMET_THEME_SETTINGS . '[breadcrumb-posts-taxonomy]', array(
				'default'           => $defaults[ 'breadcrumb-posts-taxonomy' ],
				'type'              => 'option',
				'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
			)
		);
		$wp_customize->add_control(
			KEMET_THEME_SETTINGS . '[breadcrumb-posts-taxonomy]', array(
				'type'     => 'select',
				'section'  => 'section-breadcrumbs',
				'priority' => 100,
				'label'    => __( 'Posts Taxonomy', 'kemet-addons' ),
				'choices'  => array(
					'category' 	=> esc_html__( 'Category', 'kemet-addons' ),
					'post_tag' 	=> esc_html__( 'Tag', 'kemet-addons' ),
					'blog' 		=> esc_html__( 'Blog Page', 'kemet-addons' ),
				),
				'description' => esc_html__( 'Choose the Taxonomy Item Parent.', 'kemet-addons' ),
			)
		);

	/**
    * Option - Breadcrumbs Spacing
    */
	$wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-space]', array(
			'default'           => $defaults[ 'breadcrumbs-space' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Responsive_Spacing(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-space]', array(
				'type'           => 'kmt-responsive-spacing',
				'section'        => 'section-breadcrumbs',
				'priority'       => 105,
				'label'          => __( 'Breadcrumbs Spacing', 'kemet-addons' ),
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
	 * Option: Title
	 */
	$wp_customize->add_control(
		new Kemet_Control_Title(
			$wp_customize, KEMET_THEME_SETTINGS . '[kmt-breadcrumbs-title]', array(
				'type'     => 'kmt-title',
				'label'    => __( 'Breadcrumbs Style', 'kemet-addons' ),
				'section'  => 'section-breadcrumbs',
				'priority' => 110,
				'settings' => array(),
			)
		)
	);
	  /**
      * Option: Breadcrumbs Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-color]', array(
			'default'           => $defaults[ 'breadcrumbs-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-color]', array(
				'label'   => __( 'Text Color', 'kemet-addons' ),
				'priority'       => 112,
				'section' => 'section-breadcrumbs',
			)
		)
	);

	  /**
      * Option: Breadcrumbs Link Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-link-color]', array(
			'default'           => $defaults[ 'breadcrumbs-link-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-link-color]', array(
				'label'   => __( 'Link Color', 'kemet-addons' ),
				'priority'       => 115,
				'section' => 'section-breadcrumbs',
			)
		)
	);

	  /**
      * Option: Breadcrumbs Link Hover Color
      */
	  $wp_customize->add_setting(
		KEMET_THEME_SETTINGS . '[breadcrumbs-link-h-color]', array(
			'default'           => $defaults[ 'breadcrumbs-link-h-color' ],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_hex_color' ),
		)
	);
	$wp_customize->add_control(
		new Kemet_Control_Color(
			$wp_customize, KEMET_THEME_SETTINGS . '[breadcrumbs-link-h-color]', array(
				'label'   => __( 'Link Hover Color', 'kemet-addons' ),
				'priority'       => 120,
				'section' => 'section-breadcrumbs',
			)
		)
	);
    
	 
	 
	


