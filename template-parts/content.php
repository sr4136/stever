<?php
/**
 * @package SteveRudolfi
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-pad">
		<?php echo( stever_show_is_portfolio() ); ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
			<?php edit_post_link(); ?>
		</header><!-- .entry-header -->

	
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
		
		<footer class="entry-footer col-1">
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php echo( stever_show_entry_meta() ); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->