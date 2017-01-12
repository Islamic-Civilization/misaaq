<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Hook for adding admin menus
add_action('admin_menu', 'misaaq_add_pages');

if ( is_admin() ){ // admin actions
  add_action( 'admin_init', 'register_misaaq_settings' );
} else {
  // non-admin enqueues, actions, and filters
}

function register_misaaq_settings() { // whitelist options
  register_setting( 'misaaq-option-group', 'new_option_name' );
  register_setting( 'misaaq-option-group', 'some_other_option' );
  register_setting( 'misaaq-option-group', 'option_etc' );
}

// action function for above hook
function misaaq_add_pages() {
    // Add a new submenu under Settings:
//    add_options_page(__('Test Settings','menu-test'), __('Test Settings','menu-test'), 'manage_options', 'testsettings', 'misaaq_settings_page');

    // Add a new submenu under Tools:
//    add_management_page( __('Test Tools','menu-test'), __('Test Tools','menu-test'), 'manage_options', 'testtools', 'misaaq_tools_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page(__('میثاق','menu-misaaq'), __('میثاق','menu-misaaq'),
     'manage_options', 'misaaq-top-level-handle', 'misaaq_toplevel_page',
    plugin_dir_url(__FILE__).'../assets/‏‏icon-16x16.png');

    if( is_admin() ){
    // Add a submenu to the custom top-level menu:
    add_submenu_page('misaaq-top-level-handle', __('اردوها','menu-misaaq'), __('اردوها','menu-misaaq'), 'manage_options', 'sub-page', 'misaaq_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page('misaaq-top-level-handle', __('ثبت نام‌ها','menu-misaaq'), __('ثبت نام‌ها','menu-misaaq'), 'manage_options', 'sub-page2', 'misaaq_sublevel_page2');
    }
}

// misaaq_settings_page() displays the page content for the Test Settings submenu
function misaaq_settings_page() {
    echo "<h2>" . __( 'Test Settings', 'menu-test' ) . "</h2>";
}

// misaaq_tools_page() displays the page content for the Test Tools submenu
function misaaq_tools_page() {
    echo "<h2>" . __( 'Test Tools', 'menu-test' ) . "</h2>";
}

// misaaq_toplevel_page() displays the page content for the custom Test Toplevel menu
function misaaq_toplevel_page() {
    echo "<h2>" . __( 'Test Toplevel', 'menu-test' ) . "</h2>";
}

// misaaq_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function misaaq_sublevel_page() {
    echo "<h2>" . __( 'Test Sublevel', 'menu-test' ) . "</h2>";
}

// misaaq_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function misaaq_sublevel_page2() {
    echo "<h2>" . __( 'Test Sublevel2', 'menu-test' ) . "</h2>";
}
 ?>
