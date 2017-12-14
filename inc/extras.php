<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MaterialWP
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function materialwp_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'materialwp_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function materialwp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'materialwp_pingback_header' );


/**
 * Add Bootstrap button classes to tag cloud
 */
function materialwp_tag_cloud_btn( $return ) {
	$return = str_replace('<a', '<a class="btn btn-raised btn-secondary"', $return );
	return $return;
}
add_filter( 'wp_tag_cloud', 'materialwp_tag_cloud_btn' );


/**
 * Customize the Read More Button
**/
function materialwp_modify_read_more_link() {
    return '<a class="more-link btn btn-raised btn-secondary" href="' . get_permalink() . '">Read More</a>';
}
add_filter( 'the_content_more_link', 'materialwp_modify_read_more_link' );
