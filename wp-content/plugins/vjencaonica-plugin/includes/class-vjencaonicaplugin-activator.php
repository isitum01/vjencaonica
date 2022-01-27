<?php

namespace Vjencaonica;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    VjencaonicaPlugin
 * @subpackage Vjencaonica/includes
 */
class VjencaonicaPlugin_Activator {
	/**
	 * Database version
	 * Should be updated every time we modify the database
	 */
	const DB_VERSION = '0.0.2';

	/**
	 * Database version option name
	 */
	const DB_VERSION_OPTION_NAME = '_vjencaonicaplugin_db_version';


	/**
	 * Function that is called on plugin activation.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Check if ACF plugin if activated, if not - prevent activating
		if ( ! is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
			wp_die( __( 'Sorry, but this plugin requires the ACF plugin to be installed and active. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>' ) );
		}

		$version = get_option( static::DB_VERSION_OPTION_NAME, false );

		// If version is same do not create any tables.
		if ( $version == static::DB_VERSION ) {
			return;
		}

		// Get queries
		$queries = static::get_queries();

		// Execute queries
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $queries );

		// Update the version option in database
		update_option( static::DB_VERSION_OPTION_NAME, static::DB_VERSION );
	}

	/**
	 * Gets all queries to create on db.
	 */
	private static function get_queries() {
		global $wpdb;
		$wp_prefix       = $wpdb->prefix;
		$charset_collate = $wpdb->get_charset_collate();

		// Get table names.
		$music_bands_table 					= "{$wp_prefix}vj_music_bands";

		return [
			"CREATE TABLE {$music_bands_table} (
				id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
				band_name VARCHAR(64),
				phone VARCHAR(64),
				email VARCHAR(64),
				city VARCHAR(64),
				country VARCHAR(64),
				available_locations TEXT,
				members VARCHAR(64),
				instruments TEXT,
				video_link VARCHAR(128),
				genres TEXT,
				female_vocal VARCHAR(64),
				male_vocal VARCHAR(64),
				website VARCHAR(128),
				instagram VARCHAR(128),
				facebook VARCHAR(128),
				tags TEXT,
				year_of_foundation VARCHAR(64),
				short_description TEXT,
				granted VARCHAR(64),
				date_created VARCHAR(128) NOT NULL,
			    PRIMARY KEY id (id)
			) {$charset_collate};"
		];
	}
}