<?php
/**
 * Admin Dashboard
 *
 * @package uri-admin-login
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * Add a metabox to the dashboard.
 */
function uri_admin_add_dashboard_widgets() {
	wp_add_dashboard_widget(
		'uri_admin_style_guide', // Box slug.
		'URI Style Guide', // Box Title.
		'uri_admin_style_guide_callback' // Display function.
	);
}
add_action( 'wp_dashboard_setup', 'uri_admin_add_dashboard_widgets' );

/**
 * Create the function to output the contents of your Dashboard Widget.
 */
function uri_admin_style_guide_callback() {
	_e( 'Learn about customizations with the <a href="https://www.uri.edu/styleguide/" target="_blank">URI Digital Style Guide</a>.', 'uri' );
}
