<?php
/**
 * Functions and definitions
 *
 * @package Yoast\YoastBlockTheme
 */

/**
 * Add theme support for block styles and editor style.
 *
 * @since 0.1.0
 *
 * @return void
 */
function yoast_block_theme_setup() {
	add_theme_support( 'wp-block-styles' );
	add_editor_style( './build/css/tailwind.css' );

	/*
	 * Load additional block styles.
	 */
	$styled_blocks = [ 'buttons', 'button', 'heading' ];
	foreach ( $styled_blocks as $block_name ) {
		$args = array(
			'handle' => "yoast-block-theme-$block_name",
			'src'    => get_theme_file_uri( "build/css/blocks/$block_name.css" ),
			$args['path'] = get_theme_file_path( "build/css/blocks/$block_name.css" ),
		);
		// Replace the "core" prefix when you are styling blocks from plugins.
		wp_enqueue_block_style( "core/$block_name", $args );
	}

}
add_action( 'after_setup_theme', 'yoast_block_theme_setup' );

/**
 * Enqueue scripts & styles.
 */
function yoast_block_theme_enqueue_scripts_and_styles() {
	// Add the default stylesheet.
	wp_enqueue_style(
		'yoast-block-theme-style',
		get_template_directory_uri() . '/style.css',
		[],
		filemtime( get_template_directory() . '/style.css' ) // DEV only.
	);

	// Add tailwind CSS.
	wp_enqueue_style(
		'yoast-block-theme-tailwind',
		get_template_directory_uri() . '/build/css/tailwind.css',
		[],
		filemtime( get_template_directory() . '/build/css/tailwind.css' ) // DEV only.
	);
}
add_action( 'wp_enqueue_scripts', 'yoast_block_theme_enqueue_scripts_and_styles' );

// Block styles
require_once get_theme_file_path( 'inc/register-block-styles.php' );

