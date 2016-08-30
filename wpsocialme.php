<?php
/*
Plugin Name: WPSocialMe
Plugin URI: https://github.com/CrediLab/PrivateMessageWordpress
Description: Adds social network login
Version: 1.0
Author: CrediLab
Author URI: https://github.com/CrediLab
License: 
*/

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

define( 'WP_SM_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_SM_TEMPLATES_DIR', trailingslashit( WP_SM_DIR . 'templates' ) );
define( 'WP_SM_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_SM_CSS_URL', trailingslashit( WP_SM_URL . 'css' ) );
define( 'WP_SM_JS_URL', trailingslashit( WP_SM_URL . 'js' ) );


class WPsocialMe {
	
	public function __construct() {
		register_activation_hook( __FILE__, array($this, 'activate_plugin'));
		add_action( 'plugins_loaded', array($this, 'load_text_domain'));
		
		register_uninstall_hook(__FILE__, array('wp_sm', 'uninstall_plugin'));
		
		if(is_admin())
		{
			add_action( 'admin_init', array($this, 'add_admin_init') );
			add_action( 'admin_menu', array($this, 'add_menu') );
		}
	}
	
	public function activate_plugin() {
		global $wpdb;

        // Create user details table
        $query = 'CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix . 'sm (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `user_id` bigint(20) NOT NULL,
            `provider_name` varchar(50) NOT NULL,
            `identifier` varchar(255) NOT NULL,
            `unique_verifier` varchar(255) NOT NULL,
            `email` varchar(100) NOT NULL,
            `first_name` varchar(150) NOT NULL,
            `last_name` varchar(150) NOT NULL,
            `profile_url` varchar(255) NOT NULL,
            `website_url` varchar(255) NOT NULL,
            `photo_url` varchar(255) NOT NULL,
            `display_name` varchar(50) NOT NULL,
            `description` varchar(255) NOT NULL,
            PRIMARY KEY `id` (`id`),
            KEY `user_id` (`user_id`),
            KEY `provider_name` (`provider_name`)
            )COLLATE utf8_general_ci;';
			
        $wpdb->query( $query );
	}
	
	// Load translations
	public function load_text_domain() {
		load_plugin_textdomain( 'wp_sm', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	}
	
	// Add plugin menu
	public function add_menu() {
		add_menu_page( __( 'WPsocialMe Options', 'wp_sm' ), __( 'WPsocialMe', 'wp_sm' ), 'read', 'wpsocialme', array( $this, 'plugin_options'), 'dashicons-share');
		add_action( 'admin_enqueue_scripts', array($this,'admin_print_styles_options') );
	}
	
	// Options page
	public function plugin_options() {
		include_once WP_SM_TEMPLATES_DIR . 'options.php';	
	}
	
	// Enqueue scripts and styles for options page
	public function admin_print_styles_options() {
		wp_enqueue_style( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );
		wp_enqueue_style( 'wp_sm_css', WP_SM_CSS_URL . 'style.css' );
		wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-tabs');
		do_action( 'wp_sm_print_styles', 'plugin_options' );
	}

	
	// Register plugin option
	public function add_admin_init() {
		register_setting( 'option_group', 'wp_sm_option' );
	}
	
	
	// Uninstall plugin option
	public static function uninstall_plugin() {
		global $wpdb;

		// Drop PM table and plugin option when uninstall
		$wpdb->query( "DROP table {$wpdb->prefix}sm" );
	}
	
	
	public static function init() {
		return new self;
	}
}
	WPsocialMe::init();

?>