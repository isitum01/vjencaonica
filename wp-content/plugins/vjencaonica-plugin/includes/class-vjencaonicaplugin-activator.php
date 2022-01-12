<?php

namespace Vjencaonica;

class VjencaonicaPlugin_Activator
{
    /**
     * Database version
     * Should be updated every time we modify the database
     */
    const DB_VERSION = '0.0.1';

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

        // Update the version option in database
        update_option(static::DB_VERSION_OPTION_NAME, static::DB_VERSION);
    }
}
