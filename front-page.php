<?php
/**
 * The template for displaying the homepage.
 *
 * @package SteveRudolfi
 */

get_header(); 
define( 'EVENTSURL', home_url( '/' ) . 'about/events/' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'front' ); ?>
			<?php endwhile; // end of the loop. ?>
			
			<section id="latest-events">
				<?php
				$args = array(
					'post_type' => 'event',
					'posts_per_page' => 5
				);
				$events_query = new WP_Query( $args );
				?>
				<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
					<a href="<?php echo( EVENTSURL . "?ev=" . get_the_id() ); ?>">
						<h2><?php the_title(); ?></h2>
					</a>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
