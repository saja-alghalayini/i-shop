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
define( 'DB_NAME', 'ishop' );

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
define( 'AUTH_KEY',         'V2U%3l>m>xilbcI;Zh3<I~A1pBFBLL!79%m|9WgZ2r3nX5y- ^R pJV?5s@]s #?' );
define( 'SECURE_AUTH_KEY',  'b` 4DU^+V%_<K]/ jQ%lZeKL,bwC3Y;|_NWxk> :0{~VQ>q,~Bb9d*b1CqNMk&8j' );
define( 'LOGGED_IN_KEY',    '?7K4BuZL#(cR1I9 YcP(I!/~)P5KW?ej<hb#_T?H2pWMJu|QXEiAN)3X!vu0FJdH' );
define( 'NONCE_KEY',        '0^mg)fX(l1P)w;#|Z?j.(n2S.<itVi;VU 0.73swze#ki6veTma~>*0[6vJ%Wm;r' );
define( 'AUTH_SALT',        '-a.T 6kj@ a8v0-*@vH}O GYSP^19) O)l QSB$~-GVBt=a~5LWP&T`Q^xMG,]BG' );
define( 'SECURE_AUTH_SALT', ';RsN3Hb167Fu2xz0_=B;WWPowC5dMG,2N,$D[@JQC}*0fnr #47!cK^4 IM}H>{f' );
define( 'LOGGED_IN_SALT',   '?#&/U{UA:P-/h?(?QxlH[1vY @M{C,{&(P_  &iZ1q&8yH+LR6ncE}TZ~]2R{^%e' );
define( 'NONCE_SALT',       't`cY]V:t@ c61gBQigtPkts,W~c9f8_$_~DH8kB52YE#6isvq~m{Lwviq&U*)8oI' );

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
