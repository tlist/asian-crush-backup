<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager

define('WPCACHEHOME', 'C:\wamp\www\amr_old/wp-content/plugins/wp-super-cache/');


define('DB_NAME', 'amr_old');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'apartment#9');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$L AB3-Q%2xRdKAJk0QZD8)ksLYbkj??,v:;N#C% FPR_!o.l?Yl,Ze24&isLP)#');
define('SECURE_AUTH_KEY',  'xiCfXWZI#.eYszNOaf4E#ANt{PRq4tguIxM!j5Ya`kzy+TuL6TQIof).FX]UgLzc');
define('LOGGED_IN_KEY',    'LEjvZ)$:OHH{lMOw-HLO6L_Qu?7Wqe*0F]:MxY{el^{+w0,rx4;XE;^[ND4%8ZfA');
define('NONCE_KEY',        '8=XW%~v E/tZ+vAdC`mQjval`Sv9Cv1:`Th]aSh/C,ObxUz^]HN]~|PdStX<XUss');
define('AUTH_SALT',        '80z}yZ>(v,U~qu%Z+&lo&jE9<tjP{__/(]BkZL?m?b1z)$OCAq} &!^V@4t=AFo?');
define('SECURE_AUTH_SALT', 'RZ45Wzn3l1hG}34DOP?O2#m=u-fj{kyI/V-)k&YR3RW*=b*?U{GBo8*RQV3|#J#=');
define('LOGGED_IN_SALT',   'm2kKlc<Z6A^Y YU0r%0$u?w*-2VR|~DeALXqkuA|quu8S~ lcB&2+VYsuN.Np@,3');
define('NONCE_SALT',       '^njbTZf.%h!f<*>?Fy]Wt>Dr34RxNB@Y>8{]Wp.dLC4R7k`c>*;n>C=^.H-bH{&]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'amr_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings 
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors',0);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
