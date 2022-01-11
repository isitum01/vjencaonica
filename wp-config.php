<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'vjencaonica' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'CWz+Z{W(sWVV>3s[FO(;S4UcT[kAQq{KQ*r^&yE?=mb :g~)909K[d//L=`a^oOX' );
define( 'SECURE_AUTH_KEY',  'SMC.d6/{md6=;#Y84OS RNTY{r)@s.m_id;E9WK42r<@4rWuXjYRd3dh&bo9{vUG' );
define( 'LOGGED_IN_KEY',    'I8x?_n9sf9oi{&SRQ5=mYd% K{i@9@UIxPMhEbI][UTYQ!A<(oD+!iQ)15LpM0~Q' );
define( 'NONCE_KEY',        'tiZ5sF_qnn:C:,W%0onYe14ucxab{A&Tr>bj9S@`wejyBH_/nS#]LYB$u7~//D/p' );
define( 'AUTH_SALT',        'RMLj=rer$*Yh-(j;g5`&N4az G-_}9g#Kv)bB?_wG-HyJo$1rSY8mwEsvt%Nrj<*' );
define( 'SECURE_AUTH_SALT', 'c6<n&lSJ;lBw8nV20#F3<;(a,?ba>J<`%plgvxEO`Mr{xx5~}||SN|$L*P{R{/:?' );
define( 'LOGGED_IN_SALT',   'N]ag,Y!:Ku<K0LqbA{0:k_.n_(/3,/Q[Vw2IS]wWh&6&4i~W:!A!+69m%j5/DQ+c' );
define( 'NONCE_SALT',       'w-CUfD-S:#*3c[53-ZA8`&9lR_f.`I Ry+!eTX 9B4@w&P[?R75(2dcpL!kQS%ZN' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
