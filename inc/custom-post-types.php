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
		'public' => false,
		'has_archive' => false,
		'hierarchical' => false,
		'supports' => array('title'),
		)
	);
}
add_action('init', 'stever_add_custom_posts');