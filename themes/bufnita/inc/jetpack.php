<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package bufnita
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function bufnita_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'bufnita_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function bufnita_jetpack_setup
add_action( 'after_setup_theme', 'bufnita_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function bufnita_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function bufnita_infinite_scroll_render
