<?php

class CRM_Companies {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
    }

    public function add_meta_boxes() {
        add_meta_box(
            'crm_company_details',
            __( 'Company Details', 'custom-crm' ),
            array( $this, 'render_meta_boxes' ),
            'company',
            'normal',
            'high'
        );
    }

    public function render_meta_boxes( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'crm_company_nonce_action', 'crm_company_nonce' );

        // Retrieve existing value from the database.
        $address = get_post_meta( $post->ID, '_crm_company_address', true );
        $website = get_post_meta( $post->ID, '_crm_company_website', true );

        // Display the form fields.
        ?>
        <p>
            <label for="crm_company_address"><?php _e( 'Address', 'custom-crm' ); ?></label>
            <input type="text" name="crm_company_address" id="crm_company_address" value="<?php echo esc_attr( $address ); ?>" class="widefat">
        </p>
        <p>
            <label for="crm_company_website"><?php _e( 'Website', 'custom-crm' ); ?></label>
            <input type="url" name="crm_company_website" id="crm_company_website" value="<?php echo esc_attr( $website ); ?>" class="widefat">
        </p>
        <?php
    }

    public function save_meta_boxes( $post_id ) {
        // Check if nonce is set.
        if ( ! isset( $_POST['crm_company_nonce'] ) ) {
            return $post_id;
        }
        $nonce = $_POST['crm_company_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'crm_company_nonce_action' ) ) {
            return $post_id;
        }

        // Check if this is an autosave.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check user permissions.
        if ( isset( $_POST['post_type'] ) && 'company' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        }

        // Sanitize and save the data.
        $address = sanitize_text_field( $_POST['crm_company_address'] );
        $website = esc_url_raw( $_POST['crm_company_website'] );

        update_post_meta( $post_id, '_crm_company_address', $address );
        update_post_meta( $post_id, '_crm_company_website', $website );
    }
}

new CRM_Companies();
