<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 */
	

// Display Site Title
add_action( 'glades_site_title', 'glades_display_site_title' );

function glades_display_site_title() { ?>

	<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo('name'); ?></h1>
	</a>

<?php
}


// Display Custom Header
if ( ! function_exists( 'glades_display_custom_header' ) ):
	
	function glades_display_custom_header() {
		
		// Don't display header image on template-magazine.php
		if( is_page_template('template-magazine.php') )
			return;
			
		// Check if page is displayed and featured header image is used
		if( is_page() && has_post_thumbnail() ) :
		?>
			<div id="custom-header-wrap">
				<div id="custom-header" class="featured-image-header">
					<?php the_post_thumbnail('glades-header-image'); ?>
				</div>
			</div>
<?php
		// Check if there is a custom header image
		elseif( get_header_image() ) :
		?>
			<div id="custom-header-wrap">
				<div id="custom-header">
					<img src="<?php echo get_header_image(); ?>" />
				</div>
			</div>
<?php 
		endif;

	}
	
endif;


// Display Postmeta Data
if ( ! function_exists( 'glades_display_postmeta' ) ):
	
	function glades_display_postmeta() { 
	
		// Get Theme Options from Database
		$theme_options = glades_theme_options();
		
		// Display Date unless user has deactivated it via settings
		if ( true == $theme_options['meta_date'] ) :
		
			glades_meta_date();
					
		endif; 
		
		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_author'] ) :	
		
			glades_meta_author();
		
		endif; 
		
		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_category'] ) :
		
			glades_meta_categories();
		
		endif;
		
		// Display Comments
		if ( comments_open() ) :
			
			glades_meta_comments();
			
		endif;
	
	}
	
endif;


// Display Post Date
function glades_meta_date() {
	
	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	echo '<span class="meta-date">' . $time_string . '</span>';
}


// Display Post Author
function glades_meta_author() {  
	
	$author_string = sprintf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>', 
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'glades' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
	
	echo '<span class="meta-author author vcard"> ' . $author_string . '</span>';

}


// Display Post Categories
function glades_meta_categories() { ?>		
		
	<span class="meta-category">
		<?php echo get_the_category_list(', '); ?>
	</span>
			
<?php
}


// Display Post Meta Comments
function glades_meta_comments() { ?>		
		
	<span class="meta-comments">
		<?php comments_popup_link( esc_html__( 'Leave a comment', 'glades' ), esc_html__( 'One comment', 'glades' ), esc_html__( '% comments', 'glades' ) ); ?>
	</span>
			
<?php
}


// Display Post Thumbnail on Archive Pages
function glades_display_thumbnail_index() {
	
	// Get Theme Options from Database
	$theme_options = glades_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_thumbnails_index']) and $theme_options['post_thumbnails_index'] == true ) : ?>

		<a href="<?php esc_url(the_permalink()) ?>" rel="bookmark">
			<?php the_post_thumbnail('post-thumbnail'); ?>
		</a>

<?php
	endif;

}


// Display Post Thumbnail on single posts
function glades_display_thumbnail_single() {
	
	// Get Theme Options from Database
	$theme_options = glades_theme_options();
	
	// Display Post Thumbnail if activated
	if ( isset($theme_options['post_thumbnails_single']) and $theme_options['post_thumbnails_single'] == true ) :

		the_post_thumbnail('post-thumbnail');

	endif;

}


// Display Postinfo Data
if ( ! function_exists( 'glades_display_postinfo' ) ):
	
	function glades_display_postinfo() { 
	
		// Get Theme Options from Database
		$theme_options = glades_theme_options();

		// Display Date unless user has deactivated it via settings
		if ( isset($theme_options['meta_tags']) and $theme_options['meta_tags'] == true ) :
			
			$tag_list = get_the_tag_list('', '');
			
			if ( $tag_list ) : ?>
				
				<span class="meta-tags">
					<?php echo $tag_list; ?>
				</span>
		
			<?php endif;
			
		endif;

	}
	
endif;

	
// Display Content Pagination
if ( ! function_exists( 'glades_display_pagination' ) ):
	
	function glades_display_pagination() { 
		
		global $wp_query;

		$big = 999999999; // need an unlikely integer
		
		 $paginate_links = paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',				
				'current' => max( 1, get_query_var( 'paged' ) ),
				'total' => $wp_query->max_num_pages,
				'next_text' => '&raquo;',
				'prev_text' => '&laquo',
				'add_args' => false
			) );

		// Display the pagination if more than one page is found
		if ( $paginate_links ) : ?>
				
			<div class="post-pagination clearfix">
				<?php echo $paginate_links; ?>
			</div>
		
		<?php
		endif;
		
	}
	
endif;


// Display Footer Text
if ( ! function_exists( 'glades_display_footer_text' ) ):

	function glades_display_footer_text() { 

		// Get Theme Options from Database
		$theme_options = glades_theme_options();

		if ( isset( $theme_options['footer_text'] ) and $theme_options['footer_text'] <> '' ) :
			
			echo do_shortcode(wp_kses_post($theme_options['footer_text']));
				
		endif; 
	}
	
endif;


// Display Credit Link
add_action( 'glades_credit_link', 'glades_display_credit_link' );

function glades_display_credit_link() { 
		
	printf( esc_html__( 'Powered by %1$s and %2$s.', 'glades' ), 
		'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
		'<a href="http://themezee.com/themes/glades/" title="Glades WordPress Theme">Glades</a>'
	); 
}


// Display Social Icons
function glades_display_social_icons() {

	// Check if there is a social_icons menu
	if( has_nav_menu( 'social' ) ) :

		// Display Social Icons Menu
		wp_nav_menu( array(
			'theme_location' => 'social',
			'container' => false,
			'menu_id' => 'social-icons-menu',
			'echo' => true,
			'fallback_cb' => '',
			'before' => '',
			'after' => '',
			'link_before' => '<span class="screen-reader-text">',
			'link_after' => '</span>',
			'depth' => 1
			)
		);

	else: // Display Hint how to configure Social Icons ?>

		<p class="social-icons-hint">
			<?php esc_html_e( 'Please go to Appearance &#8594; Menus and create a new custom menu with custom links to all your social networks. Then click on "Manage Locations" tab and assign your created menu to the "Social Icons" location.', 'glades' ); ?>
		</p>
<?php
	endif;

}


// Custom Template for comments and pingbacks.
if ( ! function_exists( 'glades_list_comments' ) ):
function glades_list_comments($comment, $args, $depth) {

	$GLOBALS['comment'] = $comment;

	if( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) : ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php esc_html_e( 'Pingback:', 'glades' ); ?> <?php comment_author_link(); ?>
			<?php edit_comment_link( esc_html__( '(Edit)', 'glades' ), '<span class="edit-link">', '</span>' ); ?>
			</p>

	<?php else : ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 56 ); ?>
					<?php printf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
				</div>

		<?php if ($comment->comment_approved == '0') : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'glades' ); ?></p>
		<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'glades' ), get_comment_date(),  get_comment_time()) ?></a>
					<?php edit_comment_link( esc_html__( '(Edit)', 'glades' ),'  ','') ?>
				</div>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>

			</div>
<?php
	endif;

}
endif;