<?php
register_activation_hook( __FILE__, array( 'Misaaq', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Misaaq', 'plugin_deactivation' ) );


global $misaaq_db_version;
$misaaq_db_version = '1.0';

function misaaq_update_db_check() {
    global $misaaq_db_version;
    if ( get_site_option( 'misaaq_db_version' ) != $misaaq_db_version ) {
        plugin_activation();
    }
}
add_action( 'plugins_loaded', 'misaaq_update_db_check' );

function plugin_activation() {
    global $wpdb;
	global $misaaq_db_version;
return;
    // ordo,registered(+in registering),user extera filed
    // update code and scrtipt
    $installed_ver = get_option( "misaaq_db_version" );
    if ( $installed_ver != $misaaq_db_version ) {

        $table_name = $wpdb->prefix . 'liveshoutbox';

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            text text NOT NULL,
            url varchar(100) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        update_option( "misaaq_db_version", $misaaq_db_version );
    }

	$table_name = $wpdb->prefix . 'liveshoutbox';

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

    $welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';

	$table_name = $wpdb->prefix . 'liveshoutbox';

	$wpdb->insert(
		$table_name,
		array(
			'time' => current_time( 'mysql' ),
			'name' => $welcome_name,
			'text' => $welcome_text,
		)
	);
}

function plugin_deactivation() {

}
?>
