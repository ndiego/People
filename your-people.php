<?php
/**
 * Plugin Name:         Your People
 * Plugin URI:          https://www.blockvisibilitywp.com/
 * Description:         Easily register and display your people.
 * Version:             0.1.0
 * Requires at least:   6.6
 * Requires PHP:        7.4
 * Author:              Nick Diego
 * Author URI:          https://www.nickdiego.com
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         your-people
 * Domain Path:         /languages
 *
 * @package your-people
 */

namespace YourPeople;

/**
 * Register the 'person' custom post type.
 */
function register_person_post_type() {
	$labels = array(
		'name'                  => _x( 'People', 'Post type general name', 'your-people' ),
		'singular_name'         => _x( 'Person', 'Post type singular name', 'your-people' ),
		'menu_name'             => _x( 'People', 'Admin Menu text', 'your-people' ),
		'name_admin_bar'        => _x( 'Person', 'Add New on Toolbar', 'your-people' ),
		'add_new'               => __( 'Add New Person', 'your-people' ),
		'add_new_item'          => __( 'Add New Person', 'your-people' ),
		'new_item'              => __( 'New Person', 'your-people' ),
		'edit_item'             => __( 'Edit Person', 'your-people' ),
		'view_item'             => __( 'View Person', 'your-people' ),
		'all_items'             => __( 'All People', 'your-people' ),
		'search_items'          => __( 'Search People', 'your-people' ),
		'not_found'             => __( 'No people found.', 'your-people' ),
		'not_found_in_trash'    => __( 'No people found in Trash.', 'your-people' ),
		'featured_image'        => _x( 'Person Profile Image', 'Overrides the "Featured Image" phrase', 'your-people' ),
		'set_featured_image'    => _x( 'Set profile image', 'Overrides the "Set featured image" phrase', 'your-people' ),
		'remove_featured_image' => _x( 'Remove profile image', 'Overrides the "Remove featured image" phrase', 'your-people' ),
		'use_featured_image'    => _x( 'Use as profile image', 'Overrides the "Use as featured image" phrase', 'your-people' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => 'people',
		'hierarchical'       => false,
		'menu_icon'          => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'person', $args );
}
add_action( 'init', __NAMESPACE__ . '\register_person_post_type' );

/**
 * Register the 'role' taxonomy for the 'person' post type.
 */
function register_role_taxonomy() {
	$labels = array(
		'name'              => _x( 'Roles', 'taxonomy general name', 'your-people' ),
		'singular_name'     => _x( 'Role', 'taxonomy singular name', 'your-people' ),
		'search_items'      => __( 'Search Roles', 'your-people' ),
		'all_items'         => __( 'All Roles', 'your-people' ),
		'parent_item'       => __( 'Parent Role', 'your-people' ),
		'parent_item_colon' => __( 'Parent Role:', 'your-people' ),
		'edit_item'         => __( 'Edit Role', 'your-people' ),
		'update_item'       => __( 'Update Role', 'your-people' ),
		'add_new_item'      => __( 'Add New Role', 'your-people' ),
		'new_item_name'     => __( 'New Role Name', 'your-people' ),
		'menu_name'         => __( 'Role', 'your-people' ),
	);

	$args = array(
		'labels'            => $labels,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'role' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'role', array( 'person' ), $args );
}
add_action( 'init', __NAMESPACE__ . '\register_role_taxonomy' );

/**
 * Register custom meta fields for the 'person' post type.
 */
function register_person_meta() {
    
    register_post_meta(
        'person',
        'yp_job_title',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Job Title', 'your-people' ),
            'description'       => __( 'The person\'s job title', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_professional_designation',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Professional Designation', 'your-people' ),
            'description'       => __( 'The professional designation of the person (MD, RN, NP, etc.)', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_institution',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Institution/Employer', 'your-people' ),
            'description'       => __( 'The person\'s institution or employer', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_location',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Location', 'your-people' ),
            'description'       => __( 'The person\'s location', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_email_address',
        array(
            'show_in_rest' => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Email', 'your-people' ),
            'description'       => __( 'The person\'s email address', 'your-people' ),
            'sanitize_callback' => 'sanitize_email'
        )
    );

    register_post_meta(
        'person',
        'yp_website_url',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Website', 'your-people' ),
            'description'       => __( 'The person\'s website', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_facebook_url',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Facebook URL', 'your-people' ),
            'description'       => __( 'The person\'s Facebook URL', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_linkedin_url',
        array(
            'show_in_rest' => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'LinkedIn URL', 'your-people' ),
            'description'       => __( 'The person\'s LinkedIn URL', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_x_url',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'X URL', 'your-people' ),
            'description'       => __( 'The person\'s X URL', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );

    register_post_meta(
        'person',
        'yp_instagram_url',
        array(
            'show_in_rest' => true,
            'single'            => true,
            'type'              => 'string',
            'label'             => __( 'Instagram URL', 'your-people' ),
            'description'       => __( 'The person\'s Instagram URL', 'your-people' ),
            'sanitize_callback' => 'wp_strip_all_tags'
        )
    );
}
add_action( 'init', __NAMESPACE__ . '\register_person_meta' );

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

/**
 * Helper function to get the content of a template file.
 * 
 * @param string $template The name of the template file.
 * @return string The content of the template file.
 */
function get_template_content( $template ) {
	ob_start();
	include __DIR__ . "/templates/{$template}";
	return ob_get_clean();
}

/**
 * Register the plugin templates.
 */
function register_plugin_templates() {
	
    register_block_template( 'your-people//single-person', [
        'title'       => __( 'Single Person', 'your-people' ),
        'description' => __( 'Displays a single person\'s profile page.', 'your-people' ),
        'content'     => get_template_content( 'single-person.php' )
    ] );

    register_block_template( 'your-people//archive-person', [
        'title'       => __( 'Archive Person', 'your-people' ),
        'description' => __( 'Displays a list of people.', 'your-people' ),
        'content'     => get_template_content( 'archive-person.php' )
    ] );

    register_block_template( 'your-people//taxonomy-role', [
        'title'       => __( 'Role Archive', 'your-people' ),
        'description' => __( 'Displays a list of people in a specific role.', 'your-people' ),
        'content'     => get_template_content( 'taxonomy-role.php' )
    ] );
}
add_action( 'init', __NAMESPACE__ . '\register_plugin_templates' );

// Admin
require_once __DIR__ . '/includes/admin.php';