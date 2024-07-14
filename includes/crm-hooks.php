<?php
// Hooks and actions for the CRM plugin.

add_action( 'init', 'custom_crm_create_post_types' );
add_action( 'admin_menu', 'custom_crm_admin_menu' );

// Ajax action for fetching data
add_action( 'wp_ajax_crm_fetch_data', 'custom_crm_fetch_data' );

function custom_crm_admin_menu() {
    add_menu_page(
        __( 'CRM Dashboard', 'custom-crm' ),
        __( 'CRM', 'custom-crm' ),
        'manage_options',
        'crm-dashboard',
        'custom_crm_dashboard_page',
        'dashicons-businessperson',
        2
    );

    add_submenu_page(
        'crm-dashboard',
        __( 'Reports', 'custom-crm' ),
        'manage_options',
        'crm-reports',
        'custom_crm_reports_page'
    );
}

function custom_crm_dashboard_page() {
    include CUSTOM_CRM_PATH . 'templates/dashboard.php';
}

function custom_crm_reports_page() {
    include CUSTOM_CRM_PATH . 'templates/reports.php';
}

function custom_crm_fetch_data() {
    // Check the nonce for security
    check_ajax_referer( 'crm_admin_nonce', 'security' );

    // Fetch data (this is an example, you can customize this to fetch real data)
    $data = array(
        'message' => __( 'Data fetched successfully!', 'custom-crm' ),
    );

    // Send the response
    wp_send_json_success( $data );
}
?>
