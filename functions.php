<?php
/**
 * SteveRudolfi functions and definitions
 * @package SteveRudolfi
 */

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

	wp_enqueue_script( 'stever-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'stever-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if( is_page_template( 'page-places.php' ) ){
		wp_enqueue_style( 'stever-openlayers', get_template_directory_uri() . '/js/openlayers/ol.css' );
		wp_enqueue_script( 'stever-openlayers', get_template_directory_uri() . '/js/openlayers/ol.js', ( 'jquery' ) );
		wp_enqueue_script( 'stever-map', get_template_directory_uri() . '/js/openlayers/map.js', array( 'jquery', 'stever-openlayers' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'stever_scripts' );

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

