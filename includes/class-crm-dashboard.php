<?php

class CRM_Dashboard {
    public function __construct() {
        // Any initialization code specific to the dashboard class can go here
    }

    /**
     * Render the CRM Dashboard page.
     */
    public function render_dashboard_page() {
        include plugin_dir_path( __FILE__ ) . '../templates/dashboard.php';
    }

    /**
     * Render the Reports page.
     */
    public function render_reports_page() {
        include plugin_dir_path( __FILE__ ) . '../templates/reports.php';
    }
}

new CRM_Dashboard();
