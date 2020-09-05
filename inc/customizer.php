<?php
/**
 * Brooklyn Theme Customizer
 *
 * @package Brooklyn
 */

if ( !function_exists('brooklyn_default_theme_options') ) :
    function brooklyn_default_theme_options() {

        $default_theme_options = array(
        	'brooklyn_read_more_text'  		=> esc_html__('Read More','brooklyn'), 
        	'brooklyn_blog_meta'       		=> 1, 
        	'brooklyn_blog_excerpt'    		=> 20,
            'brooklyn_copyright_text'  		=> __('&copy; 2020 All Rights Reserved','brooklyn'),
            'brooklyn_breadcrumbs'			=> 1, 
            'brooklyn_facebook'    			=> '#',
            'brooklyn_twitter'    			=> '#',
            'brooklyn_skype'    			=> '#',
            'brooklyn_instagram'    		=> '#',
            'brooklyn_dribble'    			=> '#',
            'brooklyn_vimeo'    			=> '#',
        );
        return apply_filters( 'brooklyn_default_theme_options', $default_theme_options );
    }
endif;


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


	$default_options = brooklyn_default_theme_options();

	$wp_customize->add_section( 'theme_detail', array(
        'title'    => __( 'About Theme', 'brooklyn' ),
        'priority' => 9
    ) );

    
    $wp_customize->add_setting( 'upgrade_text', array(
        'default' => '',
        'sanitize_callback' => '__return_false'
    ) );


    $wp_customize->add_panel( 'brooklyn_panel', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'title' => __( 'Brooklyn Theme Options', 'brooklyn' ),
    ) );



	/*Blog Page Options*/
	$wp_customize->add_section( 'brooklyn_blog_section', array(
	    'priority'       => 10,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __( 'Blog Settings', 'brooklyn' ),
	    'panel' 		 => 'brooklyn_panel',
	) );
    	/*Read More Text*/
    	$wp_customize->add_setting( 'brooklyn_read_more_text', array(
    	    'capability'        => 'edit_theme_options',
    	    'transport' 		=> 'refresh',
    	    'default'           => $default_options['brooklyn_read_more_text'],
    	    'sanitize_callback' => 'sanitize_text_field'
    	) );
    	$wp_customize->add_control( 'brooklyn_read_more_text', array(
    	    'label'     => __( 'Read More Text', 'brooklyn' ),
    	    'description' => __('Enter Your Custom Read More Text', 'brooklyn'),
    	    'section'   => 'brooklyn_blog_section',
    	    'settings'  => 'brooklyn_read_more_text',
    	    'type'      => 'text',
    	    'priority'  => 10
    	) );
    	/*Meta Fields*/
    	$wp_customize->add_setting( 'brooklyn_blog_meta', array(
    	    'capability'        => 'edit_theme_options',
    	    'transport' 		=> 'refresh',
    	    'default'           => $default_options['brooklyn_blog_meta'],
    	    'sanitize_callback' => 'brooklyn_sanitize_checkbox'
    	) );

    	$wp_customize->add_control( 'brooklyn_blog_meta', array(
    	    'label'     => __( 'Show Blog Meta', 'brooklyn' ),
    	    'description' => __('Check to hide the date, category, tags etc on blog page.', 'brooklyn'),
    	    'section'   => 'brooklyn_blog_section',
    	    'settings'  => 'brooklyn_blog_meta',
    	    'type'      => 'checkbox',
    	    'priority'  => 10
    	) );

    	/*Excerpt Length*/
    	$wp_customize->add_setting( 'brooklyn_blog_excerpt', array(
    	    'capability'        => 'edit_theme_options',
    	    'transport' 		=> 'refresh',
    	    'default'           => $default['brooklyn_blog_excerpt'],
    	    'sanitize_callback' => 'absint'
    	) );
    	$wp_customize->add_control( 'brooklyn_blog_excerpt', array(
    	    'label'     => __( 'Enter excerpt length', 'brooklyn' ),
    	    'description' => __('Enter the lenght of excerpt.', 'brooklyn'),
    	    'section'   => 'brooklyn_blog_section',
    	    'settings'  => 'brooklyn_blog_excerpt',
    	    'type'      => 'number',
    	    'priority'  => 10,
    	    'input_attrs' => array(
	            'min' => -1,
	            'max' => 50,
	            'step' => 1,
	        ),
    	) );

	// Footer Settings
    $wp_customize->add_section( 'footer_section' , array(
        'title'      => esc_html__( 'Footer Settings', 'brooklyn' ),
        'priority'   => 15,
        'panel' 		 => 'brooklyn_panel',
    ) );

	//Social Options
    $wp_customize->add_setting( 'brooklyn_twitter',array(
		'sanitize_callback'     => 'sanitize_text_field',
		'default'           	=> $default_options['brooklyn_twitter']
	));
    $wp_customize->add_setting( 'brooklyn_skype',array(
    	'sanitize_callback'     => 'sanitize_text_field',
    	'default'           	=> $default_options['brooklyn_skype']
    ));
    $wp_customize->add_setting( 'brooklyn_instagram',array(
    	'sanitize_callback'    	=> 'sanitize_text_field',
    	'default'           	=> $default_options['brooklyn_instagram']
    ));
    $wp_customize->add_setting( 'brooklyn_dribble',array(
    	'sanitize_callback'     => 'sanitize_text_field',
    	'default'           	=> $default_options['brooklyn_dribble']
    ));
    $wp_customize->add_setting( 'brooklyn_vimeo',array(
    	'sanitize_callback'     => 'sanitize_text_field',
    	'default'           	=> $default_options['brooklyn_vimeo']
    ));
    $wp_customize->add_setting( 'brooklyn_facebook',array(
    	'sanitize_callback'    	=> 'sanitize_text_field',
    	'default'           	=> $default_options['brooklyn_facebook']
    ));

    $wp_customize->add_setting( 'copyright_text',array(
    	'sanitize_callback' 	=> 'sanitize_textarea_field',
    	'default'           	=> $default_options['brooklyn_copyright_text']
    ));

    $wp_customize->add_control( 'copyright_text',
            array(
                'label'    => esc_html__( 'Copyright Text', 'brooklyn' ),
                'description' => esc_html__( 'Copyright Text', 'brooklyn' ),
                'section'  => 'footer_section',
                'settings' => 'copyright_text',
                'type'     => 'textarea'
            )
        );

    $wp_customize->add_control( 'brooklyn_facebook',
        array(
            'label'    => esc_html__( 'Facebook URL', 'brooklyn' ),
            'section'  => 'footer_section',
            'settings' => 'brooklyn_facebook',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'brooklyn_twitter',
        array(
            'label'    => esc_html__( 'Twitter URL', 'brooklyn' ),
            'section'  => 'footer_section',
            'settings' => 'brooklyn_twitter',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'brooklyn_skype',
        array(
            'label'    => esc_html__( 'Skype URL', 'brooklyn' ),
            'section'  => 'footer_section',
            'settings' => 'brooklyn_skype',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'brooklyn_instagram',
        array(
            'label'    => esc_html__( 'Instagram URL', 'brooklyn' ),
            'section'  => 'footer_section',
            'settings' => 'brooklyn_instagram',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'brooklyn_dribble',
        array(
            'label'    => esc_html__( 'Dribble URL', 'brooklyn' ),
            'section'  => 'footer_section',
            'settings' => 'brooklyn_dribble',
            'type'     => 'text'
        )
    );

    $wp_customize->add_control( 'brooklyn_vimeo',
        array(
            'label'    => esc_html__( 'Vimeo URL', 'brooklyn' ),
            'section'  => 'footer_section',
            'settings' => 'brooklyn_vimeo',
            'type'     => 'text'
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
