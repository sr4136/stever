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


function stever_social_tag_debug_box() {
	add_meta_box( 'stever_social_tag_debug', 'Social Tag Debugging', 'stever_social_tag_debug', 'post' );
}
add_action( 'add_meta_boxes', 'stever_social_tag_debug_box' );

function stever_social_tag_debug( $post ) {
	$social_meta = stever_generate_social_meta( get_the_id(), false );
	echo( '<pre>' );
		foreach( $social_meta as $property=>$content ){
			if( $content ){
				echo( '[' . $property . '] ' . $content . '<br/>');
			}
		}
	echo( '</pre>' );
}


function stever_generate_social_meta( $given_id = false, $echo = true) {
	$post_id = ( $given_id ? $given_id : get_the_id() );

	$social_meta = array();
	
	/* Static (Manual value) */
	$user = '@steverudolfi';
	$type = 'website';
	
	/* Generated (From one place)*/
	$title = get_the_title( $post_id );
	$url = get_the_permalink( $post_id );
	$name = get_bloginfo( 'name' );
	
	/* Overrideable (Dynamic + Overrideable by metaboxes) */
	$twitter_card_or = get_post_meta( $post_id, '_social_twitter_type', true );
	$twitter_card = ( $twitter_card_or ? $twitter_card_or : 'summary' );
	
	$description_or = get_post_meta( $post_id, '_social_description', true );
	$description = ( $description_or ? $description_or : '' );
	
	$image_or_id = get_post_meta( $post_id, '_social_image', true );
	
	$og_image_or = wp_get_attachment_image_src( $image_or_id, 'full' );
	$og_image = ( $og_image_or ? $og_image_or[0] : '' );
	
	$twitter_image_or = null;
	if( $twitter_card == 'summary') {
		$twitter_image_or = wp_get_attachment_image_src( $image_or_id, 'thumbnail' );
	}else {
		$twitter_image_or = wp_get_attachment_image_src( $image_or_id, 'full' );
	}
	$twitter_image = ( $twitter_image_or ? $twitter_image_or[0] : '' );

	
	/* Static */
	$social_meta['twitter:site']		= $user;
	$social_meta['twitter:creator']		= $user;
	$social_meta['og:type']				= $type; 
	
	/* Generated */
	$social_meta['twitter:site_name']	= $name;
	$social_meta['twitter:title']		= $title; // Generate from Title
	$social_meta['og:title']			= $title; // Generate from Title
	$social_meta['og:url']				= $url; // Generate from Permalink
	$social_meta['og:site_name']		= $name; // Generate from Site Name
		
	
	/* Override.able */
	$social_meta['twitter:card']			= $twitter_card; // Static | Override
	$social_meta['twitter:description'] 	= $description; // Generate from excerpt | Override
	$social_meta['twitter:image']			= $twitter_image; // Generate from featured| Override (size depends on twitter:card type)
	$social_meta['og:description']			= $description; // Generate from excerpt| Override
	$social_meta['og:image']				= $og_image; // Generate from featured| Override

	
	
	if( $echo ) {
		/* Return a string */
		$ret_str = '';
		foreach( $social_meta as $property=>$content ){
			$ret_str .= sprintf( '<meta property="%s" content="%s" />', $property, $content );
		}
		return $ret_str;
	}else {
		/* Return an array */
		return $social_meta;
	}
}

function stever_show_is_portfolio(){
	$ret_str = '<div class="is-portfolio">Portfolio</div>';
	$is_portfolio = get_post_meta( get_the_id(), '_is_portfolio', true );
	if( !$is_portfolio ){
		return;
	}
	return $ret_str;
}



function stever_show_entry_meta(){
	$ret_str = '';
	
	/* Date */
	$ret_str .= '<div class="date">Posted on: <date>' . get_the_time('F j, Y') . '</date></div>';
	
	/* Categories */
	$cats = get_the_category();
	foreach( $cats as $key=>$cat ){
		if( $cat->slug == 'uncategorized' ){
			unset( $cats[$key] );
		}
	}
	if($cats){
		$ret_str .= '<div class="categories">Categorized: ';
			foreach( $cats as $key=>$cat ){
				$link = get_term_link( $cat );
				$ret_str .= sprintf( '<span><a href="%s">%s</a></span>', $link, $cat->name );
			}
		$ret_str .= '</div>';
	}
	
	/* Tags */
	$tags = get_the_tags();
	if($tags){
		$ret_str .= '<div class="tags">Tagged: ';
			foreach( $tags as $key=>$tag ){
				$link = get_term_link( $tag );
				$ret_str .= sprintf( '<span><a href="%s">%s</a></span>', $link, $tag->name );
			}
		$ret_str .= '</div>';
	}
	
	
	/* Return */
	return $ret_str;
}








