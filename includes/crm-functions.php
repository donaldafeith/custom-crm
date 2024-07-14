<?php
// Utility functions for the CRM plugin.

/**
 * Runs on plugin activation.
 */
function custom_crm_activate() {
    custom_crm_create_post_types();
    flush_rewrite_rules();
}

/**
 * Runs on plugin deactivation.
 */
function custom_crm_deactivate() {
    flush_rewrite_rules();
}

/**
 * Creates custom post types for contacts, companies, and deals.
 */
function custom_crm_create_post_types() {
    // Register Contacts Post Type
    $contacts_labels = array(
        'name'                  => _x( 'Contacts', 'Post Type General Name', 'custom-crm' ),
        'singular_name'         => _x( 'Contact', 'Post Type Singular Name', 'custom-crm' ),
        'menu_name'             => __( 'Contacts', 'custom-crm' ),
        'name_admin_bar'        => __( 'Contact', 'custom-crm' ),
        'archives'              => __( 'Contact Archives', 'custom-crm' ),
        'attributes'            => __( 'Contact Attributes', 'custom-crm' ),
        'parent_item_colon'     => __( 'Parent Contact:', 'custom-crm' ),
        'all_items'             => __( 'All Contacts', 'custom-crm' ),
        'add_new_item'          => __( 'Add New Contact', 'custom-crm' ),
        'add_new'               => __( 'Add New', 'custom-crm' ),
        'new_item'              => __( 'New Contact', 'custom-crm' ),
        'edit_item'             => __( 'Edit Contact', 'custom-crm' ),
        'update_item'           => __( 'Update Contact', 'custom-crm' ),
        'view_item'             => __( 'View Contact', 'custom-crm' ),
        'view_items'            => __( 'View Contacts', 'custom-crm' ),
        'search_items'          => __( 'Search Contact', 'custom-crm' ),
        'not_found'             => __( 'Not found', 'custom-crm' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'custom-crm' ),
        'featured_image'        => __( 'Featured Image', 'custom-crm' ),
        'set_featured_image'    => __( 'Set featured image', 'custom-crm' ),
        'remove_featured_image' => __( 'Remove featured image', 'custom-crm' ),
        'use_featured_image'    => __( 'Use as featured image', 'custom-crm' ),
        'insert_into_item'      => __( 'Insert into contact', 'custom-crm' ),
        'uploaded_to_this_item' => __( 'Uploaded to this contact', 'custom-crm' ),
        'items_list'            => __( 'Contacts list', 'custom-crm' ),
        'items_list_navigation' => __( 'Contacts list navigation', 'custom-crm' ),
        'filter_items_list'     => __( 'Filter contacts list', 'custom-crm' ),
    );
    $contacts_args = array(
        'label'                 => __( 'Contact', 'custom-crm' ),
        'description'           => __( 'Custom post type for contacts', 'custom-crm' ),
        'labels'                => $contacts_labels,
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'contact', $contacts_args );

    // Register Companies Post Type
    $companies_labels = array(
        'name'                  => _x( 'Companies', 'Post Type General Name', 'custom-crm' ),
        'singular_name'         => _x( 'Company', 'Post Type Singular Name', 'custom-crm' ),
        'menu_name'             => __( 'Companies', 'custom-crm' ),
        'name_admin_bar'        => __( 'Company', 'custom-crm' ),
        'archives'              => __( 'Company Archives', 'custom-crm' ),
        'attributes'            => __( 'Company Attributes', 'custom-crm' ),
        'parent_item_colon'     => __( 'Parent Company:', 'custom-crm' ),
        'all_items'             => __( 'All Companies', 'custom-crm' ),
        'add_new_item'          => __( 'Add New Company', 'custom-crm' ),
        'add_new'               => __( 'Add New', 'custom-crm' ),
        'new_item'              => __( 'New Company', 'custom-crm' ),
        'edit_item'             => __( 'Edit Company', 'custom-crm' ),
        'update_item'           => __( 'Update Company', 'custom-crm' ),
        'view_item'             => __( 'View Company', 'custom-crm' ),
        'view_items'            => __( 'View Companies', 'custom-crm' ),
        'search_items'          => __( 'Search Company', 'custom-crm' ),
        'not_found'             => __( 'Not found', 'custom-crm' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'custom-crm' ),
        'featured_image'        => __( 'Featured Image', 'custom-crm' ),
        'set_featured_image'    => __( 'Set featured image', 'custom-crm' ),
        'remove_featured_image' => __( 'Remove featured image', 'custom-crm' ),
        'use_featured_image'    => __( 'Use as featured image', 'custom-crm' ),
        'insert_into_item'      => __( 'Insert into company', 'custom-crm' ),
        'uploaded_to_this_item' => __( 'Uploaded to this company', 'custom-crm' ),
        'items_list'            => __( 'Companies list', 'custom-crm' ),
        'items_list_navigation' => __( 'Companies list navigation', 'custom-crm' ),
        'filter_items_list'     => __( 'Filter companies list', 'custom-crm' ),
    );
    $companies_args = array(
        'label'                 => __( 'Company', 'custom-crm' ),
        'description'           => __( 'Custom post type for companies', 'custom-crm' ),
        'labels'                => $companies_labels,
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'company', $companies_args );

    // Register Deals Post Type
    $deals_labels = array(
        'name'                  => _x( 'Deals', 'Post Type General Name', 'custom-crm' ),
        'singular_name'         => _x( 'Deal', 'Post Type Singular Name', 'custom-crm' ),
        'menu_name'             => __( 'Deals', 'custom-crm' ),
        'name_admin_bar'        => __( 'Deal', 'custom-crm' ),
        'archives'              => __( 'Deal Archives', 'custom-crm' ),
        'attributes'            => __( 'Deal Attributes', 'custom-crm' ),
        'parent_item_colon'     => __( 'Parent Deal:', 'custom-crm' ),
        'all_items'             => __( 'All Deals', 'custom-crm' ),
        'add_new_item'          => __( 'Add New Deal', 'custom-crm' ),
        'add_new'               => __( 'Add New', 'custom-crm' ),
        'new_item'              => __( 'New Deal', 'custom-crm' ),
        'edit_item'             => __( 'Edit Deal', 'custom-crm' ),
        'update_item'           => __( 'Update Deal', 'custom-crm' ),
        'view_item'             => __( 'View Deal', 'custom-crm' ),
        'view_items'            => __( 'View Deals', 'custom-crm' ),
        'search_items'          => __( 'Search Deal', 'custom-crm' ),
        'not_found'             => __( 'Not found', 'custom-crm' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'custom-crm' ),
        'featured_image'        => __( 'Featured Image', 'custom-crm' ),
        'set_featured_image'    => __( 'Set featured image', 'custom-crm' ),
        'remove_featured_image' => __( 'Remove featured image', 'custom-crm' ),
        'use_featured_image'    => __( 'Use as featured image', 'custom-crm' ),
        'insert_into_item'      => __( 'Insert into deal', 'custom-crm' ),
        'uploaded_to_this_item' => __( 'Uploaded to this deal', 'custom-crm' ),
        'items_list'            => __( 'Deals list', 'custom-crm' ),
        'items_list_navigation' => __( 'Deals list navigation', 'custom-crm' ),
        'filter_items_list'     => __( 'Filter deals list', 'custom-crm' ),
    );
    $deals_args = array(
        'label'                 => __( 'Deal', 'custom-crm' ),
        'description'           => __( 'Custom post type for deals', 'custom-crm' ),
        'labels'                => $deals_labels,
        'supports'              => array( 'title', 'editor', 'custom-fields' ),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'deal', $deals_args );
}
