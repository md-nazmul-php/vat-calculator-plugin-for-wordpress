<?php
/*
Plugin Name: VAT Calculator
Plugin URI: https://www.upwork.com/fl/mdnazmul62
* Version:     1.0.1
Description: This plugin use to calculate VAT
Author: Md Nazmul
text-domain: vat_calculator
Author URI: https://www.upwork.com/fl/mdnazmul62
License: GPL2
*/

load_plugin_textdomain('vat_calculator', false, dirname(plugin_basename(__FILE__)) . '/lang/');
register_activation_hook( __FILE__, 'crudOperationsTable');


define( 'PLUGIN_DIR', dirname(__FILE__).'/' );  


//create table while plugin activate
function crudOperationsTable() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  $table_name = $wpdb->prefix . 'vatcalculator';

  $sql = "CREATE TABLE `wp_vatcalculator` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `country` varchar(220) DEFAULT NULL,
 `vat` FLOAT(9,2) DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
  ";

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
  }
}


//adding admin menu page

add_action('admin_menu', 'addAdminPageContent');

function addAdminPageContent() {
     add_menu_page(

     'vat-calculator',
     'VAT  Calculator Settings', 
     'manage_options' ,
     __FILE__, 
     'crudAdminPage',
     'dashicons-buddicons-bbpress-logo');

}


//page function main
function crudAdminPage() {
include "vat_insert.php";
     }
include 'vat_output.php'; ?>