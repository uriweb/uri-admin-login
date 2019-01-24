<?php
/**
 * Plugin Name: URI Admin Login
 * Plugin URI: http://www.uri.edu
 * Description: Customizations for the admin login screen
 * Version: 1.0.0
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
add_filter( 'login_headertitle', 'uri_admin_login_wp_login_title' );
