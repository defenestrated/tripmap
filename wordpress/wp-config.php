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
define('DB_NAME', 'tripmap');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '[+0B3tk|O;y{Tc7N~Cv(2$8*jH<Tk,lnjlB* S**]1i3bvE+ /;24lD7#a0XYKGH');
define('SECURE_AUTH_KEY',  '0#057tO+d(`wPye(Ar:yn:XPxTX.H9e3|+n,%xNW-MC]<aY45C0UFv^ZOM_&U57l');
define('LOGGED_IN_KEY',    'm>C_VK1y/g22vvX)}ddorr=v7(;mLLk5=8X%j}*(-8H%l)-k`AImQU)w%}|PQO=a');
define('NONCE_KEY',        'goIV(lAnRW1Na;}SnzvC(tBmiK_DEmQtvm-)@s2LmOlN]~1@{lY<Vw1FP(s}YcM^');
define('AUTH_SALT',        'JfkOP* yV,J.*;0&=#Aw(ysJBQ8*5C%2VA#]Jkssn{fsCJy $WCl}CQt}[_A>*|;');
define('SECURE_AUTH_SALT', 'k:Eas|33}ui/jpVYi<e:Ad3?xK)Ic>qd.${:F<Md*8Ct^9;4Lb^cBmlFp(Y}+UzN');
define('LOGGED_IN_SALT',   'eTr%[bI?4Jc^>v{B9-h.CN`2oF}]DyW3tUhGJ];XsS>H uciq~D_LV7UQppMh$5Y');
define('NONCE_SALT',       'HPc?u<1m(Ib)x(A/&%J~]Vy99Yd)}V$wic~in{DZm7)qYL`v~8p$u{ozS Fe#cSy');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
