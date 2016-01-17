<?php
/**
 * SteveRudolfi functions and definitions
 * @package SteveRudolfi
 */

/* Constants */  
define( 'EVENTSURL', home_url( '/' ) . 'about/events/' );


/* Theme Init */
function stever_setup() {

	/* Add default posts and comments RSS feed links to head. */
	add_theme_support( 'automatic-feed-links' );

	/* Let WordPress manage the document title. */
	add_theme_support( 'title-tag' );

	/* Enable support for Post Thumbnails on posts and pages. */
	add_theme_support( 'post-thumbnails' );

	/* Register Menu Positions */
	register_nav_menus( array(
		'primary' => 'Primary Menu',
		'social' => 'Social Icons',
	) );

	/* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	
	
}
add_action( 'after_setup_theme', 'stever_setup' );

/* Enqueue admin script and style. */
function stever_admin_scripts_styles(){
	wp_enqueue_style( 'admin', get_template_directory_uri() . '/admin/admin.css' );
	wp_enqueue_script( 'admin', get_template_directory_uri() . '/admin/admin.js', array('jquery') );
}
add_action( 'admin_print_styles', 'stever_admin_scripts_styles' );



/* Enqueue scripts and styles. */
function stever_scripts() {
	wp_enqueue_style( 'stever-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );

	if( is_page_template( 'page-places.php' ) ){
		wp_enqueue_style( 'stever-openlayers', get_template_directory_uri() . '/js/openlayers/ol.css' );
		wp_enqueue_script( 'stever-openlayers', get_template_directory_uri() . '/js/openlayers/ol.js', ( 'jquery' ) );
		wp_enqueue_script( 'stever-map', get_template_directory_uri() . '/js/openlayers/map.js', array( 'jquery', 'stever-openlayers' ) );
	}
	
	if( is_single() ){
		wp_enqueue_script( 'stever-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'stever_scripts' );


/* Custom end of excerpt */
function stever_excerpt_more( $more ) {
	return '<a href="'. get_the_permalink() . '"> ...</a>';
}
add_filter( 'excerpt_more', 'stever_excerpt_more' );

/* Smaller excerpt length */ 
function stever_smaller_excerpt_length( $length ) {
	return 20;
}

/* Different Image Dimensions */
function stever_image_sizes() {
	update_option( 'medium_size_w', 360 );
	update_option( 'medium_size_h', 200 );
	update_option( 'medium_crop', 1 );
}
add_action( 'after_setup_theme', 'stever_image_sizes' );


function disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}
function disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );



/* Template tags */
require get_template_directory() . '/inc/template-tags.php';

/* Shortcodes */
require get_template_directory() . '/inc/shortcodes.php';

/* Custom Post Types */
require get_template_directory() . '/inc/custom-post-types.php';

/* Custom Dashboard Widgets */
require get_template_directory() . '/inc/dashboard.php';

/* Map Stuff */
require get_template_directory() . '/inc/make-json-for-map.php';

