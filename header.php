<?php
/**
 * @package SteveRudolfi
 */
?><!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Social Meta -->
	<?php echo( stever_generate_social_meta() ); ?>
	<!-- /Social Meta -->
	<?php wp_head(); ?>
	<?php get_template_part( 'template-parts/favicons' ); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
	
		<div id="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img id="site-title" src="<?php echo( get_stylesheet_directory_uri() . '/img/logo.png'); ?>" />
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
			</a> 
		</div><!-- .site-branding -->
		
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">