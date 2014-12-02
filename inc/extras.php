<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package materialwp
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function materialwp_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'materialwp_page_menu_args' );

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

	return $classes;
}
add_filter( 'body_class', 'materialwp_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function materialwp_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'materialwp' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'materialwp_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function materialwp_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'materialwp_setup_author' );

/**
 * Adds a class to the previous post link on single post page
 */
function post_link_attributes_prev($output) {
    $code = 'class="btn btn-warning btn-fab btn-raised mdi-image-navigate-before"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
add_filter('previous_post_link', 'post_link_attributes_prev');

/**
 * Adds a class to the next post link on single post page
 */
function post_link_attributes_next($output) {
    $code = 'class="btn btn-warning btn-fab btn-raised mdi-image-navigate-next"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}
add_filter('next_post_link', 'post_link_attributes_next');

/**
 * Adds a class to the prev post link on blog
 */
function posts_link_attributes_prev() {
    return 'class="btn btn-warning btn-fab btn-raised mdi-image-navigate-before"';
}
add_filter('previous_posts_link_attributes', 'posts_link_attributes_prev');

/**
 * Adds a class to the next post link on blog
 */
function posts_link_attributes_next() {
    return 'class="btn btn-warning btn-fab btn-raised mdi-image-navigate-next"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes_next');

/**
 * Custom Read More Button
 */
function modify_read_more_link() {

	return '<p><a class="read-more" href="' . get_permalink() . '">'.__( 'Read More', 'materialwp' ).'</a></p>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**
 * Custom Edit Button
 */
function custom_edit_post_link($output) {

 $output = str_replace('class="post-edit-link"', 'class="btn btn-danger btn-xs post-edit-link"', $output);
 return $output;
}
add_filter('edit_post_link', 'custom_edit_post_link');