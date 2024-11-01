<?php
/**
* Plugin Name: Woocommerce JW Simple Localpickup and Delivery
* Plugin URI: http://plugin.travelediary.com
* Description: Add simple local pick up selection and delivery date time on checkout page
* Version: 1.0
* Author: Jonathan Wong
* Author URI: http://author.travelediary.com
* License: GPL12
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// required functions
require_once( plugin_dir_path( __FILE__ ) . '/includes/jw_lpd_front_functions.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/jw_lpd_admin_functions.php' );

/********************* add css *********************/
function jw_lpd_css_scripts() {
    wp_enqueue_style( 'jw-lpd_simple-css', plugin_dir_url( __FILE__ ) . '/assets/css/jw-style.css', null, null );
    wp_enqueue_style( 'jw-lpd_jquery-ui-css', plugin_dir_url( __FILE__ ) . '/assets/css/jquery-ui.css', null, null );
}

add_action( 'admin_init', 'jw_lpd_css_scripts' );

/********************* admin *********************/
// add sub menu
add_action('admin_menu', 'register_jw_lpd_submenu_page');

// display order deliver date|time, pickup location 
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'jw_lpd_display_admin_order_meta', 10, 1 );


/********************* Front *********************/
// add jquery datepicker
add_action( 'wp_enqueue_scripts', 'jw_lpd_enqueue_datepicker' );

// add display localpickup and delivery at checkout page section 
add_action( 'woocommerce_after_template_part', 'jw_lpd_add_display', 10, 4 );

// validate custom field
add_action('woocommerce_checkout_process', 'jw_lpd_field_process');

// add custom field to database
add_action( 'woocommerce_checkout_update_order_meta', 'jw_lpd_update_order_meta' );

// add local pickup/ deliver date time to woocommerce thankyou page
add_action( 'woocommerce_thankyou', 'jw_lpd_order_view');

// add local pickup/ deliver date time to woocommerce order view
add_action( 'woocommerce_view_order', 'jw_lpd_order_view' );

// add local pickup/ deliver date time to email
add_filter( 'woocommerce_email_order_meta_fields', 'jw_lpd_email', 10 , 3 );

