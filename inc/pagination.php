<?php
/**
 * Replace css classes in standard navigation with Nightingale classes
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 **/

/**
 * Paginate archived pages
 */
function nightingale_archive_pagination() {
	echo '<div class="navigation">';
	the_posts_pagination(
		array(
			'mid_size'  => 2,
			'prev_text' => esc_html__( 'Prev', 'nightingale' ),
			'next_text' => esc_html__( 'Next', 'nightingale' ),
		)
	);
	echo '</div>';
}

/**
 * Add in a previous and next functionality
 */
function nightingale_get_prev_next() {
	echo '<div class="navigation">
	<nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
  <ul class="nhsuk-list nhsuk-pagination__list">';
	echo nightingale_the_post_navigation(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '</ul></nav></div>';
}

/**
 * Add in a method to go backwards and forwards between posts.
 *
 * @param array $args the arguments coming in to the function.
 *
 * @return string the output.
 */
function nightingale_the_post_navigation( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'prev_text'          => '<span class="nhsuk-pagination__title">Previous</span>
									<span class="nhsuk-u-visually-hidden">:</span>
									<span class="nhsuk-pagination__page">%title</span>
									<svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
									  <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
									</svg>',
			'next_text'          => '<span class="nhsuk-pagination__title">Next</span>
									<span class="nhsuk-u-visually-hidden">:</span>
									<span class="nhsuk-pagination__page">%title</span>
									<svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
									  <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
									</svg>',
			'in_same_term'       => false,
			'excluded_terms'     => '',
			'taxonomy'           => 'category',
			'screen_reader_text' => __( 'Post navigation', 'nightingale' ),
		)
	);

	$navigation = '';

	$previous = get_previous_post_link(
		'<li class="nhsuk-pagination-item--previous">%link</li>',
		$args['prev_text'],
		$args['in_same_term'],
		$args['excluded_terms'],
		$args['taxonomy']
	);

	$next = get_next_post_link(
		'<li class="nhsuk-pagination-item--next">%link</li>',
		$args['next_text'],
		$args['in_same_term'],
		$args['excluded_terms'],
		$args['taxonomy']
	);

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = $previous . $next;
	}

	return $navigation;
}
