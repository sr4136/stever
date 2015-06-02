<?php
/**
 * Map Functionality
 * Generates a JSON file based on the 'place' custom post type
 * Runs on 'place' post type save
 * @package SteveRudolfi
 */
 
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

	$file = ABSPATH . 'latest.json';
	file_put_contents($file, json_encode($json));
}
add_action( 'save_post_place', 'add_info', 10, 3 );