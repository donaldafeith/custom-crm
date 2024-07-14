<?php
// Cleanup code to run on plugin uninstallation.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete custom post types data.
$post_types = array( 'contact', 'company', 'deal' );
foreach ( $post_types as $post_type ) {
    $posts = get_posts( array( 'post_type' => $post_type, 'numberposts' => -1 ) );
    foreach ( $posts as $post ) {
        wp_delete_post( $post->ID, true );
    }
}

// Optionally delete plugin options.
// delete_option( 'custom_crm_options' );