<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'samplero_wp708' );

/** Database username */
define( 'DB_USER', 'samplero_wp708' );

/** Database password */
define( 'DB_PASSWORD', '1SUm93pm@]' );

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
define( 'AUTH_KEY',         'dpu1q7dsspfw7xw7ryjzqytngonuqc4s8kjjltapedxwtnwftweelsod92nfl2ga' );
define( 'SECURE_AUTH_KEY',  'phbcr5z2fobqincka8t296cbm1wo9uqnbhpa3yi9zajpjghc07pvb5xhsa4ropco' );
define( 'LOGGED_IN_KEY',    't7siyfbhnwcud4v14lrijrqswif2rihaf5ekcwo6kjbpowauic3q7kqapdcrdbtv' );
define( 'NONCE_KEY',        'ossmknwrqidr31ylwflaleisziukywzm0nyezovgizzlvvvmc1tce2tjpowpx3s3' );
define( 'AUTH_SALT',        'iy6yvp5yoyszfzgptgv1wc24rutdumfzjav49iqdqe9tlhva1anjffobvlerlnfe' );
define( 'SECURE_AUTH_SALT', 'cefmagp6ah2nmumtuhapfgeuyhprlm4ddr8thlrubrqbl85qtlmgmlej9d8zivfo' );
define( 'LOGGED_IN_SALT',   'mmbw3rtwkhtqubqsbekqwod1srmnuzhkl6e0gilkrrokqcx1kmayiekehejyx30r' );
define( 'NONCE_SALT',       'p4xrr4zrdvvfop1vble3avqhtwcebllirlerwicsysnpm7lpk4yzca8jt1lyiy92' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpog_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
