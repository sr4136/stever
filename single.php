<?php
/**
 * The template for displaying all single posts.
 *
 * @package SteveRudolfi
 */
?>

<?php get_header(); ?>
	<div id="primary" class="content-area">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php 
			$is_portfolio = get_post_meta( get_the_id(), '_is_portfolio', true );
			if( $is_portfolio == 1 ) {
				get_template_part( 'template-parts/content', 'portfolio' );
			} else {
				get_template_part( 'template-parts/content', 'single' );
			}
			?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
