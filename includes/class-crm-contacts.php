<?php

class CRM_Contacts {
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
    }

    public function add_meta_boxes() {
        add_meta_box(
            'crm_contact_details',
            __( 'Contact Details', 'custom-crm' ),
            array( $this, 'render_meta_boxes' ),
            'contact',
            'normal',
            'high'
        );
    }

    public function render_meta_boxes( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'crm_contact_nonce_action', 'crm_contact_nonce' );

        // Retrieve existing value from the database.
        $email = get_post_meta( $post->ID, '_crm_contact_email', true );
        $phone = get_post_meta( $post->ID, '_crm_contact_phone', true );

        // Display the form fields.
        ?>
        <p>
            <label for="crm_contact_email"><?php _e( 'Email', 'custom-crm' ); ?></label>
            <input type="email" name="crm_contact_email" id="crm_contact_email" value="<?php echo esc_attr( $email ); ?>" class="widefat">
        </p>
        <p>
            <label for="crm_contact_phone"><?php _e( 'Phone', 'custom-crm' ); ?></label>
            <input type="text" name="crm_contact_phone" id="crm_contact_phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat">
        </p>
        <?php
    }

    public function save_meta_boxes( $post_id ) {
        // Check if nonce is set.
        if ( ! isset( $_POST['crm_contact_nonce'] ) ) {
            return $post_id;
        }
        $nonce = $_POST['crm_contact_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'crm_contact_nonce_action' ) ) {
            return $post_id;
        }

        // Check if this is an autosave.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check user permissions.
        if ( isset( $_POST['post_type'] ) && 'contact' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        }

        // Sanitize and save the data.
        $email = sanitize_email( $_POST['crm_contact_email'] );
        $phone = sanitize_text_field( $_POST['crm_contact_phone'] );

        update_post_meta( $post_id, '_crm_contact_email', $email );
        update_post_meta( $post_id, '_crm_contact_phone', $phone );
    }
}

new CRM_Contacts();
