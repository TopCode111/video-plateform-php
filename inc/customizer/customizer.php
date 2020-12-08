<?php
/**
 * myprofile Theme Customizer
 *
 * @package myprofile
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


function myprofile_customizer_option( $wp_customize ) {

//Header BG Section
	
	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'     => '#272a6e',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'bg_color',
			array(
				'label'      => esc_html__( 'Header Background Color', 'myprofile' ),
				'section'    => 'colors',
				'settings'   => 'header_bg_color',
				'priority'   =>'2'
			)
			
		)
	);
//Menu Area 
$wp_customize->add_setting(
		'custom_menu_color',
		array(
			'default'     => '#fff',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control(
	new WP_Customize_Color_Control(
			$wp_customize,
			'menu_color',
			array(
				'label'      => esc_html__('Main Menu Color', 'myprofile'),
				'section'    => 'colors',
				'settings'   => 'custom_menu_color',
			)
		)
	);	
//Bread Title Color	
$wp_customize->add_setting(
		'bread_title_color',
		array(
			'default'     => '#fff',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
	new WP_Customize_Color_Control(
			$wp_customize,
			'bread_title_color',
			array(
				'label'      => esc_html__('Bread Title Color', 'myprofile'),
				'section'    => 'colors',
				'settings'   => 'bread_title_color',
			)
		)
	);


//Bread Crumb Section 	
	$wp_customize->add_setting(
		'bread_bg_color',
		array(
			'default'     => '#3d42b2',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
	new WP_Customize_Color_Control(
			$wp_customize,
			'bread_bg_color',
			array(
				'label'      => esc_html__('Bread BG Color', 'myprofile'),
				'section'    => 'colors',
				'settings'   => 'bread_bg_color',
			)
		)
	);
	
//End of Menu

//Footer SEction 	
	$wp_customize->add_section('myprofile_footer_section', array(
		'title'    => esc_html__('Footer', 'myprofile'),
		'priority' => 120,
	));


	$wp_customize->add_setting('copyright_txt', array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	));

	$wp_customize->add_control('footer_copyright', array(
		'label'      => esc_html__('Footer Copyright Text', 'myprofile'),
		'section'    => 'myprofile_footer_section',
		'settings'   => 'copyright_txt',
        'type'       =>'textarea'
	));

//End of Footer Section 


}
add_action( 'customize_register', 'myprofile_customizer_option' );



function myprofile_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'myprofile_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'myprofile_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'myprofile_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function myprofile_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function myprofile_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function myprofile_customize_preview_js() {
	wp_enqueue_script( 'myprofile-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'myprofile_customize_preview_js' );

function myprofile_customizer_css() {
	?>
	<style type="text/css">
		.header-section { background-color: <?php echo esc_html(get_theme_mod( 'header_bg_color' )); ?>; }
	
		ul.primary-menu>li>a { color: <?php echo esc_html(get_theme_mod( 'custom_menu_color' )); ?>; }
		
		.page-title{ background-color: <?php echo esc_html(get_theme_mod( 'bread_bg_color' )); ?>; }
		
		.page-title h3{ color: <?php echo esc_html(get_theme_mod( 'bread_title_color' )); ?>; }
				
	</style>
	<?php
}
add_action( 'wp_head', 'myprofile_customizer_css' );