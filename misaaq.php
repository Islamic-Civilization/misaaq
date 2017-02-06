<?php
/*
 * Plugin Name: افزونه میثاق
 * Version: 1.0
 * Plugin URI: http://misaaq.sharif.ir/
 * Description: این افزونه برای دریافت اطلاعات کاربران، تعریف اردو، حساب پولی ، ثبت نام کاربران در اردو، دادن لیست ثبت نامی‌های یک اردو طراحی شده است.
 * Author: امیر حاجی علی خمسهء
 * Author URI: http://misaaq.sharif.ir/
 * Requires at least: 4.0
 * Tested up to: 4.7
 *
 * Text Domain: misaaq
 *
 * @package Missaq
 * @author Amir Haji Ali Khamse
 * @since 1.0.0
 */
//Domain Path: /lang/
if ( ! defined( 'ABSPATH' ) ) exit;

include_once(dirname(__FILE__).'/database.php');
function misaaq_update_check() {
    global $misaaq_db_version;
    $misaaq_db_old = get_site_option( 'misaaq_db_version' );
    if ( $misaaq_db_old != $misaaq_db_version ) {
        misaaq_udpate_table($misaaq_db_old,$misaaq_db_version);
    }
}
function activate_misaaq()
{  misaaq_create_table();  }
function deactivate_misaaq()
{  misaaq_drop_table();  }
register_activation_hook(__FILE__,'activate_misaaq');
add_action( 'plugins_loaded', 'misaaq_update_check' );
register_deactivation_hook(__FILE__,'deactivate_misaaq');

add_action('admin_enqueue_scripts', 'register_misaaq_admin_script');
function register_misaaq_admin_script(){
	wp_register_style('persian_datepicker_style', plugin_dir_url( __FILE__ ).('assets/css/persian-datepicker-0.4.5.css'));
    wp_enqueue_style('persian_datepicker_style');
	// wp_register_style('bootstrap_min_style', plugin_dir_url( __FILE__ ).('assets/css/bootstrap.min.css'));
    // wp_enqueue_style('bootstrap_min_style');
	// wp_deregister_script( 'jquery' );
	// wp_enqueue_script('jquery', false, array(), false, false);
	wp_enqueue_script('jquerys_2_js', plugin_dir_url( __FILE__ ).('assets/js/jquery.js'));
	wp_enqueue_script('bootstrap_min_js', plugin_dir_url( __FILE__ ).('assets/js/bootstrap.min.js'));
	wp_enqueue_script('persian_date_js', plugin_dir_url( __FILE__ ).('assets/js/persian-date.js'),array(), null, true);
	wp_enqueue_script('persian_datepicker_js', plugin_dir_url( __FILE__ ).('assets/js/persian-datepicker-0.4.5.js'),array ( 'persian_date_js' ));
}

if ( is_admin() ){
  // if(!function_exists('wp_get_current_user'))
    // include(ABSPATH . "wp-includes/pluggable.php");
  // if(current_user_can('administrator'))
    include_once(dirname( __FILE__ ) .'/admin/panel.php') ;
  // else
    include_once(dirname(__FILE__).'/user/panel.php');
    include_once(dirname( __FILE__ ) .'/user/profile.php');
}
else{
  include_once(dirname( __FILE__ ) .'/user/register.php');
}
include_once(dirname(__FILE__).'/widget.php');
// wp_new_user_notification

?>
