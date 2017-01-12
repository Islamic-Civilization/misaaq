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
{
  misaaq_create_table();
}
function deactivate_misaaq(){}
register_activation_hook(__FILE__,'activate_misaaq');
add_action( 'plugins_loaded', 'misaaq_update_check' );
register_deactivation_hook(__FILE__,'deactivate_misaaq');

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
