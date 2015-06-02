<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 *
 * @package SteveRudolfi
 */
?>

	</div><!-- #content -->

	<footer class="site-footer">
		<?php get_template_part( 'template-parts/searchform' ); ?>
		
		<?php get_template_part( 'template-parts/socialicons' ); ?>
		
		<div class="site-info">
			&copy; 2008 – <?php echo date('Y'); ?> SteveRudolfi.com
		</div><!-- .site-info -->
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
