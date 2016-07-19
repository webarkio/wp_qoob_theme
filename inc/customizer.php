<?php
/**
 * wp_qoob_theme Theme Customizer.
 *
 * @package wp_qoob_theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function qoob_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_control('blogdescription'); //remove tagline input

	$wp_customize->add_section( 'blog_settings', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Blog Settings', 'wp_qoob_theme' ),
	    'description' => '',
	    'panel' => '',
	));

	$wp_customize->add_setting( 'blog_image_bg', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'esc_url',
	));

	$wp_customize->add_control( 
		new WP_Customize_Image_Control(
		    $wp_customize,
		    'blog_image_bg',
		    array(
		        'label'      => __( 'Upload a blog background', 'wo_qoob_theme' ),
		        'section'    => 'blog_settings',
		        'settings'   => 'blog_image_bg',
		        'description' => __( 'Your theme recommends a blog background size of 1900 × 370 pixels.' ),
		        'context'    => 'your_setting_context' 
		    )
		)
	);

	$wp_customize->add_setting( 'blog_sidebar', array(
		'default' => 'sidebar_right',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'esc_html',
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
	        'blog_sidebar',
	       	array(
		  		'label' => __( 'Blog layout' ),
		  		'type' => 'radio',
		  		'section' => 'blog_settings',
		  		'choices' => array(
	            	'sidebar_right'   => __( 'With sidebar' ),
	            	'no_sidebar'  => __( 'Without sidebar' )
	       		)
			)
		)
	);

	$wp_customize->add_section( 'footer_settings', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Footer Settings', 'wp_qoob_theme' ),
	    'description' => '',
	    'panel' => '',
	));

	$wp_customize->add_setting( 'footer_text', array(
		'default' => __('© qoob 2016', 'wp_qoob_theme'),
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'footer_text', array(
	    'type' => 'text',
	    'priority' => 10,
	    'section' => 'footer_settings',
	    'label' => __( 'Footer text', 'wp_qoob_theme' ),
	    'description' => '',
	) );
}

add_action( 'customize_register', 'qoob_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function qoob_theme_customize_preview_js() {
	wp_enqueue_script( 'qoob_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'qoob_theme_customize_preview_js' );
