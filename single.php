<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php
				if( function_exists( 'CFS' ) ){
					$completed = CFS()->get( 'completed_on' );
					$project_type = CFS()->get( 'project_type' );
					$technical_details = CFS()->get( 'technical_details' );
					$other_credit = CFS()->get( 'other_credit' );

					$link_live = CFS()->get( 'link_live' );
					$link_local = CFS()->get( 'link_local' );
					$images = CFS()->get( 'images' );
					$image_count = count( $images );
					$first_image = $images[0];
					$first_image_thumb_src = wp_get_attachment_image_src( $first_image[image], 'bones-thumb-300' );
				}

			?>


			<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
				<article id="post-not-found" class="hentry cf">

					<header class="article-header">
						<h1><?php the_title(); ?></h1>

						<?php if( $completed ): ?>
							<div class="byline"><strong>Completed:</strong> <?php echo( $completed ); ?></div>
						<?php endif; ?>
						<?php if( $project_type ): ?>
							<div class="byline"><strong>Project Type:</strong> <?php echo( $project_type ); ?></div>
						<?php endif; ?>
					</header>

					<section class="entry-content">
						<h3>Project Summary:</h3>

						<?php the_content(); ?>

						<?php if( $technical_details ): ?>
							<div class="technical-details"><h3>More Technical Details:</h3> <?php echo( $technical_details ); ?></div>
						<?php endif; ?>

						<?php if( $other_credit ): ?>
							<div class="due-credit"><h3>Due Credit:</h3> <?php echo( $other_credit ); ?></div>
						<?php endif; ?>

					</section>

				</article>
			</main>

			<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf view-options" role="complementary">

					<div class="widget">
						<?php if( $link_live ): ?>
							<div class="link link-live"><a href="<?php echo( $link_live ); ?>">Live Link</a></div>
						<?php endif; ?>
						<?php if( $link_local ): ?>
							<div class="link link-local"><a href="<?php echo( $link_local ); ?>">Live Link</a></div>
						<?php endif; ?>
					</div>
					<div class="widget widget-gallery">
						<?php if( $images && $image_count > 1 ): ?>
							<div class="gallery">
								<h3>Gallery:</h3>
								<div class="gallery-imgs">
									<?php foreach ( $images as $index => $row ):
										$image_src = wp_get_attachment_url( $row[image] );
										$image_thumb_src = wp_get_attachment_image_src( $row[image], 'bones-thumb-300' );
										$hide_show_class = ( $index > 2 ? ' class="hidden"' : null );
									?>
										<a href="<?php echo( $image_src ); ?>"<?php echo( $hide_show_class ); ?> data-fancybox="group">
											<img src="<?php echo( $image_thumb_src[0] ); ?>" />
										</a>

										<?php if( $image_count > 3 && $index == 2 ): ?>
											<a href="" class="more-images">... and <?php echo( $image_count - 3 ); ?> more.</a>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php /* if( $first_image_thumb_src ): ?>
							<p>View Gallery:</p>
							<img src="<?php echo( $first_image_thumb_src[0] ); ?>" />
						<?php endif; */ ?>
					</div>
			</div>

		<?php endwhile; ?>
		<?php else : ?>

			<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
				<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
					</header>
					<section class="entry-content">
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
					</section>
					<footer class="article-footer">
							<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
					</footer>
				</article>
			</main>

		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
