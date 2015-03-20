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
define('DB_NAME', 'db131215_asiancrush');

/** MySQL database username */
define('DB_USER', 'db131215');

/** MySQL database password */
define('DB_PASSWORD', 'plusamr123db');

/** MySQL hostname */
define('DB_HOST', 'internal-db.s131215.gridserver.com');

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
define('AUTH_KEY',         ']Bj5Ln_84>yst++Me<lm?gld=sKT2*]bs__ D}fhJ3A=M[c1*S,;),?0J^&*ceU=');
define('SECURE_AUTH_KEY',  '}? ey4&kjPkITZ:wHG7o%JmDg?!-Bl9rN=4!lLXjxtNp&n_DRmb$m#!L7+h.{_|&');
define('LOGGED_IN_KEY',    '|x V8rNc f&*HL`|[GlW6LkRsY=%/9k2,,5w[mB-yVH1IC}+b>T)nG^*-nSPD?*8');
define('NONCE_KEY',        '>do;35*UWCMN-AN7TLaOK6DWUZ6gV}2 4c}GNzC)MzoOSVe|.)$,]$5S7p^ E5uj');
define('AUTH_SALT',        'XeaN+##+CEC<1m/*`{i`~cabA?Q?$`~wH^<r|g=q`28pbI;/y cU(.?0YUnAyB2i');
define('SECURE_AUTH_SALT', '#tcIYaenZz):0M6]Y_A8Pv@5#f{y:@=Mmd-;$;vJ7ra%`?BzA858}5]zC,x d!1$');
define('LOGGED_IN_SALT',   '/E}bsY[-zR_W~O1.8>%JhAy<SAXg}z&aDbRiRWsZ8l+cDU1;)o[f%d%i)C~V;o`=');
define('NONCE_SALT',       'NgHPeuBpz(/kb]>[{0u2VmW[!9V6z+mtQbi~;]oDF;.2W[kdPbG$yT#AQ*+H?ax`');

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
define('WP_POST_REVISIONS', false);

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
