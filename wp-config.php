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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'monhernandez' );

/** MySQL database username */
define( 'DB_USER', 'test' );

/** MySQL database password */
define( 'DB_PASSWORD', 'test' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'OQY;%v@nEbWU_!(O1eCpoxZwf|#I(x?^LiHWp,(poq96775ydkwFZeq?<)D,GF=q' );
define( 'SECURE_AUTH_KEY',  'YMb>FoHaQXT*U}[*WZX$<=]Gh|%n9qrwpG>6=2+ox?.j^Nq9:->88*5<<<eEUx?&' );
define( 'LOGGED_IN_KEY',    'Otq{Mh(bGy4#m[FfBdN5L@)c!M;s!O51jEoH7>Q6fh~w+?3jT`eP(%2jm2.%3p&J' );
define( 'NONCE_KEY',        'n3>TP@|>%L:pofyp`Md#j/,cvh:Yf3$ nQoj)^}C]}rH5UL^~NH/mKGVO1G~(o()' );
define( 'AUTH_SALT',        'jbPTxN%w,$Eizhm=<Wu}<hB6*Y|/Vu34z,;h9YQl+TF BNXPX{3& Z%0QJHTbBJ~' );
define( 'SECURE_AUTH_SALT', ';63bdajVQC#z9}|Ir^Hh+[uRN_~8%Q20q] KipYC&I~3,wvS4~X<CWlhHU6VueNL' );
define( 'LOGGED_IN_SALT',   '6YvB{|oZ|~=#wA)|t8~I^#UhE<;is?xvD[V$:tn<{r~^ag53zM?/M=;# v.xblM$' );
define( 'NONCE_SALT',       ':#Vt,_ox}%sPM6-h+S@{*8ACUsO8h/!7b(u1gVAh;O#Z4u;qP4i/4VvCV<<#V~m.' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
