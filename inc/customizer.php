<?php
/**
 * Brooklyn Theme Customizer
 *
 * @package Brooklyn
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function brooklyn_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'brooklyn_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'brooklyn_customize_partial_blogdescription',
			)
		);
	}



    //Social Icons
    $wp_customize->add_section( 'social_section' , array(
        'title'      => esc_html__( 'Top Socials', 'brooklyn' ),
        'priority'   => 30,
    ) );

    $wp_customize->add_setting( 'twitter',array('sanitize_callback'     => 'sanitize_text_field'));
    $wp_customize->add_setting( 'skype',array('sanitize_callback'       => 'sanitize_text_field'));
    $wp_customize->add_setting( 'instagram',array('sanitize_callback'   => 'sanitize_text_field'));
    $wp_customize->add_setting( 'dribble',array('sanitize_callback'     => 'sanitize_text_field'));
    $wp_customize->add_setting( 'vimeo',array('sanitize_callback'       => 'sanitize_text_field'));
    $wp_customize->add_setting( 'facebook',array('sanitize_callback'    => 'sanitize_text_field'));


    $wp_customize->add_control( 'facebook',
        array(
            'label'    => esc_html__( 'Facebook URL', 'brooklyn' ),
            'section'  => 'social_section',
            'settings' => 'facebook',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'twitter',
        array(
            'label'    => esc_html__( 'Twitter URL', 'brooklyn' ),
            'section'  => 'social_section',
            'settings' => 'twitter',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'skype',
        array(
            'label'    => esc_html__( 'Skype URL', 'brooklyn' ),
            'section'  => 'social_section',
            'settings' => 'skype',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'instagram',
        array(
            'label'    => esc_html__( 'Instagram URL', 'brooklyn' ),
            'section'  => 'social_section',
            'settings' => 'instagram',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'dribble',
        array(
            'label'    => esc_html__( 'Dribble URL', 'brooklyn' ),
            'section'  => 'social_section',
            'settings' => 'dribble',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'vimeo',
        array(
            'label'    => esc_html__( 'Vimeo URL', 'brooklyn' ),
            'section'  => 'social_section',
            'settings' => 'vimeo',
            'type'     => 'text'
        )
    );



    //Footer Settings

    $wp_customize->add_section( 'footer_section' , array(
            'title'      => esc_html__( 'Footer Settings', 'brooklyn' ),
            'priority'   => 30,
        ) );
    $wp_customize->add_setting( 'copyright_text',array('sanitize_callback' => 'sanitize_textarea_field'));


    $wp_customize->add_control( 'copyright_text',
            array(
                'label'    => esc_html__( 'Copyright Text', 'brooklyn' ),
                'description' => esc_html__( 'Footer Credit', 'brooklyn' ),
                'section'  => 'footer_section',
                'settings' => 'copyright_text',
                'type'     => 'textarea'
            )
        );


}
add_action( 'customize_register', 'brooklyn_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function brooklyn_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function brooklyn_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function brooklyn_customize_preview_js() {
	wp_enqueue_script( 'brooklyn-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), BROOKLYN_VER, true );
}
add_action( 'customize_preview_init', 'brooklyn_customize_preview_js' );
