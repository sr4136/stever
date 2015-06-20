<?php
/**
 * Custom template tags for this theme.
 * @package SteveRudolfi
 */

 function stever_add_portfolio_class( $classes ) {
	global $post;
	if ( is_single() && get_post_meta( get_the_id(), '_is_portfolio', true ) == 1 ) {
		$classes[] = 'portfolio-item';
	}
	return $classes;
}
add_filter( 'body_class', 'stever_add_portfolio_class' );