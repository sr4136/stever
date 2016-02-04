<?php
/**
 * The template for displaying the homepage.
 *
 * @package SteveRudolfi
 */
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/content', 'front' ); ?>
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
