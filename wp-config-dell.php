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
define('DB_NAME', 'ac_orig');

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
define('AUTH_KEY',         'Z=|kWp&TmUf.kIG040lW~jrs5f:]yaVu]7L^wed+EA~wZv!)y,51;p3z}jXCk:~c');
define('SECURE_AUTH_KEY',  'p[BM=c6!<3z#UnHlX/^FPP*U+Mj^HT$>&AD[9Y:aGgnaP{<PLPVCTmZ+gqi$ncu.');
define('LOGGED_IN_KEY',    'g1QyS&JDn&XQkm^koMj| /]x@F,hPDr9x/>8=B!/3GOZdC>KR8;Jz#pAf_>7j@AA');
define('NONCE_KEY',        'cxB%Z8gRg3l]br-jj&wF[{5iV9R142<t&qvA>WaM&z7i kyKvR&(+P@UCC,pdwk7');
define('AUTH_SALT',        'C//SU/7~>n5]gP# T5Mr(%>6&KY-KJ4lUaSE(_[Ju2(R#$~0ZY$:]e.o0EA|oMQ8');
define('SECURE_AUTH_SALT', '^_;<`2L3#7GUIVKqfb[Ul$&>.r2&CmzMAHT fTks?<=YTQAsM3I,|FH5]p$Z{~T_');
define('LOGGED_IN_SALT',   'QULCq5`4I#$k~PT(n0zE#3p boU~3SUtn<6Pu9jRj6XRj[vL<*?}t<#MjRT{,2Vw');
define('NONCE_SALT',       '.xXrxlEuHz 9$|8BZMt3I,8)R.?.6[@l?O6IrSJdu=~EFa|>o|d16~~y`S2*lCP_');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
