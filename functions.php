<?php
/**
 * SteveRudolfi functions and definitions
 *
 * @package SteveRudolfi
 */

 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'stever_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stever_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on SteveRudolfi, use a find and replace
	 * to change 'stever' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'stever', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'stever' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'stever_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // stever_setup
add_action( 'after_setup_theme', 'stever_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function stever_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'stever' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'stever_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
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

/**
 * Enqueue admin script and style.
 */
function stever_admin_scripts_styles(){

	wp_enqueue_style( 'admin', get_template_directory_uri() . '/admin/admin.css' );
	wp_enqueue_script( 'admin', get_template_directory_uri() . '/admin/admin.js', array('jquery') );
}
add_action( 'admin_print_styles', 'stever_admin_scripts_styles' );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Custom Post Types
 */

require get_template_directory() . '/inc/custom-post-types.php';



function add_info( $post_id, $post, $update ) {


	$json = array();
	$args = array(
		'post_type'			=> 'place',
		'posts_per_page'	=> -1
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
	
		$json = array();
			$json['type'] = 'FeatureCollection';
			
			$features = array();
	
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			
			$the_lat = get_post_meta( get_the_ID(), 'latitude', true );
			$the_lng = get_post_meta( get_the_ID(), 'longitude', true );
			$the_name = get_the_title();
			$the_address= get_post_meta( get_the_ID(), 'address', true );
			$the_type = get_post_meta( get_the_ID(), 'type', true );
			$the_count = get_post_meta( get_the_ID(), 'count', true );
			
			
			
			$set = array();
				$set['type'] = 'Feature';
			
				$geometry = array();
					$geometry['type'] = 'Point';
					$geometry['coordinates'] = [$the_lng, $the_lat];
				$set['geometry'] = $geometry;
				
				$properties = array();
					$properties['name'] = $the_name;
					$properties['address'] = $the_address;
					$properties['type'] = $the_type;
					$properties['count'] = $the_count;
				$set['properties'] = $properties;
			
			array_push($features, $set);
			
		}
		$json['features'] = $features;
		
	}
	
	/*
	"type": "Feature",
	"geometry": {"type": "Point", "coordinates": [-72.174790, 21.797286]},
	"properties": {
		"name": "Providenciales, Turks and Caicos",
		"type": 	"Vacationed",
		"length": 	"1 Week",
		"count":	"1"
	}
	*/
	
	$file = ABSPATH . 'latest.json';
	file_put_contents($file, json_encode($json));
}
add_action( 'save_post_place', 'add_info', 10, 3 );