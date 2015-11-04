<?php
/**
 * Custom functions that are not template related
 *
 * @package Glades
 */


// Add Default Menu Fallback Function
function glades_default_menu() {
	echo '<ul id="mainnav-menu" class="menu">'. wp_list_pages('title_li=&echo=0') .'</ul>';
}


// Get Featured Posts
function glades_get_featured_content() {
	return apply_filters( 'glades_get_featured_content', false );
}


// Check if featured posts exists
function glades_has_featured_content() {
	return ! is_paged() && (bool) glades_get_featured_content();
}


// Change Excerpt Length
add_filter('excerpt_length', 'glades_excerpt_length');
function glades_excerpt_length($length) {
    return 60;
}

// Category Posts Large Excerpt Length
function glades_category_posts_large_excerpt($length) {
    return 32;
}

// Category Posts Medium Excerpt Length
function glades_category_posts_medium_excerpt($length) {
    return 20;
}

// Category Posts Small Excerpt Length
function glades_category_posts_small_excerpt($length) {
    return 8;
}