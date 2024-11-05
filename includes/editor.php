<?php

/**
 * Enqueue the Editor scripts and styles.
 */
function enqueue_editor_scripts_styles() {
	global $pagenow, $typenow;

	// Check if we are on the Post Editor and the post type is "post".
	if (
		'post.php' === $pagenow &&
		'person' === $typenow
	) {
		$assets = include plugin_dir_path( __FILE__ ) . 'build/editor/index.asset.php';
		wp_enqueue_script(
			'person_meta_editor_scripts',
			plugin_dir_url( __FILE__ ) . 'build/editor/index.js',
			$assets['dependencies'],
			$assets['version'],
			true
		);

		wp_enqueue_style(
			'person_meta_editor_styles',
			plugin_dir_url( __FILE__ ) . 'build/editor/index.css',
			array(),
			$assets['version']
		);
	}
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_editor_scripts_styles' );