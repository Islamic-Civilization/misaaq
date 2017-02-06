<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $misaaq_db_version;
$misaaq_db_version = '1.0';

function misaaq_create_table()
{
  global $wpdb;
	global $misaaq_db_version;
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}misaaq_ordo (
		id integer NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
		start_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    end_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    register_start_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    register_end_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		ordo_size integer NOT NULL,
    ordo_mard_max integer not null,
    ordo_zan_max integer not null,
    hazineh integer not null,
		PRIMARY KEY  (id)
	) $charset_collate;";
	dbDelta( $sql );

  $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}misaaq_registers (
    id INTEGER NOT NULL AUTO_INCREMENT,
    ordo_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    state smallint not null ,
		PRIMARY KEY  (id)
    ) $charset_collate;";
  dbDelta( $sql );

	add_option( 'misaaq_db_version', $misaaq_db_version );
  add_option($misaaq_db_version,'1.0');
}
function misaaq_drop_table()
{
  global $wpdb;
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta("drop table `{$wpdb->prefix}misaaq_registers`");
  dbDelta("drop table `{$wpdb->prefix}misaaq_ordo`");
  delete_option('misaaq_db_version');
}
function misaaq_udpate_table($old,$new)
{
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
}

?>
