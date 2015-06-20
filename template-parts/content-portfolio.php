<?php
/**
 * @package SteveRudolfi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo( get_bloginfo( 'url' ) ); ?>/portfolio">Back to Portfolio</a>
	<header class="entry-header">
		PORTFOLIO <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'stever' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
