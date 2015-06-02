<?php
/**
 * Custom shortcodes for this theme
 * @package SteveRudolfi
 */

function sc_extra_content( $atts ) {
	$the_id =  $atts[ 'id' ];
	$ret_str = '<h3>' . get_post_meta( get_the_id(), '_title' )[ $the_id ] . '</h3>';
	$ret_str .= get_post_meta( get_the_id(), '_content' )[ $the_id ] ;

	return $ret_str;
}
add_shortcode( 'extra', 'sc_extra_content' );