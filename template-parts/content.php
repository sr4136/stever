<?php
/**
 * @package SteveRudolfi
 * Template partial used to render single posts on index listing
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php echo( stever_show_is_portfolio() ); ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<?php edit_post_link(); ?>
		</header><!-- .entry-header -->
	
	<div class="grid-pad">
		<div class="entry-content col-1">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'stever' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'stever' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		
		<?php if ( 'post' == get_post_type() ) : ?>
			<footer class="entry-meta col-1">
				<?php echo( stever_show_entry_meta() ); ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>
	</div>
</article><!-- #post-## -->