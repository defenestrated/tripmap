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
define('AUTH_KEY',         '~r{)VUmC8ca$lk2`Qcm[!/GhD(a0,l3k}%U6/fuVGWxn+oLoTm;S312f cY$`&ZA');
define('SECURE_AUTH_KEY',  'Y~y>{qH]=>9HiEZ@U;fm~b4.,HH[ yNce~BsG[P>bftb92boNQZ!oQxN|gQuOry+');
define('LOGGED_IN_KEY',    '+zYWu g}Xbp?CqqDUqbdj[I@kt0RO3sz<FV} 8]iScq}_vMLPVIl9tZ RTzQo=lg');
define('NONCE_KEY',        'RioWWz#LMG?s^ #wZ(A~ep<vZ|u?(#hXI. ?kd8(tR&RIl.U70aOgZ2 /{4(BdL]');
define('AUTH_SALT',        '=c@LDzc^Fsy 7*%8N,S^kn8kX<.;K:FkN_Nf7)y~Vy?mkdjv90.Qsgfx0Mf+;z0b');
define('SECURE_AUTH_SALT', '>>)W(R]4!-txR-Byx:NlHQ/dfe)Oh]B_4cLBNe8picPN:<CyRO2*ytw(FvySb83M');
define('LOGGED_IN_SALT',   'Jw/qT2fO<)rR]P7 l}Ar0$6}G*BLNlgHpbjVrp-Q..EwMSe&A$l])^5VlWzH=vZl');
define('NONCE_SALT',       '2I#(Mot^06HY~)=0_M~0Bdk.=3q&VT#/i5 X f6AN(sXr=Ac#U9D]<)^zDnO`4Xq');

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
