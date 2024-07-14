<?php

class CRM_Email {
    public function __construct() {
        add_action( 'crm_new_contact', array( $this, 'send_new_contact_email' ) );
        add_action( 'crm_new_company', array( $this, 'send_new_company_email' ) );
        add_action( 'crm_new_deal', array( $this, 'send_new_deal_email' ) );
    }

    public function send_email( $to, $subject, $message ) {
        $headers = array( 'Content-Type: text/html; charset=UTF-8' );
        wp_mail( $to, $subject, $message, $headers );
    }

    public function send_new_contact_email( $contact_id ) {
        $contact = get_post( $contact_id );
        $email = get_post_meta( $contact_id, '_crm_contact_email', true );
        $subject = __( 'New Contact Added', 'custom-crm' );
        $message = sprintf( __( 'A new contact, %s, has been added.', 'custom-crm' ), $contact->post_title );
        $this->send_email( $email, $subject, $message );
    }

    public function send_new_company_email( $company_id ) {
        $company = get_post( $company_id );
        $email = get_post_meta( $company_id, '_crm_company_email', true );
        $subject = __( 'New Company Added', 'custom-crm' );
        $message = sprintf( __( 'A new company, %s, has been added.', 'custom-crm' ), $company->post_title );
        $this->send_email( $email, $subject, $message );
    }

    public function send_new_deal_email( $deal_id ) {
        $deal = get_post( $deal_id );
        $email = get_post_meta( $deal_id, '_crm_deal_email', true );
        $subject = __( 'New Deal Added', 'custom-crm' );
        $message = sprintf( __( 'A new deal, %s, has been added.', 'custom-crm' ), $deal->post_title );
        $this->send_email( $email, $subject, $message );
    }
}

new CRM_Email();
