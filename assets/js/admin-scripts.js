// Custom admin scripts

jQuery(document).ready(function ($) {
    // Example: Show an alert when a button with the class 'crm-alert-button' is clicked
    $('.crm-alert-button').on('click', function () {
        alert('Button clicked!');
    });

    // Example: Toggle visibility of an element with the ID 'crm-toggle-section' when a button with the class 'crm-toggle-button' is clicked
    $('.crm-toggle-button').on('click', function () {
        $('#crm-toggle-section').toggle();
    });

    // Example: Ajax call to fetch data from the server (this would require additional server-side code)
    $('.crm-fetch-data-button').on('click', function () {
        $.ajax({
            url: ajaxurl, // WordPress provides the 'ajaxurl' variable for admin-ajax.php
            type: 'POST',
            data: {
                action: 'crm_fetch_data', // The action name to handle in PHP
                security: crm_admin_nonce // A nonce for security (this would need to be added in PHP)
            },
            success: function (response) {
                // Handle the response
                console.log(response);
                $('#crm-data-container').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    });
});
