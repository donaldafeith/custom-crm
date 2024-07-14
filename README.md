# Custom CRM Reporting Tool

## Overview

The Custom CRM Reporting Tool is a comprehensive plugin designed for WordPress to provide insightful analytics and detailed metrics on customer relationship management (CRM) data. This tool enables businesses to track and optimize their sales processes, monitor the growth of their contact database, and gain valuable insights into their sales performance through intuitive visual reports.

## Features

### Deals Status Overview
- **Purpose**: To show the distribution of deals based on their status (Won, Lost, or Pending).
- **Description**: This chart provides a clear visual representation of the current state of your deals. By understanding the distribution of deals, you can identify successful strategies and areas that require improvement.
- **Importance**: Tracking deal statuses helps you pinpoint trends and optimize your sales process. For instance, a high number of lost deals may highlight the need to refine your sales pitch or address common customer objections. Conversely, a high number of won deals indicates effective strategies that can be replicated.

### Contacts Over Time
- **Purpose**: To display the number of contacts added over a period.
- **Description**: This chart helps you monitor the growth of your contact database over time. It shows how many new contacts are being added on a monthly basis, providing a clear picture of your marketing and outreach efforts.
- **Importance**: Keeping track of contacts over time is essential for understanding the effectiveness of your marketing campaigns. A consistent increase in contacts suggests successful outreach efforts, while a decline may indicate the need for a strategic review.

## Best Practices for Using the CRM Reporting Tool

### Tracking Deals
- **Regular Updates**: Ensure deal statuses are updated regularly to maintain accurate data.
- **Analyze Patterns**: Review won and lost deals to identify patterns and areas for improvement.
- **Set Clear Criteria**: Establish clear criteria for each deal stage to ensure consistency in your sales process.
- **Provide Feedback**: Use the data to provide constructive feedback to your sales team and adjust strategies as needed.

### Tracking Contacts
- **Review Acquisition Sources**: Regularly assess your contact acquisition channels to identify the most effective ones.
- **Segment Contacts**: Segment your contacts to personalize communication and marketing strategies.
- **Maintain Data Accuracy**: Ensure contact information is accurate and up-to-date to keep your database healthy.
- **Forecast Growth**: Use the data to forecast future growth and set realistic marketing goals.

## Usage Instructions

1. **Navigate to CRM Dashboard**: Access the CRM Dashboard from the WordPress admin menu.
2. **View Reports**: Click on the 'Reports' submenu to view detailed charts and analytics.
3. **Interact with Charts**: Click on the charts to view them in a larger modal for more detailed analysis.
4. **Close Modal**: Click the close button to exit the modal view.

## Benefits

- **Enhanced Decision Making**: Gain valuable insights into your CRM data, enabling you to make informed decisions to drive your business forward.
- **Improved Sales Performance**: Identify successful strategies and areas for improvement to optimize your sales process.
- **Effective Marketing**: Track the growth of your contact database to measure the effectiveness of your marketing campaigns.

## Conclusion

The Custom CRM Reporting Tool is an essential plugin for businesses looking to enhance their CRM capabilities. By providing detailed and insightful reports, this tool helps you streamline your sales process, improve customer relationships, and drive business growth.

## Installation

1. **Download the Plugin Files:**
   - Ensure you have the plugin files available on your local machine. The main folder should be named `custom-crm`.

2. **Upload the Plugin to WordPress:**
   - Log in to your WordPress admin dashboard.
   - Navigate to `Plugins` > `Add New`.
   - Click the `Upload Plugin` button at the top.
   - Click `Choose File`, select the `custom-crm` folder, and click `Install Now`.

3. **Activate the Plugin:**
   - After the plugin is installed, click `Activate Plugin`.

## Usage

### Accessing the CRM Dashboard
- Once the plugin is activated, a new menu item called `CRM` will appear in the WordPress admin sidebar.
- Click on `CRM` to access the CRM Dashboard.

### Managing CRM Data

#### Adding and Managing Contacts
- Navigate to `CRM` > `Manage Contacts`.
- Click `Add New` to create a new contact.
- Fill in the contact details, including the contact name, email, and phone number.
- Click `Publish` to save the contact.

#### Adding and Managing Companies
- Navigate to `CRM` > `Manage Companies`.
- Click `Add New` to create a new company.
- Fill in the company details, including the company name, address, and website.
- Click `Publish` to save the company.

#### Adding and Managing Deals
- Navigate to `CRM` > `Manage Deals`.
- Click `Add New` to create a new deal.
- Fill in the deal details, including the deal value and status (Pending, Won, Lost).
- Click `Publish` to save the deal.

### Viewing Reports
- Navigate to `CRM` > `Reports` to access the reports page.
- The reports page provides detailed analytics and visualizations of your CRM data.
- You can view charts for deals status overview and contacts over time.

### TODO (Worked on but not finished)
- **Email Notifications**: The plugin automatically sends email notifications for new contacts, companies, and deals. Ensure your WordPress site is configured to send emails.
- **Customizing Email Templates**: Customize email templates by editing the `CRM_Email` class in `includes/class-crm-email.php`.
- **Importing and Exporting Data**: Extend the plugin with custom scripts to import and export CRM data.
- **Role-Based Access Control**: Implement granular permissions for different user roles by customizing the plugin as needed.

## Uninstallation

1. **Deactivating the Plugin:**
   - Navigate to `Plugins` in the WordPress admin dashboard.
   - Locate `Custom CRM` and click `Deactivate`.

2. **Uninstalling the Plugin:**
   - After deactivating the plugin, click `Delete` to remove the plugin and its data.

3. **Cleanup on Uninstall:**
   - The plugin includes an `uninstall.php` script that cleans up custom post types and options.

## Troubleshooting

### Enable Debugging
- If you encounter issues, enable debugging in WordPress by adding the following lines to your `wp-config.php` file:
  ```php
  define('WP_DEBUG', true);
  define('WP_DEBUG_LOG', true);
  define('WP_DEBUG_DISPLAY', false);
