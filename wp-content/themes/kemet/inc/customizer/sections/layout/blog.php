<?php
/**
* Blog Options for Kemet Theme.
*
* @package     Kemet
* @author      Kemet
* @copyright   Copyright ( c ) 2019, Kemet
* @link        https://kemet.io/
* @since       Kemet 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$defaults = Kemet_Theme_Options::defaults();
/**
* Option: Blog Content Width
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-width]', array(
        'default'           => $defaults[ 'blog-width' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[blog-width]', array(
        'type'     => 'select',
        'section'  => 'section-blog',
        'priority' => 5,
        'label'    => __( 'Blog Content Width', 'kemet' ),
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
    KEMET_THEME_SETTINGS . '[blog-max-width]', array(
        'default'           => $defaults[ 'blog-max-width' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_number' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[blog-width]', 
            'conditions' => '==', 
            'values' => 'custom',
        ), 
    )
);
$wp_customize->add_control(
    new Kemet_Control_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-max-width]', array(
            'type'        => 'kmt-slider',
            'section'     => 'section-blog',
            'priority'    => 10,
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
* Option: Display Post Structure
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-post-structure]', array(
        'default'           => $defaults[ 'blog-post-structure' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-post-structure]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-blog',
            'priority' => 15,
            'label'    => __( 'Blog Post Structure', 'kemet' ),
            'choices'  => array(
                'image'      => __( 'Featured Image', 'kemet' ),
                'title-meta' => __( 'Title & Blog Meta', 'kemet' ),
                'content-readmore' => __( 'Content & Readmore', 'kemet' ),
            ),
        )
    )
);

/**
* Option: Display Post Meta
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-meta]', array(
        'default'           => $defaults[ 'blog-meta' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_multi_choices' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[blog-post-structure]', 
            'conditions' => 'inarray', 
            'values' => 'title-meta',
        ), 
    )
);
$wp_customize->add_control(
    new Kemet_Control_Sortable(
        $wp_customize, KEMET_THEME_SETTINGS . '[blog-meta]', array(
            'type'     => 'kmt-sortable',
            'section'  => 'section-blog',
            'priority' => 20,
            'label'    => __( 'Blog Meta', 'kemet' ),
            'choices'  => array(
                'comments' => __( 'Comments', 'kemet' ),
                'category' => __( 'Category', 'kemet' ),
                'author'   => __( 'Author', 'kemet' ),
                'date'     => __( 'Publish Date', 'kemet' ),
                'tag'      => __( 'Tag', 'kemet' ),
            ),
        )
    )
);

/**
* Option: Blog Post Content
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[blog-post-content]', array(
        'default'           => $defaults[ 'blog-post-content' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_choices' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[blog-post-content]', array(
        'section'  => 'section-blog',
        'label'    => __( 'Blog Post Content', 'kemet' ),
        'type'     => 'select',
        'priority' => 25,
        'choices'  => array(
            'full-content' => __( 'Full Content', 'kemet' ),
            'excerpt'      => __( 'Excerpt', 'kemet' ),
        ),
    )
);
/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-blog-post-title]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Title and Meta Style', 'kemet' ),
            'section'  => 'section-blog',
            'priority' => 45,
            'settings' => array(),
        )
    )
);
/**
* Option: Blog - Post Title Font Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[font-size-page-title]', array(
        'default'           => $defaults[ 'font-size-page-title' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[font-size-page-title]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-blog',
            'priority'       => 50,
            'label'          => __( 'Title Font Size', 'kemet' ),
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
 * Option: Post Title Font Family
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[post-title-font-family]', array(
        'default'           => $defaults[ 'page-title-font-family' ],
        'type'              => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Kemet_Control_Typography(
        $wp_customize, KEMET_THEME_SETTINGS . '[post-title-font-family]', array(
            'type'     => 'kmt-font-family',
            'label'    => __( 'Title Font Family', 'kemet' ),
            'section'  => 'section-blog',
            'priority' => 51,
        )
    )
);
/**
* Option: Title Letter Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[letter-spacing-page-title]', array(
        'default'           => $defaults[ 'letter-spacing-page-title' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Slider(
        $wp_customize, KEMET_THEME_SETTINGS . '[letter-spacing-page-title]', array(
            'type'           => 'kmt-responsive-slider',
            'section'        => 'section-blog',
            'priority'       => 57,
            'label'          => __( 'Title Letter Spacing', 'kemet' ),
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
* Option:Post Title Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[listing-post-title-color]', array(
        'default'           => $defaults[ 'listing-post-title-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[listing-post-title-color]', array(
            'label'   => __( 'Title Font Color', 'kemet' ),
            'priority'       => 60,
            'section' => 'section-blog',
        )
    )
);
/**
* Option:Post Title Hover Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[listing-post-title-hover-color]', array(
        'default'           => $defaults[ 'listing-post-title-hover-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[listing-post-title-hover-color]', array(
            'label'   => __( 'Title Hover Color', 'kemet' ),
            'priority'       => 61,
            'section' => 'section-blog',
        )
    )
);
/**
* Option:Post Meta Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[listing-post-meta-color]', array(
        'default'           => $defaults[ 'listing-post-meta-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[listing-post-meta-color]', array(
            'label'   => __( 'Meta Font Color', 'kemet' ),
            'priority'       => 65,
            'section' => 'section-blog',
        )
    )
);

/**
* Option - Pagination Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[pagination-padding]', array(
        'default'           => $defaults[ 'pagination-padding' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[pagination-padding]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-blog',
            'priority'       => 66,
            'label'          => __( 'Pagination Spacing', 'kemet' ),
            'linked_choices' => true,
            'unit_choices'   => array( 'px', 'em', '%' ),
            'choices'        => array(
                'top'    => __( 'Top', 'kemet' ),
                'right'  => __( 'Right', 'kemet' ),
                'bottom' => __( 'Bottom', 'kemet' ),
                'left'   => __( 'Left', 'kemet' ),
            ),
        )
    )
);
/**
* Option:Post Main Content Entry Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[main-entry-content-color]', array(
        'default'           => $defaults[ 'main-entry-content-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[main-entry-content-color]', array(
            'label'   => __( 'Main Content Entry Color', 'kemet' ),
            'priority'       => 66,
            'section' => 'section-blog',
        )
    )
);
/**
* Option: Title
*/
$wp_customize->add_control(
    new Kemet_Control_Title(
        $wp_customize, KEMET_THEME_SETTINGS . '[kmt-blog-readmore]', array(
            'type'     => 'kmt-title',
            'label'    => __( 'Read More Button Style', 'kemet' ),
            'section'  => 'section-blog',
            'priority' => 70,
            'settings' => array(),
        )
    )
);
/**
 * Option: Enable Read more as button
 */
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-as-button]', array(
        'default'           => $defaults[ 'readmore-as-button' ],
        'type'              => 'option',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_checkbox' ),
    )
);
$wp_customize->add_control(
    KEMET_THEME_SETTINGS . '[readmore-as-button]', array(
        'type'            => 'checkbox',
        'section'         => 'section-blog',
        'label'           => __( 'Enable Read More As Button', 'kemet' ),
        'priority'        => 71,
    )
);
/**
* Option:Post Read More Text Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-text-color]', array(
        'default'           => $defaults[ 'readmore-text-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-text-color]', array(
            'label'   => __( 'Read More Color', 'kemet' ),
            'priority'       => 75,
            'section' => 'section-blog',
        )
    )
);

/**
* Option:Post Read More Text Color Hover
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-text-h-color]', array(
        'default'           => $defaults[ 'readmore-text-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-text-h-color]', array(
            'label'   => __( 'Read More Hover Color', 'kemet' ),
            'priority'       => 80,
            'section' => 'section-blog',
        )
    )
);

/**
* Option: Read More Background Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-bg-color]', array(
        'default'           => $defaults[ 'readmore-bg-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-bg-color]', array(
            'section'  => 'section-blog',
            'priority' => 85,
            'label'    => __( 'Read More Background Color', 'kemet' ),
        )
    )
);
/**
* Option: Read More Background Color Hover
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-bg-h-color]', array(
        'default'           => $defaults[ 'readmore-bg-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-bg-h-color]', array(
            'section'  => 'section-blog',
            'priority' => 90,
            'label'    => __( 'Read More Background Hover Color', 'kemet' ),
        )
    )
);
/**
* Option: Read More Border Radius
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[read-more-border-radius]', array(
        'default'           => $defaults[ 'read-more-border-radius' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[read-more-border-radius]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-blog',
				'priority'       => 95,
				'label'          => __( 'Read More Border Radius', 'kemet' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 100,
					 ),
					 'em' => array(
						 'min' => 0.1,
						 'step' => 0.1,
						 'max' => 10,
                     ),
                     '%' => array(
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                    ),
                 ),
			)
		)
	);
/**
* Option: Read More Border Size
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[read-more-border-size]', array(
        'default'           => $defaults[ 'read-more-border-size' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
		new Kemet_Control_Responsive_Slider(
			$wp_customize, KEMET_THEME_SETTINGS . '[read-more-border-size]', array(
				'type'           => 'kmt-responsive-slider',
				'section'        => 'section-blog',
				'priority'       => 100,
				'label'          => __( 'Read More Border Size', 'kemet' ),
				'unit_choices'   => array(
					 'px' => array(
						 'min' => 1,
						 'step' => 1,
						 'max' => 15,
					 ),
                 ),
			)
		)
	);
/**
* Option: Read More Border Color
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-border-color]', array(
        'default'           => $defaults[ 'readmore-border-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-border-color]', array(
            'section'  => 'section-blog',
            'priority' => 105,
            'label'    => __( 'Read More Border Color', 'kemet' ),
        )
    )
);

/**
* Option: Read More Border Color Hover
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-border-h-color]', array(
        'default'           => $defaults[ 'readmore-border-h-color' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_alpha_color' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Color(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-border-h-color]', array(
            'section'  => 'section-blog',
            'priority' => 110,
            'label'    => __( 'Read More Border Hover Color', 'kemet' ),
        )
    )
);
/**
* Option - Read More Spacing
*/
$wp_customize->add_setting(
    KEMET_THEME_SETTINGS . '[readmore-padding]', array(
        'default'           => $defaults[ 'readmore-padding' ],
        'type'              => 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => array( 'Kemet_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
        'dependency'  => array(
            'controls' =>  KEMET_THEME_SETTINGS . '[readmore-as-button]', 
            'conditions' => '==', 
            'values' => true,
        ),
    )
);
$wp_customize->add_control(
    new Kemet_Control_Responsive_Spacing(
        $wp_customize, KEMET_THEME_SETTINGS . '[readmore-padding]', array(
            'type'           => 'kmt-responsive-spacing',
            'section'        => 'section-blog',
            'priority'       => 115,
            'label'          => __( 'Read More Padding', 'kemet' ),
            'linked_choices' => true,
            'unit_choices'   => array( 'px', 'em', '%' ),
            'choices'        => array(
                'top'    => __( 'Top', 'kemet' ),
                'right'  => __( 'Right', 'kemet' ),
                'bottom' => __( 'Bottom', 'kemet' ),
                'left'   => __( 'Left', 'kemet' ),
            ),
        )
    )
);