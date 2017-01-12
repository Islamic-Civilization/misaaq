<?php
/**
 *
 * This file runs when the plugin in uninstalled (deleted).
 * This will not run when the plugin is deactivated.
 * Ideally you will add all your clean-up scripts here
 * that will clean-up unused meta, options, etc. in the database.
 *
 */
// If plugin is not being uninstalled, exit (do nothing)
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
// $option_name = 'wporg_option';
// delete_option($option_name);
// for site options in Multisite
// delete_site_option($option_name);

// drop a custom database table
// global $wpdb;
// $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}mytable");

// Do something here if plugin is being uninstalled.
