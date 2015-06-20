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
			<?php
			$portfolio_args = array(
				'post_type'			=> 'post',
				'post_status' => array( 'publish' ),
				'posts_per_page'	=> 3,
				'meta_key' 			=> '_is_portfolio',
				'meta_value'		=> 1
			);
			$portfolio_query = new WP_Query( $portfolio_args );
			?>
			<?php if( $portfolio_query->have_posts() ): ?>
				<?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
					<?php
						$post_index = $portfolio_query->current_post;
						$thumb_size = ( $post_index == 0 ) ? 'medium' : 'thumbnail';
						$thumb_id = get_post_thumbnail_id( $post->ID );
						$thumb_details = wp_get_attachment_image_src( $thumb_id, $thumb_size );
					?>
					<?php if( $post_index == 0 ): ?>
						<div class="col-5-8">
							<article class="featured">
								<a href="<?php echo( get_the_permalink() ); ?>">
									<?php if( $thumb_id ): ?>
										<img src="<?php echo( $thumb_details[0] ); ?>" />
									<?php endif; ?>
									<h3><?php echo( get_the_title() ); ?></h3>
								</a>
								<?php the_excerpt(); ?>
							</article>
						</div>
						<div class="col-3-8">
					<?php else: ?>
						<article>
							<a href="<?php echo( get_the_permalink() ); ?>">
								<?php if( $thumb_id ): ?>
									<img src="<?php echo( $thumb_details[0] ); ?>" />
								<?php endif; ?>
								<h3><?php echo( get_the_title() ); ?></h3>
							</a>
							<?php the_excerpt(); ?>
						</article>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
	</section>
	
	<section id="latest-blogs" class="grid-pad">
		<h2>Latest Blog Posts</h2>
		<?php
			$blog_args = array(
				'post_type'			=> 'post',
				'post_status' 		=> array( 'publish' ),
				'posts_per_page'	=> 5,
				'meta_query'		=> array(
					'relation' 		=> 'OR',
					array(
						'key'		=> '_is_portfolio',
						'compare'	=> 'NOT EXISTS'
					),
					array(
						'key'		=> '_is_portfolio',
						'value'		=> 0
					)
				)
			);
			$blog_query = new WP_Query( $blog_args );
			?>
			<?php if( $blog_query->have_posts() ): ?>
				<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
					<?php 
						$post_index = $blog_query->current_post;
						$thumb_size = ( $post_index == 0 ) ? 'medium' : 'thumbnail';
						$thumb_details = wp_get_attachment_image_src( $thumb_id, 'medium' );
					?>
					<?php if( $post_index == 0 ): ?>
						<div class="col-3-8">
							<article class="featured">
								<a href="<?php echo( get_the_permalink() ); ?>">
									<?php if( $thumb_id ): ?>
										<img src="<?php echo( $thumb_details[0] ); ?>" />
									<?php endif; ?>
									<h3><?php echo( get_the_title() ); ?></h3>
								</a>
								<?php the_excerpt(); ?>
							</article>
						</div>
						<div class="col-5-8">
					<?php else: ?>
						<article>
							<a href="<?php echo( get_the_permalink() ); ?>">
								<h3><?php echo( get_the_title() ); ?></h3>
							</a>
						</article>
					<?php endif; ?>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
	</section>
	    
	<section id="latest-activity" class="grid-pad">
		<h2>Latest Activity</h2>
		<div id="latest-events" class="col-2-3">
			<h3>Conferences, Meetups, Events, Speaking</h3>
			<?php
			$events_args = array(
				'post_type' => 'event',
				'post_status' => array( 'publish' ),
				'posts_per_page' => 5
			);
			$events_query = new WP_Query( $events_args );
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
		<div id="latest-tweets" class="col-1-3">
			<h3>Tweets</h3>
			<?php get_template_part( 'template-parts/tweetlist' ); ?>
		</div>
	
	</section>
</article><!-- #post-## -->
