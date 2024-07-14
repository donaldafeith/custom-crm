<?php

class CRM_Reports {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_reports_page' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function add_reports_page() {
        add_submenu_page(
            'crm-dashboard',
            __( 'Reports', 'custom-crm' ),
            __( 'Reports', 'custom-crm' ),
            'manage_options',
            'crm-reports',
            array( $this, 'render_reports_page' )
        );
    }

    public function enqueue_scripts() {
        // Enqueue Chart.js library
        wp_enqueue_script( 'chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true );
        wp_enqueue_script( 'crm-reports', CUSTOM_CRM_URL . 'assets/js/reports-scripts.js', array( 'chart-js', 'jquery' ), null, true );

        // Localize script with data for the charts
        wp_localize_script( 'crm-reports', 'crmReportsData', $this->get_chart_data() );
    }

    public function render_reports_page() {
        ?>
        <div class="wrap">
            <h1><?php _e( 'CRM Reports', 'custom-crm' ); ?></h1>
            <p><?php _e( 'View detailed reports and analytics for your CRM data.', 'custom-crm' ); ?></p>

            <h2><?php _e( 'Deals Status Overview', 'custom-crm' ); ?></h2>
            <canvas id="dealsStatusChart" width="400" height="200"></canvas>

            <h2><?php _e( 'Contacts Over Time', 'custom-crm' ); ?></h2>
            <canvas id="contactsOverTimeChart" width="400" height="200"></canvas>
        </div>
        <?php
    }

    private function get_chart_data() {
        $total_contacts = wp_count_posts( 'contact' )->publish;
        $total_companies = wp_count_posts( 'company' )->publish;
        $total_deals = wp_count_posts( 'deal' )->publish;
        $won_deals = count( get_posts( array( 'post_type' => 'deal', 'meta_key' => '_crm_deal_status', 'meta_value' => 'won' ) ) );
        $lost_deals = count( get_posts( array( 'post_type' => 'deal', 'meta_key' => '_crm_deal_status', 'meta_value' => 'lost' ) ) );
        $pending_deals = count( get_posts( array( 'post_type' => 'deal', 'meta_key' => '_crm_deal_status', 'meta_value' => 'pending' ) ) );

        // Example data for contacts over time (this should ideally be fetched and processed from actual data)
        $contacts_over_time = array(
            'labels' => array( 'January', 'February', 'March', 'April', 'May', 'June' ),
            'data' => array( 10, 20, 30, 40, 50, 60 )
        );

        return array(
            'dealsStatus' => array(
                'labels' => array( 'Won', 'Lost', 'Pending' ),
                'data' => array( $won_deals, $lost_deals, $pending_deals )
            ),
            'contactsOverTime' => $contacts_over_time
        );
    }
}

new CRM_Reports();
