<?php
/**
 * Template Name: Events
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SteveRudolfi
 */
?>

<?php get_header(); ?>

<?php
	$queried_event = $_GET['ev'];
	
	function startYear($year) {
		ob_start();
		?>
		<p><?php echo( $year ); ?></p>
		<table border="1">
			<thead>
				<tr>
					<td>Event</td>
					<td>Type</td>
					<td>Remote</td>
					<td>Affiliation</td>
					<td>Date</td>
					<td>Link</td>
					<td>Blog</td>
				</tr>
			</thead>
			<tbody>
		<?php
		return ob_get_clean();
	}
	function endYear() {
		return ( '</tbody></table>' );
	}
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				$args = array(
					'post_type'			=> 'event',
					'posts_per_page'	=> -1
				);
				$the_query = new WP_Query( $args );
				$post_count_total = $the_query->post_count;
				
				if ( $the_query->have_posts() ) :
					$year_inc = 0;
					$post_counter = 0;
					?>
					
						<?php
						while ( $the_query->have_posts() ) : $the_query->the_post();
							$post_counter++;
							$start = get_post_meta( get_the_id(), 'start', true );
							$end = get_post_meta( get_the_id(), 'end', true );
							$type = get_post_meta( get_the_id(), 'type', true );
							$remote = get_post_meta( get_the_id(), 'remote', true );
							$affiliation = get_post_meta( get_the_id(), 'affiliation', true );
							$link = get_post_meta( get_the_id(), 'link', true );
							$blog_link = get_post_meta( get_the_id(), 'blog_link', true );
							$active_event_markup = '';
							
							$date = date_parse_from_format('Y-m-d', $start);
							$thisYear = $date['year'];
							

							
							if( $year_inc !== $thisYear ){
								if( $year_inc !== 0 ){
									echo( endYear( $thisYear ) );
								}
								echo( startYear( $thisYear ) );
								$year_inc = $thisYear;
							}	
							if( $queried_event && $queried_event == get_the_id() ){
								$active_event_markup = ' class="active"';
							}
							printf( "<tr %s id='%s'>", $active_event_markup, get_the_id() );
								echo( '<td>' . get_the_title() . '</td>' );
								echo( '<td>' . $type . '</td>' );
								echo( '<td>' . $remote . '</td>' );
								echo( '<td>' . $affiliation . '</td>' );
								echo( '<td>' . $start . ' - ' . $end . '</td>' );
								echo( '<td>' . $link . '</td>' );
								echo( '<td>' . $blog_link . '</td>' );
							echo( '</tr>' );
							
							if( $post_count_total == $post_counter ){
								echo( endYear() );
							}
							
						endwhile;
						?>
					<?php
				endif;
				wp_reset_query();
			?>
			<?php while ( have_posts() ) : the_post(); ?>

				
				
				<?php get_template_part( 'template-parts/content', 'places' ); ?>

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
