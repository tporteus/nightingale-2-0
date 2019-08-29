<?php
/**
 * Performance tweaks to improve load times and overall performance of site.
 *
 * @package Nightingale_2.0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Defer JS to footer
 *
 * @param string $url javascript file being loaded.
 *
 * @return string $url Javascript file with defer tag added.
 */
function defer_parsing_js( $url ) {
	// Add the files to exclude from defer. Add jquery.js by default.
	$exclude_files = array( 'jquery.min.js' );
	// Bypass JS defer for logged in users.
	if ( ! is_user_logged_in() ) {
		if ( false === strpos( $url, '.js' ) ) {
			return $url;
		}

		foreach ( $exclude_files as $file ) {
			if ( strpos( $url, $file ) ) {
				return $url;
			}
		}
	} else {
		return $url;
	}

	return "$url' defer='defer";

}

add_filter( 'clean_url', 'defer_parsing_js', 11, 1 );

/**
 * Defer CSS Loading to after load.
 *
 * @param string $html raw content coming in to the function.
 * @param string $handle which string are we looking for.
 * @param url    $href the resource being amended.
 * @param string $media view type.
 *
 * @return string
 */
function add_rel_preload( $html, $handle, $href, $media ) {

	if ( is_admin() ) {
		return $html;
	}

	$html = <<<EOT
<link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />
EOT;

	return $html;
}

add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

/*
 * Clean up the WordPress head.
 */

// remove header links.
add_action( 'init', 'nightingale_2_0_head_cleanup' );

/**
 * Remove a chunk of stuff from the header to optimise loading.
 */
function nightingale_2_0_head_cleanup() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );                      // Category Feeds.
	remove_action( 'wp_head', 'feed_links', 2 );                            // Post and Comment Feeds.
	remove_action( 'wp_head', 'rsd_link' );                                 // EditURI link.
	remove_action( 'wp_head', 'wlwmanifest_link' );                         // Windows Live Writer.
	remove_action( 'wp_head', 'index_rel_link' );                           // index link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );              // previous link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );               // start link.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );   // Links for Adjacent Posts.
	remove_action( 'wp_head', 'wp_generator' );                             // WP version.
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );                                     // De-Register jQuery.
		//wp_register_script( 'jquery', '', '', '', true );                     // Register as 'empty', because we manually insert our script in functions.php.
	}
}
