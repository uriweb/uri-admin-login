<?php
/**
 * Plugin Name: URI Admin Login
 * Plugin URI: http://www.uri.edu
 * Description: Customizations for the admin login screen
 * Version: 1.1
 * Author: URI Web Communications
 * Author URI: https://today.uri.edu/
 *
 * @author: Brandon Fuller <bjcfuller@uri.edu>
 * @package uri-admin-login
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Include css and js
 */
function uri_admin_login_enqueues() {

	wp_register_style( 'uri-admin-login-css', plugins_url( '/css/style.built.css', __FILE__ ) );
	wp_enqueue_style( 'uri-admin-login-css' );

}
add_action( 'login_enqueue_scripts', 'uri_admin_login_enqueues' );

/**
 * Modify login logo url
 */
function uri_admin_login_wp_login_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'uri_admin_login_wp_login_url' );

/**
 * Modify login logo tooltip
 */
function uri_admin_login_wp_login_title() {
	return get_bloginfo( 'name' );
}
if ( version_compare( $wp_version, '5.2', '>=' ) ) {
	add_filter( 'login_headertext', 'uri_admin_login_wp_login_title' );
} else {
	// login_headertitle is deprecated as of WP 5.2, but web still runs 4.x
	add_filter( 'login_headertitle', 'uri_admin_login_wp_login_title' );
}


/**
 * Modify the forgot password link
 */
function uri_admin_login_lost_password_page( $lostpassword_url, $redirect ) {
	return 'https://password.uri.edu';
}
add_filter( 'lostpassword_url', 'uri_admin_login_lost_password_page', 10, 2 );
