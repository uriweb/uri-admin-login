<?php

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * Override the default "Thank you for using WordPress admin footer".
 */
function uri_admin_footer() {
	echo '<p class="footer-about-wp"><a href="https://www.uri.edu/wordpress/" target="_blank">Learn more about WordPress at URI</a>.</p>';
}
add_filter( 'admin_footer_text', 'uri_admin_footer' );



/**
 * Remove unwanted WP Admin Dashboard boxes
 */
function uri_admin_remove_boxes() {
	// @see https://www.wpexplorer.com/customize-wordpress-admin-dashboard/

	// limit our handed-down customizations to users who can't manage options
	if ( ! current_user_can( 'manage_options' ) ) {
		// these are the default WP meta boxes
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	}

}
add_action( 'admin_init', 'uri_admin_remove_boxes' ); 


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
	_e('Learn about customizations with the <a href="https://www.uri.edu/styleguide/" target="_blank">URI Digital Style Guide</a>.', 'uri');
}