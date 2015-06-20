<?php
/**
 * The template for displaying all single posts.
 *
 * @package SteveRudolfi
 */
?>

<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php 
			$is_portfolio = get_post_meta( get_the_id(), '_is_portfolio', true );
			if( $is_portfolio == 1 ) {
				get_template_part( 'template-parts/content', 'portfolio' );
			} else {
				get_template_part( 'template-parts/content', 'single' );
			}
			?>
			<?php the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
