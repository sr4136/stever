<?php
/**
 * Custom shortcodes for this theme
 * @package SteveRudolfi
 */

/* Pulls content from a repeatable metabox by that box's index */
function sr_extra_content( $atts ) {
	$the_id =  $atts[ 'id' ];
	$type = get_post_meta( get_the_id(), '_extra_type')[ $the_id ];
	$the_title = get_post_meta( get_the_id(), '_extra_title')[ $the_id ];
	$is_expandable = get_post_meta( get_the_id(), '_expandable')[ $the_id ];

	$title = '';
	$before_outer = '';
	$after_outer = '';
	$before_inner = '';
	$after_inner = '';
	
	if( $is_expandable && $the_title ){
		$before_outer = '[expand title="' . htmlentities( $the_title ) . '"]';
		$after_outer = '[/expand]';
	}else if( $the_title ){
		$title = '<h3>' . get_post_meta( get_the_id(), '_extra_title' )[ $the_id ] . '</h3>';
	}
	
	$content = get_post_meta( get_the_id(), '_extra_content' )[ $the_id ];
	if( $type == 'code' ){
		$before_inner = '<code><pre>';
		$content = htmlentities( $content );
		$after_inner = '</pre></code>';
	}else if( $type !== 'blank' ){
		$before_inner = '<div class="' . $type . '">';
		$after_inner = '</div>';
	}else {
		$content = nl2br( $content );
	}
	
	return do_shortcode( $title . $before_outer . $before_inner . $content . $after_inner . $after_outer );
}
add_shortcode( 'extra', 'sr_extra_content' );


/* Embeds Youtube videos */
function sr_responsive_youtube( $atts ) {
	$the_id =  $atts[0];
	$ret_str = '<div class="responsive-video"><iframe width="560" height="315" src="https://www.youtube.com/embed/' . $the_id . '" frameborder="0" allowfullscreen></iframe></div>';
	return  $ret_str ;
}
add_shortcode( 'responsive_youtube', 'sr_responsive_youtube' );


/* Embeds Instagram photos/videos */
function sr_instagram( $atts ) {
	wp_enqueue_script( 'instagram_embed', '//platform.instagram.com/en_US/embeds.js' );
	
	$the_id =  $atts[0];
	$ret_str = '<blockquote class="instagram-media" style="background: #FFF; border: 0; border-radius: 3px; box-shadow: 0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width: 658px; padding: 0; width: calc(100% - 2px);" data-instgrm-version="4"><div style="padding: 8px;"><div style="background: #F8F8F8; line-height: 0; margin-top: 40px; padding: 50% 0; text-align: center; width: 100%;"></div><p style="color: #c9c8cd; font-family: Arial,sans-serif; font-size: 14px; line-height: 17px; margin-bottom: 0; margin-top: 8px; overflow: hidden; padding: 8px 0 7px; text-align: center; text-overflow: ellipsis; white-space: nowrap;"><a style="color: #c9c8cd; font-family: Arial,sans-serif; font-size: 14px; font-style: normal; font-weight: normal; line-height: 17px; text-decoration: none;" href="https://instagram.com/p/' . $the_id . '" target="_top">A video posted by Steve (@sr4136)</a></p></div></blockquote>';
	return  $ret_str ;
}
add_shortcode( 'instagram', 'sr_instagram' );