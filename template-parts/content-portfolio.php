<?php
/**
 * @package SteveRudolfi
 */
?>
<?php
	$date = get_post_meta( get_the_id(), '_port_date', true );
	$link_live = get_post_meta( get_the_id(), '_port_link_live', true );
	$link_local = get_post_meta( get_the_id(), '_port_link_local', true );
	$video = get_post_meta( get_the_id(), '_port_video', true );
	$pic_ids = get_post_meta( get_the_id(), '_pic' );
	
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-pad">
	
		<a href="<?php echo( get_bloginfo( 'url' ) ); ?>/portfolio">Back to Portfolio</a>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			
			<section class="portfolio-meta">
				<?php echo( get_the_post_thumbnail( get_the_id(), 'thumbnail' ) ); ?>
			</section>
			
			<p>Date: <?php echo( $date ); ?></p>
			<p>Live Link: <?php echo( $link_live ); ?></p>
			<p>Local Link: <?php echo( $link_local ); ?></p>
			<p>Video: <?php echo( $video ); ?></p>
			
			<?php if( $pic_ids ): ?>
				<section class="hidden-gallery">
					<div class="close-gallery">x</div>
					<?php
						foreach( $pic_ids as $pic_id ) {
							echo( wp_get_attachment_image( $pic_id, 'large' ) );
						}
					?>
				</section>
			<?php endif; ?>
			
			
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
		
		<footer class="entry-footer col-1">
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php echo( stever_show_entry_meta() ); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
