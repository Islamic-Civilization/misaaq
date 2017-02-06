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
     'manage_options', 'misaaq-admin-top', 'misaaq_admin_top_page',
    plugin_dir_url(__FILE__).'../assets/‏‏icon-16x16.png');

    if( is_admin() ){
    // Add a submenu to the custom top-level menu:
    add_submenu_page('misaaq-admin-top', __('اردوها','menu-misaaq'), __('اردوها','menu-misaaq'),
     'manage_options', 'ordo-page', 'misaaq_admin_ordo_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page('misaaq-admin-top', __('ثبت نام‌ها','menu-misaaq'), __('ثبت نام‌ها','menu-misaaq'),
     'manage_options', 'reg-page', 'misaaq_admin_reg_page');
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
function misaaq_admin_top_page() {
    echo "<h2>" . __( 'Test Toplevel', 'menu-test' ) . "</h2>";
}

function create_ordo_settings_init()
{
    // register a new setting for "wporg" page
    register_setting('misaaq', 'create_ordo_options');

    // register a new section in the "wporg" page
    add_settings_section(
        'create_ordo_section',
        __('ایجاد یک اردو', 'misaaq'),
        'create_ordo_section_cb',
        'misaaq'
    );

    // register a new field in the "create_ordo_section" section, inside the "wporg" page
    add_settings_field(
        'create_ordo_field_name', // as of WP 4.6 this value is used only internally
        __('نام', 'misaaq'),
        'create_ordo_name_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_name',
        ]
    );
    add_settings_field(
        'create_ordo_field_start_date',
        __('تاریخ شروع', 'misaaq'),
        'create_ordo_date_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_start_date',
        ]
    );
    add_settings_field(
        'create_ordo_field_end_date',
        __('تاریخ پایان', 'misaaq'),
        'create_ordo_date_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_end_date',
        ]
    );
    add_settings_field(
        'create_ordo_field_start_reg_date',
        __('تاریخ شروع ثبت نام', 'misaaq'),
        'create_ordo_date_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_start_reg_date',
        ]
    );
    add_settings_field(
        'create_ordo_field_end_reg_date',
        __('تاریخ پایان ثبت نام', 'misaaq'),
        'create_ordo_date_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_end_reg_date',
        ]
    );
    add_settings_field(
        'create_ordo_field_nafar',
        __('ظرفیت اردو', 'misaaq'),
        'create_ordo_nafar_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_nafar','value'=>'36'
        ]
    );
    // add_settings_field(
        // 'create_ordo_field_nafar_mard',
        // __('ظرفیت مردان', 'misaaq'),
        // 'create_ordo_nafar_cb',
        // 'misaaq',
        // 'create_ordo_section',
        // [
            // 'label_for'         => 'create_ordo_field_nafar_mard','value'=>'36'
        // ]
    // );
    // add_settings_field(
        // 'create_ordo_field_nafar_zan',
        // __('ظرفیت بانوان', 'misaaq'),
        // 'create_ordo_nafar_cb',
        // 'misaaq',
        // 'create_ordo_section',
        // [
            // 'label_for'         => 'create_ordo_field_nafar_zan','value'=>'36'
        // ]
    // );
    add_settings_field(
        'create_ordo_field_hazineh',
        __('هزینه‌ی اردو', 'misaaq'),
        'create_ordo_hazineh_cb',
        'misaaq',
        'create_ordo_section',
        [
            'label_for'         => 'create_ordo_field_hazineh','value'=>'50000'
        ]
    );
}
add_action('admin_init', 'create_ordo_settings_init');
function create_ordo_section_cb($args){
  ?>
  <p id="<?= esc_attr($args['id']); ?>"><?= esc_html__('اطلاعات اردو را وارد کنید.', 'misaaq'); ?></p>
  <?php
}
function create_ordo_name_cb($args){
    // $options = get_option('create_ordo_options');
  ?>
  <input  id="<?= esc_attr($args['label_for']); ?>" class="text" name="wporg_options[<?= esc_attr($args['label_for']); ?>]"/>
  <?php
}
function create_ordo_date_cb($args){
  ?>
  <script type="text/javascript">
$(document).ready(function () {
$('#<?= esc_attr($args['label_for']); ?>').persianDatepicker({
	altField: '#<?= esc_attr($args['label_for']); ?>Alt',
	persianDigit: true,
	// observer: true,
    // format: 'YYYY/MM/DD'
});
});
	</script>
  <input  id="<?= esc_attr($args['label_for']); ?>" type="text" class="form-control ltr" name="wporg_options[<?= esc_attr($args['label_for']); ?>]"/>
  <input  id="<?= esc_attr($args['label_for']); ?>Alt" type="text" class="form-control" name="wporg_options[<?= esc_attr($args['label_for']); ?>Alt]" hidden />
  <?php
}
function create_ordo_nafar_cb($args){
  ?>
  <input  id="<?= esc_attr($args['label_for']); ?>" class="small-text ltr" type="number" step="2" min="0" max="512" value="<?= esc_attr($args['value']); ?>" name="wporg_options[<?= esc_attr($args['label_for']); ?>]"/>
  <span class="description"> حداکثر آقایان</span>
  <input  id="<?= esc_attr($args['label_for']); ?>_Mard" class="small-text ltr" type="number" step="2" min="0" max="512" value="0" name="wporg_options[<?= esc_attr($args['label_for']); ?>]_Mard"/>
  <span class="description">حداکثر بانوان</span>
  <input  id="<?= esc_attr($args['label_for']); ?>_Zan" class="small-text ltr" type="number" step="2" min="0" max="512" value="0" name="wporg_options[<?= esc_attr($args['label_for']); ?>]_Zan"/>
  <?php
}
function create_ordo_hazineh_cb($args){
  ?>
  <input  id="<?= esc_attr($args['label_for']); ?>" class="text ltr" type="number" step="5000" min="0" value="<?= esc_attr($args['value']); ?>" name="wporg_options[<?= esc_attr($args['label_for']); ?>]"/>
  <span class="description">قیمت به ریال</span>
  <?php
}
function misaaq_admin_ordo_page() {
  //$_REQUEST
  if(! empty($ordo = $_POST['wporg_options'])){
    var_dump($ordo);
    $first_name = ( ! empty( $_POST[mUserFirstNameKey] ) ) ? trim( $_POST[mUserFirstNameKey] ) : '';
  }
    ?>

    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="" method="post">
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields('create_ordo_options');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('misaaq');
            // output save settings button
            submit_button('ثبت');
            ?>
        </form>
    </div>
    <?php
}

// misaaq_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function misaaq_admin_reg_page() {
    echo "<h2>" . __( 'Test Sublevel2', 'menu-test' ) . "</h2>";
}
 ?>
