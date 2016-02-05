<?php
/**
 * @package SteveRudolfi
 * Template partial used to render single posts.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php edit_post_link(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content grid-pad">
		
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'stever' ),
				'after'  => '</div>',
			) );
		?>
		
		<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		
	</div><!-- .entry-content -->
</article><!-- #post-## -->
