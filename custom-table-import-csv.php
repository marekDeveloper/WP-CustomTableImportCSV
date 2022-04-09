<?php

/**
 * Plugin Name:       Custom Table Import CSV
 * Plugin URI:        https://github.com/marekDeveloper/WP-CustomTableImportCSV
 * Description:       Example WP plugin to create custom DB table and import CSV data into this table
 * Version:           0.1
 * Author:            Marek Pisch
 * Author URI:        http://www.altaso.com
 */

define('WPCTI_TABLE_NAME', 'model_box_sizes'); // WP prefix will be added automatically

// function called on plugin activation, creating new custom DB table
function wpcti_cerate_custom_db_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . WPCTI_TABLE_NAME;
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$table_name} (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		make text NOT NULL,
        model text NOT NULL,
        year tinyint NULL DEFAULT '',
		box_size text NOT NULL,
		PRIMARY KEY (id)
	) $charset_collate;";
    
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

// Register activation hook - Create new custom DB table
register_activation_hook( __FILE__, 'wpcti_cerate_custom_db_table' );

// Register de-activation hook - Remove new custom DB table
// TO DO! TO REVIEW! - Should we remove custom DB table on deactivation or uninstall???
register_deactivation_hook( __FILE__, 'wpcti_delete_custom_db_table' );
//register_uninstall_hook(__FILE__, 'delete_custom_db_table');
