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
define( 'DB_NAME', 'db_xsportasia' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '<bM8x.<SUqM?` ~kRE8{V/D(*cwh=CgUh(t5xYZQ9&^`ATCNYA_J7}qOZkGjPcUq' );
define( 'SECURE_AUTH_KEY',  'j!-[,IaxuHejT7auD w0h6?ux^p=wZ *`:knVrpUM!ib?QIm`?Gnu*q2%@-%H->2' );
define( 'LOGGED_IN_KEY',    '[PX3%%!rEo>E7*#}`Cku1)Yg)(.Q-sqV0VCNivE2 4|t^wgF_.!WNRtELK<0#/X6' );
define( 'NONCE_KEY',        'T97xqvd   fOa8byfPoI;98:tP_ocnm=TR?&OZ=RkYu{P_AUN1e1(Vf8a^iCL~|&' );
define( 'AUTH_SALT',        'Ds3{T=L? H@Ic|v(f*Rf^bYI;R[IQ<+E_gbA!/h/n0bO>V(=2I!]C+M%$Wb2dvR;' );
define( 'SECURE_AUTH_SALT', 'hX^JS}unGNM{vhu&3?P@x,Ev.hQgKvsYOsHJJzfOFpmtXR~o 2dw&wS2t#pi?=i]' );
define( 'LOGGED_IN_SALT',   'adkX,VT00<[ksvz2hY3|5rU#N7]9$SlUpX6[s7.UD1plz[2]@$b+quA>[_#aF.>4' );
define( 'NONCE_SALT',       '4vU}_s(+n&BjS/TpxIm0u_*qs`ccg&GsUS/HNvyHul5/u4X=R^<XNsV8$FU.]s3S' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
