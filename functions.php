<?php

/*==================================== THEME SETUP ====================================*/

// Load default style.css and Javascripts
add_action('wp_enqueue_scripts', 'glades_enqueue_scripts');

function glades_enqueue_scripts() {

	// Register and Enqueue Stylesheet
	wp_enqueue_style('glades-stylesheet', get_stylesheet_uri());
	
	// Register Genericons
	wp_enqueue_style('glades-genericons', get_template_directory_uri() . '/css/genericons/genericons.css');

	// Register and enqueue navigation.js
	wp_enqueue_script('glades-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery'));

	// Register Comment Reply Script for Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register and Enqueue Fonts
	wp_enqueue_style('glades-default-fonts', glades_google_fonts_url(), array(), null );

}


// Retrieve Font URL to register default Google Fonts
function glades_google_fonts_url() {
    $fonts_url = '';
	
	// Get Theme Options from Database
	$theme_options = glades_theme_options();
	
	// Only embed Google Fonts if not deactivated
	if ( ! ( isset($theme_options['deactivate_google_fonts']) and $theme_options['deactivate_google_fonts'] == true ) ) :
		
		// Define Default Fonts
		$font_families = array('PT Sans:700,400', 'Contrail One');
		
		// Set Google Font Query Args
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		
		// Create Fonts URL
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		
	endif;

    return apply_filters( 'glades_google_fonts_url', $fonts_url );
}


// Setup Function: Registers support for various WordPress features
add_action( 'after_setup_theme', 'glades_setup' );

function glades_setup() {

	// Set Content Width
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 860;
	
	// init Localization
	load_theme_textdomain('glades', get_template_directory() . '/languages' );

	// Add Theme Support
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_editor_style();
	
	// Add Post Thumbnails
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size( 900, 280, true );
	
	// Add Custom Background
	add_theme_support('custom-background', array('default-color' => 'e5e5e5'));

	// Add Custom Header
	add_theme_support('custom-header', array(
		'header-text' => false,
		'width'	=> 2500,
		'height' => 200,
		'flex-height' => true));

	// Register Navigation Menus
	register_nav_menu( 'primary', esc_html__( 'Main Navigation', 'glades' ) );
	register_nav_menu( 'secondary', esc_html__( 'Top Navigation', 'glades' ) );
	
	// Register Social Icons Menu
	register_nav_menu( 'social', esc_html__( 'Social Icons', 'glades' ) );

}


// Add custom Image Sizes
add_action( 'after_setup_theme', 'glades_add_image_sizes' );

function glades_add_image_sizes() {
	
	// Add Custom Header Image Size
	add_image_size( 'glades-header-image', 2500, 200, true);
	
	// Add Featured Content Image Sizes
	add_image_size( 'glades-featured-content-left', 820, 370, true);
	add_image_size( 'glades-featured-content-right', 425, 175, true);
	
	// Add Category Post Widget image sizes
	add_image_size( 'glades-category-posts-widget-small', 140, 90, true);
	add_image_size( 'glades-category-posts-widget-medium', 300, 175, true);
	add_image_size( 'glades-category-posts-widget-large', 600, 280, true);
	add_image_size( 'glades-category-posts-widget-extra-large', 600, 350, true);
	
}


// Register Sidebars
add_action( 'widgets_init', 'glades_register_sidebars' );

function glades_register_sidebars() {

	// Register Sidebar
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'glades' ),
		'id' => 'sidebar',
		'description' => esc_html__( 'Appears on posts and pages except Magazine Homepage and Fullwidth template.', 'glades' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	
	// Register Magazine Homepage
	register_sidebar( array(
		'name' => esc_html__( 'Magazine Homepage', 'glades' ),
		'id' => 'magazine-homepage',
		'description' => esc_html__( 'Appears on Magazine Homepage template only. You can use the Category Posts widgets here.', 'glades' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));

}


/*==================================== INCLUDE FILES ====================================*/

// include Theme Info page
require( get_template_directory() . '/inc/theme-info.php' );

// include Theme Customizer Options
require( get_template_directory() . '/inc/customizer/customizer.php' );
require( get_template_directory() . '/inc/customizer/default-options.php' );

// include Customization Files
require( get_template_directory() . '/inc/customizer/frontend/custom-layout.php' );
require( get_template_directory() . '/inc/customizer/frontend/custom-slider.php' );

// Include Extra Functions
require get_template_directory() . '/inc/extras.php';

// include Template Functions
require( get_template_directory() . '/inc/template-tags.php' );

// Include support functions for Theme Addons
require get_template_directory() . '/inc/addons.php';

// include Widget Files
require( get_template_directory() . '/inc/widgets/widget-category-posts-boxed.php' );
require( get_template_directory() . '/inc/widgets/widget-category-posts-columns.php' );
require( get_template_directory() . '/inc/widgets/widget-category-posts-grid.php' );

// Include Featured Content class
require( get_template_directory() . '/inc/featured-content.php' );