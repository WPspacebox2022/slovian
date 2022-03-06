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
define( 'DB_NAME', 'slovianworld' );

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
define( 'AUTH_KEY',         'BW_Cy@6|2MS  %N3zW-fgK:d{ .>&dz:T[ZLMAxzOm@0KJW)qDycrwlTw 2d{~M=' );
define( 'SECURE_AUTH_KEY',  '0f?-_Z4EhX(nG3=%FM4D< Y/?w]&.pQ7d9x`u1*BmW>vwW%4Le-/;QwS#`U;&2K)' );
define( 'LOGGED_IN_KEY',    '0O|2oe4i-iWxP_]Jo]V,8j@V`8eOxFE5`a<>j67K_jKxTs l5}W4SmUywc[>Upr~' );
define( 'NONCE_KEY',        'kdKEaJ[/+|y)RLjMjQ$nK:b ou&A4VG%50ad:ms(0PqI_w36O6bA|=<!MI9k1=f2' );
define( 'AUTH_SALT',        'zo~:8W)VdMs!xS=m.rKrJ>Y;3[bb:9*EAs.OPV*+]M^;VAN(v$D/l80SiQ+Z:`<Q' );
define( 'SECURE_AUTH_SALT', 'PZGMuUwWcgtm}p[kFn!VUQR$G+CHJi*W-a>:mDY<8@.tBR?tiGF~t[/[QzUX;;Vl' );
define( 'LOGGED_IN_SALT',   'B1ItRN*;/),lw|eRlu03e@Y_Jk)dCL[r4GBGw=nSz$bSbs;z#?OphKh;jqsACp]a' );
define( 'NONCE_SALT',       'com)XijJwa:shTAD!X(KY++=px[*6$Yx8LAEv|RWTU?${!$&a#f/e9-Vk%D~%Xm3' );

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
