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
define('DB_NAME', 'wpframework');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '+yLqNWfv2zy]:}GQ:L4VC(0![NiyoOU?jFikipj=eZ}rOx;n5mAt0uG(BtOpaZk:');
define('SECURE_AUTH_KEY',  ',-w|cgonn3Rbp5OlV^^PE,uD/-?i6U>d3Wr,j-D{Ct%(x,]B-b|9u$,+H[x6*DZ~');
define('LOGGED_IN_KEY',    '[twve=qlZ*Le8,:-P]W76nq.(uKW53]H]pG,>Q;1Sl04I96]Z-h,iYP.E -NhD+G');
define('NONCE_KEY',        '-G(SiREI,s~?GbAe* -%+%f<(c~xw(| {=W>VVb_2|<bR[/Er:.RUK%$%|JRnM+d');
define('AUTH_SALT',        'XU44*{>urk.|Xm]9H#WNg<ec2}*?6(Yl]Us}s6|mMP@`l.oA?iK%-,|fYS Rw>UJ');
define('SECURE_AUTH_SALT', 'st+W>|%`8<W4 r7+AgXPv{^{Etg4iE!<E*$6Wt>$Jk:,8+bm6P09.twVVP@e#;cn');
define('LOGGED_IN_SALT',   '3@<[04}Ip4E+x_YmY&^DM&~lm-p|1Br,IQF,2rbx d@X$_^mMa=l+t}F(^Jq)_?Z');
define('NONCE_SALT',       'F{>#jHXa~).RZ`B5hrbq`D[YQ$QWhzI$Mqq:6du9.$;<AG.Lf] `_`/{;4ubzEHi');

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
