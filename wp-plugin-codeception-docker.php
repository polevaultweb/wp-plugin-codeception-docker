<?php
/*
Plugin Name: WP Plugin Codeception Docker
Plugin URI: https://polevaultweb.com
Description: Example plugin with Codeception tests running with Docker
Version: 1.0
Author: Iain Poulson
Author URI: https://polevaultweb.com
*/


function pvw_register_options_page() {
	add_options_page( 'Codeception with Docker', 'Codeception with Docker', 'manage_options', 'wpcd', 'wpcd_options_page' );
}

add_action( 'admin_menu', 'pvw_register_options_page' );

function wpcd_options_page() {
	echo 'This is an example plugin, with acceptance tests written with Codeception, running in Docker';
}