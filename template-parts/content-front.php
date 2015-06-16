<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package SteveRudolfi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" class="grid-pad">
		<h1>SteveRudolfi.com</h1>
	</header><!-- .entry-header -->

	<div class="entry-content" class="grid-pad">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<section id="featured-portfolio" class="grid-pad">
		<h2>Featured Portfolio Items</h2>
	</section>
	
	<section id="latest-blogs" class="grid-pad">
		<h2>Latest Blog Posts</h2>
	</section>
	
	<section id="latest-activity" class="grid-pad">
		<h2>Latest Activity</h2>
		<div id="latest-events" class="col-3-4">
			<h3>Conferences, Meetups, Events, Speaking</h3>
			<?php
			$args = array(
				'post_type' => 'event',
				'posts_per_page' => 5
			);
			$events_query = new WP_Query( $args );
			?>
			<?php if( $events_query->have_posts() ): ?>
				<ul>
				<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>
					<li>
						<span><?php the_time('m/d/y'); ?></span>
						<a href="<?php echo( EVENTSURL . "?ev=" . get_the_id() ); ?>">
							<?php the_title(); ?>
						</a>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<div id="latest-tweets" class="col-1-4">
			<h3>Tweets</h3>
			<?php get_template_part( 'template-parts/tweetlist' ); ?>
		</div>
	
	</section>
</article><!-- #post-## -->
