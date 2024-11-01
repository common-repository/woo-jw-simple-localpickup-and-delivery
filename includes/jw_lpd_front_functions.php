<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Add Datepicker
function jw_lpd_enqueue_datepicker() {
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    //wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
    //wp_enqueue_style( 'jquery-ui' );  
}

function jw_lpd_get_shipping_methods () {
    global $woocommerce;
    $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
    $chosen_shipping = $chosen_methods[0];
    $chosen_shipping = explode(':', $chosen_shipping);
    $selected_shipping_method = $chosen_shipping[0];
    
    return $selected_shipping_method;
}

// add display part to woocommerce template
function jw_lpd_add_display( $template_name, $template_path, $located, $args) {
    global $wp_query;
    global $woocommerce;
    $packages = WC()->shipping->get_packages();
    if ($packages) {
        $shipping_method = jw_lpd_get_shipping_methods();
        if ('cart/cart-shipping.php' === $template_name && ( $shipping_method == 'flat_rate' || $shipping_method == 'free_shipping' ) && ( is_checkout() || ( defined( 'WC_DOING_AJAX' ) && 'update_order_review' === $wp_query->get( 'wc-ajax' ) ) ) ) {
            jw_lpd_display_simple_delivery( $args['index'] );
        }
        
        if ('cart/cart-shipping.php' === $template_name && $shipping_method == 'local_pickup' && ( is_checkout() || ( defined( 'WC_DOING_AJAX' ) && 'update_order_review' === $wp_query->get( 'wc-ajax' ) ) ) ) {
            jw_lpd_display_simple_localpickup( $args['index'] );
        }
    }
}

function jw_lpd_display_simple_delivery() {
    $deliver_value = get_option('jw_simple_deliver_time_slot');
    include 'jw_lpd_front_deliver.php';
}

function jw_lpd_display_simple_localpickup() {
    $pickup_location_value = get_option('jw_simple_pickup_locations');
    $pickup_location_time_slot_value = get_option('jw_simple_pickup_locations_time_slot');
    include 'jw_lpd_front_localpickup.php';
}


// check custom field required
function jw_lpd_field_process() {

// Check if set, if its not set add an error.
    $shipping_method = jw_lpd_get_shipping_methods();
    if ($shipping_method){
        if ($shipping_method == 'flat_rate') {
            if ( ! $_POST['deliver_date'] )
                wc_add_notice( __( 'Please select delivery date.' ), 'error' );
            if ( ! $_POST['deliver_time_slot'] )
                wc_add_notice( __( 'Please select delivery timeslot.' ), 'error' );
        }
        if ($shipping_method == 'local_pickup') {
            if ( ! $_POST['pickup_location'] )
                wc_add_notice( __( 'Please select pickup location.' ), 'error' );
            if ( ! $_POST['pickup_location_date'] )
                wc_add_notice( __( 'Please select pickup day.' ), 'error' );
            if ( ! $_POST['pickup_location_time_slot'] )
                wc_add_notice( __( 'Please select pickup time slot.' ), 'error' );
        }
    }
}

function jw_lpd_update_order_meta( $order_id ) {

    if ( ! empty( $_POST['deliver_date'] ) ) {
        update_post_meta( $order_id, 'deliver_date', sanitize_text_field( $_POST['deliver_date'] ) );
    }
    if ( ! empty( $_POST['deliver_time_slot'] ) ) {
        update_post_meta( $order_id, 'deliver_time_slot', sanitize_text_field( $_POST['deliver_time_slot'] ) );
    }
    if ( ! empty( $_POST['pickup_location'] ) ) {
        update_post_meta( $order_id, 'pickup_location', sanitize_text_field( $_POST['pickup_location'] ) );
    }
    if ( ! empty( $_POST['pickup_location_date'] ) ) {
        update_post_meta( $order_id, 'pickup_location_date', sanitize_text_field( $_POST['pickup_location_date'] ) );
    }
    if ( ! empty( $_POST['pickup_location_time_slot'] ) ) {
        update_post_meta( $order_id, 'pickup_location_time_slot', sanitize_text_field( $_POST['pickup_location_time_slot'] ) );
    }
}

function jw_lpd_order_view ($order) {
    echo '<div class="jw_lpd_thankyou">';
        if (get_post_meta( $order, 'deliver_date', true ) || get_post_meta( $order, 'deliver_time_slot', true )) {
        echo '<h2>Deliver Day and Time</h2>';
        }
        if (get_post_meta( $order, 'deliver_date', true )) {
            echo '<h5><strong>'.__('Deliver date').':</strong> ' . get_post_meta( $order, 'deliver_date', true ) . '</h5>';
        }
        if (get_post_meta( $order, 'deliver_time_slot', true )) {
            echo '<h5><strong>'.__('Deliver time').':</strong> ' . get_post_meta( $order, 'deliver_time_slot', true ) . '<h5>';
        }
        
        if (get_post_meta( $order, 'pickup_location', true )) {
        echo '<h2>Pickup location</h2>';
        }
        if (get_post_meta( $order, 'pickup_location', true )) {
            echo '<h5><strong>'.__('Pickup location:').':</strong> ' . get_post_meta( $order, 'pickup_location', true ) . '<h5>';
        }
        if (get_post_meta( $order, 'pickup_location_date', true )) {
            echo '<h5><strong>'.__('Pickup location Date:').':</strong> ' . get_post_meta( $order, 'pickup_location_date', true ) . '<h5>';
        }
        if (get_post_meta( $order, 'pickup_location_time_slot', true )) {
            echo '<h5><strong>'.__('Pickup location time slot:').':</strong> ' . get_post_meta( $order, 'pickup_location_time_slot', true ) . '<h5>';
        }
    
    
    echo '</div><br/>';
}

function jw_lpd_email ( $fields, $sent_to_admin, $order ) {
    
        $fields['deliver_date'] = array(
            'label' => __( 'Deliver date' ),
            'value' => get_post_meta( $order->id, 'deliver_date', true ),
        );
    
        $fields['deliver_time_slot'] = array(
            'label' => __( 'Deliver time' ),
            'value' => get_post_meta( $order->id, 'deliver_time_slot', true ),
        );
    
        $fields['pickup_location'] = array(
            'label' => __( 'Pickup location' ),
            'value' => get_post_meta( $order->id, 'pickup_location', true ),
        );
        
        $fields['pickup_location_date'] = array(
            'label' => __( 'Pickup location date' ),
            'value' => get_post_meta( $order->id, 'pickup_location_date', true ),
        );
        
        $fields['pickup_location_time_slot'] = array(
            'label' => __( 'Pickup location time slot' ),
            'value' => get_post_meta( $order->id, 'pickup_location_time_slot', true ),
        );
    
    return $fields;
    
}