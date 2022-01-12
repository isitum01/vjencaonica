<?php

namespace Vjencaonica;

class VjencaonicaPlugin_Activator
{
    /**
     * Database version
     * Should be updated every time we modify the database
     */
    const DB_VERSION = '0.0.2';

    /**
     * Database version option name
     */
    const DB_VERSION_OPTION_NAME = '_vjencaonica_db_version';

    public static function activate()
    {
        if (version_compare(get_bloginfo('version'), '5.0', '<')) {
            wp_die("You must update WordPress to use this plugin.", 'vjencaonica-plugin');
        }

        $version = get_option(static::DB_VERSION_OPTION_NAME, false);

        // If version is same do not create any tables.
        if ($version == static::DB_VERSION) {
            return;
        }

        // Get queries
        $queries = static::get_queries();

        // Execute queries
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($queries);

        // Update the version option in database
        update_option(static::DB_VERSION_OPTION_NAME, static::DB_VERSION);
    }

    public static function get_queries()
    {
        global $wpdb;
        $wp_prefix          = $wpdb->prefix;
        $charset_collate    = $wpdb->get_charset_collate();

        // Get table names
        $test_table_name = "{$wp_prefix}test_table_name";

        return [
            "CREATE TABLE {$test_table_name}(
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                first_name VARCHAR(64),
                last_name VARCHAR(64),
                PRIMARY KEY id (id)
            ){$charset_collate};"
        ];
    }
}
