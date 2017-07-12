<?php
/**
 * Qoob Theme Customizer.
 *
 * @package qoob
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

	$wp_customize->add_section( 'blog_settings', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Blog Settings', 'qoob' ),
		'description' => '',
		'panel' => '',
	));

	$wp_customize->add_setting( 'blog_image_bg', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'blog_image_bg',
			array(
				'label'      => esc_html__( 'Upload a blog background', 'qoob' ),
				'section'    => 'blog_settings',
				'settings'   => 'blog_image_bg',
				'description' => esc_html__( 'Your theme recommends a blog background size of 1900 x 370 pixels.', 'qoob' ),
				'context'    => 'your_setting_context',
			)
		)
	);

	$wp_customize->add_setting( 'blog_sidebar', array(
		'default' => 'sidebar_right',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'blog_sidebar',
			array(
				'label' => __( 'Blog layout', 'qoob' ),
				'type' => 'radio',
				'section' => 'blog_settings',
				'choices' => array(
					'sidebar_right'   => esc_html__( 'With sidebar', 'qoob' ),
					'no_sidebar'  => esc_html__( 'Without sidebar', 'qoob' ),
				),
			)
		)
	);

	$wp_customize->add_section( 'footer_settings', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Footer Settings', 'qoob' ),
		'description' => '',
		'panel' => '',
	));

	$wp_customize->add_setting( 'footer_text', array(
		'default' => __( 'Copyright qoob', 'qoob' ) . ' ' . date( 'Y' ),
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( 'footer_text', array(
		'type' => 'text',
		'priority' => 10,
		'section' => 'footer_settings',
		'label' => __( 'Footer text', 'qoob' ),
		'description' => '',
	) );

	$wp_customize->add_section( 'my_social_settings', array(
		'title'    => esc_html__( 'Social Media Icons', 'qoob' ),
		'panel'       => 'nav_menus',
		'priority' => 5,
	));

	$social_sites = qoob_customizer_social_media_array();
	$priority = 5;

	foreach ( $social_sites as $social_site ) {
		$wp_customize->add_setting( $social_site, array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( $social_site, array(
				'label'    => $social_site . ' ' . esc_html__( 'url:', 'qoob' ),
				'section'  => 'my_social_settings',
				'type'     => 'text',
				'priority' => $priority,
		) );

		$priority = $priority + 5;
	}
}

add_action( 'customize_register', 'qoob_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function qoob_theme_customize_preview_js() {
	wp_enqueue_script( 'qoob_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'qoob_theme_customize_preview_js' );

/**
 * Store the Social Media Site Names
 */
function qoob_customizer_social_media_array() {
	/* store social site names in array */
	$social_sites = array( 'github', 'twitter' );
	return $social_sites;
}
