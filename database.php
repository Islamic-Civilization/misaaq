<?php
if ( ! defined( 'ABSPATH' ) ) exit;



global $misaaq_db_version;
$misaaq_db_version = '1.0';

function misaaq_create_table()
{
  global $wpdb;
	global $misaaq_db_version;

	$table_name = $wpdb->prefix . 'misaaq_ordo';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'misaaq_db_version', $misaaq_db_version );
  add_option($misaaq_db_version,'1.0');
}
function misaaq_drop_table()
{
  delete_option('misaaq_db_version');
}
function misaaq_udpate_table($old,$new)
{
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
}

?>
