<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/*** Display field value on the order edit page */
function jw_lpd_display_admin_order_meta($order){
    if (get_post_meta( $order->id, 'deliver_date', true )) {
        echo '<p><strong>'.__('Deliver date').':</strong> ' . get_post_meta( $order->id, 'deliver_date', true ) . '</p>';
    }
    
    if (get_post_meta( $order->id, 'deliver_time_slot', true )) {
        echo '<p><strong>'.__('Deliver time').':</strong> ' . get_post_meta( $order->id, 'deliver_time_slot', true ) . '</p>';
    }
    
    if (get_post_meta( $order->id, 'pickup_location', true )) {
        echo '<p><strong>'.__('Pickup location').':</strong> ' . get_post_meta( $order->id, 'pickup_location', true ) . '</p>';
    }
    
    if (get_post_meta( $order->id, 'pickup_location_date', true )) {
        echo '<p><strong>'.__('Pickup location').':</strong> ' . get_post_meta( $order->id, 'pickup_location_date', true ) . '</p>';
    }
    
    if (get_post_meta( $order->id, 'pickup_location_time_slot', true )) {
        echo '<p><strong>'.__('Pickup location').':</strong> ' . get_post_meta( $order->id, 'pickup_location_time_slot', true ) . '</p>';
    }
}

// add admin woocommerce menu
function register_jw_lpd_submenu_page() {
    add_submenu_page( 'woocommerce', 'JW Simple Pickup & Deliver', 'JW Simple Pickup & Deliver', 'manage_options', 'jw_simple_local_pickup_submenu_page', 'jw_lpd_submenu_page_callback' ); 
}

// admin page
function jw_lpd_submenu_page_callback() {
    
    if (isset($_POST['jw_simple_deliver_time_slot'])) {
        update_option('jw_simple_deliver_time_slot', $_POST['jw_simple_deliver_time_slot']);
        //$value = $_POST['jw_simple_deliver_time_slot'];
    } 
    
    if (isset($_POST['jw_simple_pickup_locations'])) {
        update_option('jw_simple_pickup_locations', $_POST['jw_simple_pickup_locations']);
        //$value = $_POST['jw_simple_pickup_locations'];
    }
    
    if (isset($_POST['jw_simple_pickup_locations_time_slot'])) {
    update_option('jw_simple_pickup_locations_time_slot', $_POST['jw_simple_pickup_locations_time_slot']);
    //$value = $_POST['jw_simple_pickup_locations'];
    }

    $deliver_value = get_option('jw_simple_deliver_time_slot');
    $pickup_location_value = get_option('jw_simple_pickup_locations');
    $pickup_location_time_slot_value = get_option('jw_simple_pickup_locations_time_slot');
    
    include 'jw_lpd_admin_page.php';
}
