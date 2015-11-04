<?php
/**
 * Featured Post Slider
 *
 */

// Get our Featured Content posts
$featured_posts = glades_get_featured_content();

// Set loop count
$loop_count = 1;

?>
		
	<div id="featured-content" class="clearfix">

		<?php // Display Featured Content
		foreach ( $featured_posts as $post ) : setup_postdata( $post ); 
		
			// Display first featured post (big)
			if( isset($loop_count) and $loop_count == 1 ) : ?>
			
			<div class="featured-content-left">
	
				<div class="featured-post-wrap clearfix">
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark">
							<?php the_post_thumbnail('glades-featured-content-left'); ?>
						</a>
						
						<div class="post-content">

							<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							
							<div class="postmeta clearfix"><?php glades_display_postmeta(); ?></div>
					
						</div>

					</article>
					
				</div>
				
			</div>
			
			<div class="featured-content-right clearfix">
			
		<?php // Display second featured post on the right side
			else: ?>
			
				<div class="featured-post-wrap clearfix">
				
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark">
							<?php the_post_thumbnail('glades-featured-content-right'); ?>
						</a>
						
						<div class="post-content">

							<h2 class="post-title"><a href="<?php esc_url(the_permalink()) ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					
						</div>

					</article>
				
			</div>
				
		<?php	
			endif;
			
			// Increase Loop count
			$loop_count++;
			
		endforeach;
		?>
			</div><!-- end .featured-content-right -->
	
	</div><!-- end #featured-content -->

<?php

// Reset Postdata
wp_reset_postdata();

?>