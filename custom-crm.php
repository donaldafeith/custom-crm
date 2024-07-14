<?php
/**
 * Plugin Name: Custom CRM
 * Description: A custom CRM system for managing customer interactions and data.
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: custom-crm
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants.
define( 'CUSTOM_CRM_PATH', plugin_dir_path( __FILE__ ) );
define( 'CUSTOM_CRM_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files.
require_once CUSTOM_CRM_PATH . 'includes/crm-functions.php';
require_once CUSTOM_CRM_PATH . 'includes/crm-hooks.php';
require_once CUSTOM_CRM_PATH . 'includes/class-crm-contacts.php';
require_once CUSTOM_CRM_PATH . 'includes/class-crm-companies.php';
require_once CUSTOM_CRM_PATH . 'includes/class-crm-deals.php';
require_once CUSTOM_CRM_PATH . 'includes/class-crm-email.php';
require_once CUSTOM_CRM_PATH . 'includes/class-crm-dashboard.php';
require_once CUSTOM_CRM_PATH . 'includes/class-crm-reports.php';

// Activation and deactivation hooks.
register_activation_hook( __FILE__, 'custom_crm_activate' );
register_deactivation_hook( __FILE__, 'custom_crm_deactivate' );

// Initialize the plugin.
function custom_crm_init() {
    load_plugin_textdomain( 'custom-crm', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'custom_crm_init' );

// Enqueue admin scripts and styles.
function custom_crm_admin_scripts() {
    wp_enqueue_style( 'custom-crm-admin-styles', CUSTOM_CRM_URL . 'assets/css/admin-styles.css' );
    wp_enqueue_script( 'custom-crm-admin-scripts', CUSTOM_CRM_URL . 'assets/js/admin-scripts.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'custom_crm_admin_scripts' );
