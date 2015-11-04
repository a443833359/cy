<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
	
	<?php // Get Theme Options from Database
		$theme_options = glades_theme_options();
				
		// Display Featured Posts on homepage
		if ( is_front_page() && glades_has_featured_content() ) :
			
			// Include the featured content template.
			get_template_part( 'featured-content' );
			
		endif;
	?>
	
		<section id="content" class="primary" role="main">
		 
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'content', $theme_options['posts_length'] );
		
			endwhile;
			
		glades_display_pagination();

		endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	