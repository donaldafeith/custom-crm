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

    public function enqueue_scripts($hook) {
        // Check if we are on the reports page
        if ($hook !== 'crm_page_crm-reports') {
            return;
        }

        // Enqueue Chart.js library
        wp_enqueue_script( 'chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true );
        wp_enqueue_script( 'crm-reports', CUSTOM_CRM_URL . 'assets/js/reports-scripts.js', array( 'chart-js', 'jquery' ), null, true );

        // Enqueue custom styles for the reports page
        wp_enqueue_style( 'crm-reports-styles', CUSTOM_CRM_URL . 'assets/css/reports-styles.css' );

        // Localize script with data for the charts
        wp_localize_script( 'crm-reports', 'crmReportsData', $this->get_chart_data() );
    }

    public function render_reports_page() {
        ?>
        <div class="wrap crm-reports">
            <h1><?php _e( 'CRM Reports', 'custom-crm' ); ?></h1>
            <p><?php _e( 'Unlock powerful insights and gain a comprehensive understanding of your CRM data. Analyze detailed metrics, track performance trends, and make informed decisions to drive your business forward. Discover the effectiveness of your sales strategies, identify growth opportunities, and optimize your customer relationships with our in-depth reporting tools.', 'custom-crm' ); ?></p>

            <div class="report-section">
                <div class="report-explanation">
                    <h2><?php _e( 'Deals Status Overview', 'custom-crm' ); ?></h2>
                    <p><?php _e( 'This chart shows the distribution of deals based on their status: Won, Lost, or Pending. Use this information to understand your sales performance.', 'custom-crm' ); ?></p>
                    <p><?php _e( 'Tracking deal statuses helps you identify trends and areas for improvement in your sales process. For example, a high number of lost deals may indicate a need to refine your sales pitch or address common objections. Conversely, a high number of won deals shows what strategies are working well and can be replicated. Regularly monitoring deal statuses allows you to take proactive steps to improve your overall sales efficiency.', 'custom-crm' ); ?></p>
                    <p><?php _e( 'Best Practices for Tracking Deals:', 'custom-crm' ); ?></p>
                    <ul>
                        <li><?php _e( 'Regularly update deal statuses to ensure your data is current and accurate.', 'custom-crm' ); ?></li>
                        <li><?php _e( 'Analyze won and lost deals to identify patterns and areas for improvement.', 'custom-crm' ); ?></li>
                        <li><?php _e( 'Set clear criteria for each deal stage to maintain consistency in your sales process.', 'custom-crm' ); ?></li>
                        <li><?php _e( 'Use the data to provide feedback to your sales team and adjust strategies as needed.', 'custom-crm' ); ?></li>
                    </ul>
                </div>
                <div class="report-chart">
                    <canvas id="dealsStatusChart" class="clickable-chart"></canvas>
                </div>
            </div>

            <div class="report-section">
                <div class="report-explanation">
                    <h2><?php _e( 'Contacts Over Time', 'custom-crm' ); ?></h2>
                    <p><?php _e( 'This chart displays the number of contacts added over time. It helps you track the growth of your contact database.', 'custom-crm' ); ?></p>
                    <p><?php _e( 'Keeping track of the number of contacts over time is crucial for understanding the effectiveness of your marketing and outreach efforts. A steady increase in contacts indicates successful marketing campaigns and can lead to more sales opportunities. On the other hand, a stagnation or decline in new contacts may signal a need to revamp your lead generation strategies.', 'custom-crm' ); ?></p>
                    <p><?php _e( 'Best Practices for Tracking Contacts:', 'custom-crm' ); ?></p>
                    <ul>
                        <li><?php _e( 'Regularly review your contact acquisition sources to identify the most effective channels.', 'custom-crm' ); ?></li>
                        <li><?php _e( 'Segment your contacts to tailor your communication and marketing strategies.', 'custom-crm' ); ?></li>
                        <li><?php _e( 'Ensure contact information is accurate and up-to-date to maintain a healthy database.', 'custom-crm' ); ?></li>
                        <li><?php _e( 'Use the data to forecast future growth and set realistic marketing goals.', 'custom-crm' ); ?></li>
                    </ul>
                </div>
                <div class="report-chart">
                    <canvas id="contactsOverTimeChart" class="clickable-chart"></canvas>
                </div>
            </div>
        </div>
        <?php
    }

    private function get_chart_data() {
        global $wpdb;

        // Fetch data for deals status
        $deals_status = array(
            'won' => count( $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_type = 'deal' AND post_status = 'publish' AND (SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id = ID AND meta_key = '_crm_deal_status') = 'won'" ) ),
            'lost' => count( $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_type = 'deal' AND post_status = 'publish' AND (SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id = ID AND meta_key = '_crm_deal_status') = 'lost'" ) ),
            'pending' => count( $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_type = 'deal' AND post_status = 'publish' AND (SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id = ID AND meta_key = '_crm_deal_status') = 'pending'" ) ),
        );

        // Fetch data for contacts over time
        $contacts_over_time = $wpdb->get_results( "SELECT DATE_FORMAT(post_date, '%Y-%m') as month, COUNT(ID) as count FROM {$wpdb->prefix}posts WHERE post_type = 'contact' AND post_status = 'publish' GROUP BY month ORDER BY post_date ASC" );

        $months = array();
        $contacts_data = array();

        foreach ( $contacts_over_time as $data ) {
            $months[] = $data->month;
            $contacts_data[] = $data->count;
        }

        return array(
            'dealsStatus' => array(
                'labels' => array( 'Won', 'Lost', 'Pending' ),
                'data' => array_values( $deals_status )
            ),
            'contactsOverTime' => array(
                'labels' => $months,
                'data' => $contacts_data
            )
        );
    }
}

new CRM_Reports();
