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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Edumy' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'q,.TV`Ce_)-@@moXxP(}-WtA-<,>j=zZ#DP.GS [F?W(g6t|,PQkp>}Uc4TQ|Ndv' );
define( 'SECURE_AUTH_KEY',  '%3:m-N}{.F>V$vp9OZG-U M:>kJ3W>%*]gLsP$-m`sEn<|%SOI.++JpyYG}bMa.m' );
define( 'LOGGED_IN_KEY',    ';8Iq1|}BotP18yPcq)0?InUSr/Z,50r=h/}d-N}3+x4$1`3Up2r42 fZd&)O5g2Q' );
define( 'NONCE_KEY',        'yV%D(o/+ntX4&}%1}ki<{;t$0u0-!XjrLtO])~Zbu+9~-eGq-xFfls7JKPN+~IMC' );
define( 'AUTH_SALT',        'Cv,d%tG!1yMg0i>KMbg06Axi+xd2s4Oa8@O$F]2viu9%3 5ZQBiiMiDWw9.s9aOH' );
define( 'SECURE_AUTH_SALT', 'h><xbqF@H.jY>6`G@Y|.F`0zV$X>^*30Yfj/|1yL@N>=&7`|F}hj@Q>;dIg.(K/s' );
define( 'LOGGED_IN_SALT',   '[`$L|3B;809d;~{Lu,]`|lEinw$c_0&5Zu2#m4ic/#5Q8DYNLg$?rT(*v,nFy^DT' );
define( 'NONCE_SALT',       '7g7D3 -h>6d.i*3U(M^y4ob`S&7dvjW4HHm.3V}]Qd0^uO.E~@14qR5.gEbV6MY{' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_Edumy';

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
//define( 'WP_DEBUG', false );>>
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
