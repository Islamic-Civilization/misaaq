<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('admin_menu', 'misaaq_users_menu');

function misaaq_users_menu() {
	// add_dashboard_page
  add_menu_page('اردوهای میثاق', 'اردوهای مثیاق',
   'read', 'misaaq-top-user-page', 'misaaq_top_user_page',
 plugin_dir_url(__FILE__).'../assets/‏‏icon-16x16.png');
  add_submenu_page('misaaq-top-user-page',
  'سابقه','سابقه','read',
  'misaaq-user-history','misaaq_user_history');
}
function misaaq_top_user_page(){
  echo '<h2>صفحه اصلی کاربران</h2>';
}
function misaaq_user_history(){
  echo '<h2>سابقه اردوها</h2>';
}

add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 990 );

function toolbar_link_to_mypage( $wp_admin_bar ) {
	$args = array(
		'id'    => 'misaaq_sabtename',
		'title' => 'ثبت نام آخرین اردو',
		'href'  => 'http://mysite.com/my-page/',
		'meta'  => array( 'class' => 'my-toolbar-page' )
	);
	$wp_admin_bar->add_node( $args );
}
?>
