<?php

class CRM_Deals {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
    }

    public function add_meta_boxes() {
        add_meta_box(
            'crm_deal_details',
            __( 'Deal Details', 'custom-crm' ),
            array( $this, 'render_meta_boxes' ),
            'deal',
            'normal',
            'high'
        );
    }

    public function render_meta_boxes( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'crm_deal_nonce_action', 'crm_deal_nonce' );

        // Retrieve existing value from the database.
        $value = get_post_meta( $post->ID, '_crm_deal_value', true );
        $status = get_post_meta( $post->ID, '_crm_deal_status', true );
        $contact_id = get_post_meta( $post->ID, '_crm_deal_contact', true );
        $company_id = get_post_meta( $post->ID, '_crm_deal_company', true );

        // Fetch contacts and companies for the dropdowns.
        $contacts = get_posts( array( 'post_type' => 'contact', 'numberposts' => -1 ) );
        $companies = get_posts( array( 'post_type' => 'company', 'numberposts' => -1 ) );

        // Display the form fields.
        ?>
        <p>
            <label for="crm_deal_value"><?php _e( 'Deal Value', 'custom-crm' ); ?></label>
            <input type="number" name="crm_deal_value" id="crm_deal_value" value="<?php echo esc_attr( $value ); ?>" class="widefat">
        </p>
        <p>
            <label for="crm_deal_status"><?php _e( 'Deal Status', 'custom-crm' ); ?></label>
            <select name="crm_deal_status" id="crm_deal_status" class="widefat">
                <option value=""><?php _e( 'Select Status', 'custom-crm' ); ?></option>
                <option value="pending" <?php selected( $status, 'pending' ); ?>><?php _e( 'Pending', 'custom-crm' ); ?></option>
                <option value="won" <?php selected( $status, 'won' ); ?>><?php _e( 'Won', 'custom-crm' ); ?></option>
                <option value="lost" <?php selected( $status, 'lost' ); ?>><?php _e( 'Lost', 'custom-crm' ); ?></option>
            </select>
        </p>
        <p>
            <label for="crm_deal_contact"><?php _e( 'Related Contact', 'custom-crm' ); ?></label>
            <select name="crm_deal_contact" id="crm_deal_contact" class="widefat">
                <option value=""><?php _e( 'Select Contact', 'custom-crm' ); ?></option>
                <?php foreach ( $contacts as $contact ) : ?>
                    <option value="<?php echo esc_attr( $contact->ID ); ?>" <?php selected( $contact_id, $contact->ID ); ?>><?php echo esc_html( $contact->post_title ); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="crm_deal_company"><?php _e( 'Related Company', 'custom-crm' ); ?></label>
            <select name="crm_deal_company" id="crm_deal_company" class="widefat">
                <option value=""><?php _e( 'Select Company', 'custom-crm' ); ?></option>
                <?php foreach ( $companies as $company ) : ?>
                    <option value="<?php echo esc_attr( $company->ID ); ?>" <?php selected( $company_id, $company->ID ); ?>><?php echo esc_html( $company->post_title ); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    public function save_meta_boxes( $post_id ) {
        // Check if nonce is set.
        if ( ! isset( $_POST['crm_deal_nonce'] ) ) {
            return $post_id;
        }
        $nonce = $_POST['crm_deal_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'crm_deal_nonce_action' ) ) {
            return $post_id;
        }

        // Check if this is an autosave.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check user permissions.
        if ( isset( $_POST['post_type'] ) && 'deal' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        }

        // Sanitize and save the data.
        $value = sanitize_text_field( $_POST['crm_deal_value'] );
        $status = sanitize_text_field( $_POST['crm_deal_status'] );
        $contact_id = sanitize_text_field( $_POST['crm_deal_contact'] );
        $company_id = sanitize_text_field( $_POST['crm_deal_company'] );

        update_post_meta( $post_id, '_crm_deal_value', $value );
        update_post_meta( $post_id, '_crm_deal_status', $status );
        update_post_meta( $post_id, '_crm_deal_contact', $contact_id );
        update_post_meta( $post_id, '_crm_deal_company', $company_id );
    }
}

new CRM_Deals();
