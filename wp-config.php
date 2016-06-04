<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'U.Te;k,^YnFP`Qib|hD?>6A%;],[I+k=<$VFk:6hr9[lVEO[BddmvVx4O<H+L,_[');
define('SECURE_AUTH_KEY',  '|bk85`_Q7K$~mWzar#Cq[*g?(}u:3dEPV`mkR.pTTB~R+L8*}OWg BsDw|zHc>B>');
define('LOGGED_IN_KEY',    'iaxX~AdGMH.ZazM(1Y4w5z:UoNVF 6:.p#)~=|XQ>w?~5_3JqU8`<T[57+%XKSu(');
define('NONCE_KEY',        '>e<nv,2JD|/X)c|gz gpFJ14s9[s]-Z@;:Rp4U/,@zsnJAN5vf /6L}[u[?$$k;_');
define('AUTH_SALT',        '$B.@x3c6dFXz`n40],j$[oR=ub-% &*cd,By;ZjR,cD9dv)t3Yp%o(Y?Sc91-p`>');
define('SECURE_AUTH_SALT', 'faoQB2nN}ps Z!@_Y*dH57SVf9.Fy36@+Q/!8FjJwWzUCi)__k$XTl@=21(KZ n6');
define('LOGGED_IN_SALT',   'RS~%)P Lf(G+V*EOj[pN-Bkon,/7~iRrTPxB5p-.Z#$(p@:jh~N[?k][M=v~9((X');
define('NONCE_SALT',       '!lv}(+PqQrE<rY;dWqqMX_rtm+#2X-A]]q~H~a*`irXMZ6XW,HgUD}?eZD+2cV+^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
