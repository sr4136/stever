<?php
/**
 * Adds Custom Post Types
 *
 * @package SteveRudolfi
 */

function stever_add_custom_posts() {
	register_post_type('event', array(
		'labels' => array(
			'name' => __('Events'),
			'singular_name' => __('Event')
		),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'supports' => array('title'),
		)
	);
	
	register_post_type('place', array(
		'labels' => array(
			'name' => __('Places'),
			'singular_name' => __('Place')
		),
		'public' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'supports' => array('title', 'custom-fields'),
		)
	);
}
add_action('init', 'stever_add_custom_posts');