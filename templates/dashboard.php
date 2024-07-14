<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add nonce for security
$crm_admin_nonce = wp_create_nonce( 'crm_admin_nonce' );
?>
<script type="text/javascript">
    var crm_admin_nonce = '<?php echo $crm_admin_nonce; ?>';
</script>

<div class="wrap">
    <h1><?php _e( 'CRM Dashboard', 'custom-crm' ); ?></h1>
    <p><?php _e( 'Welcome to the Custom CRM system. This system is designed to help you manage your customer interactions and data efficiently.', 'custom-crm' ); ?></p>
    
    <h2><?php _e( 'What is Custom CRM?', 'custom-crm' ); ?></h2>
    <p><?php _e( 'Custom CRM is a comprehensive system for managing customer interactions, sales processes, and data. It helps businesses streamline their sales pipeline, improve customer relationships, and track performance metrics.', 'custom-crm' ); ?></p>
    
    <h2><?php _e( 'Key Features', 'custom-crm' ); ?></h2>
    <ul>
        <li><?php _e( 'Custom post types for managing contacts, companies, and deals.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Detailed fields for storing comprehensive information about each entity.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Automated email notifications for key events.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Reporting and analytics tools for tracking customer interactions and sales performance.', 'custom-crm' ); ?></li>
    </ul>
    
    <h2><?php _e( 'How to Use the CRM', 'custom-crm' ); ?></h2>
    <p><?php _e( 'Use the buttons below to manage your CRM data and view reports.', 'custom-crm' ); ?></p>
    <div class="crm-buttons">
        <a href="<?php echo admin_url( 'edit.php?post_type=contact' ); ?>" class="button button-primary"><?php _e( 'Manage Contacts', 'custom-crm' ); ?></a>
        <a href="<?php echo admin_url( 'edit.php?post_type=company' ); ?>" class="button button-primary"><?php _e( 'Manage Companies', 'custom-crm' ); ?></a>
        <a href="<?php echo admin_url( 'edit.php?post_type=deal' ); ?>" class="button button-primary"><?php _e( 'Manage Deals', 'custom-crm' ); ?></a>
    </div>
    
    <h2><?php _e( 'CRM Summary', 'custom-crm' ); ?></h2>
    <?php
    // Fetch data for summary
    $total_contacts = wp_count_posts( 'contact' )->publish;
    $total_companies = wp_count_posts( 'company' )->publish;
    $total_deals = wp_count_posts( 'deal' )->publish;
    $won_deals = count( get_posts( array( 'post_type' => 'deal', 'meta_key' => '_crm_deal_status', 'meta_value' => 'won' ) ) );
    $lost_deals = count( get_posts( array( 'post_type' => 'deal', 'meta_key' => '_crm_deal_status', 'meta_value' => 'lost' ) ) );
    $pending_deals = count( get_posts( array( 'post_type' => 'deal', 'meta_key' => '_crm_deal_status', 'meta_value' => 'pending' ) ) );
    ?>
    <table class="widefat">
        <thead>
            <tr>
                <th><?php _e( 'Metric', 'custom-crm' ); ?></th>
                <th><?php _e( 'Count', 'custom-crm' ); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php _e( 'Total Contacts', 'custom-crm' ); ?></td>
                <td><?php echo $total_contacts; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Total Companies', 'custom-crm' ); ?></td>
                <td><?php echo $total_companies; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Total Deals', 'custom-crm' ); ?></td>
                <td><?php echo $total_deals; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Won Deals', 'custom-crm' ); ?></td>
                <td><?php echo $won_deals; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Lost Deals', 'custom-crm' ); ?></td>
                <td><?php echo $lost_deals; ?></td>
            </tr>
            <tr>
                <td><?php _e( 'Pending Deals', 'custom-crm' ); ?></td>
                <td><?php echo $pending_deals; ?></td>
            </tr>
        </tbody>
    </table>

    <h2><?php _e( 'Getting Started', 'custom-crm' ); ?></h2>
    <p><?php _e( 'To start using the Custom CRM plugin, follow these steps:', 'custom-crm' ); ?></p>
    <ol>
        <li><?php _e( 'Navigate to the "Manage Contacts" section to add and manage your contacts.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Go to the "Manage Companies" section to add and manage companies associated with your contacts.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Visit the "Manage Deals" section to track and manage your sales opportunities.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Check the "Reports" section to view analytics and performance metrics.', 'custom-crm' ); ?></li>
        <li><?php _e( 'Set up automated email notifications for key CRM events to stay updated.', 'custom-crm' ); ?></li>
    </ol>
</div>

<style>
    .crm-buttons .button {
        margin-right: 10px;
        margin-bottom: 10px;
    }
</style>
