<?php

define( 'ITSEC_ENCRYPTION_KEY', 'Jl84KnBQQkEtaSE+THJ3VHt6LWt9IG1CNmlVOjdiNEteelR0TmF6akRXI2w8e3xWbE58aiVYVnRJeXIwSEYrZQ==' );

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
define( 'DB_NAME', 'bitnami_wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'july' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1:3308' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'b09c219b51af1e47c799981336f39f4dfb924e90fb4cf22368e5012241dda205');
define('SECURE_AUTH_KEY',  '7cf6eee1a1fdc9adee375ea9c281c49050a0b21d8c49888db42937d64afa625d');
define('LOGGED_IN_KEY',    '2c9ed75bd4fb12d1fbff8b86522eeed75ff753b79af5724946d5a51fc9fc399b');
define('NONCE_KEY',        '14f423bf7a7f36f8e42eaf8a9f8ce881a9f7bb56c0f4f39e799a7fd969dc06a8');
define('AUTH_SALT',        '619d0fa267c11fb0ecdc4f3a5bc339e99a4d9579ff63d55340143d0c04b603f0');
define('SECURE_AUTH_SALT', '8ac49bfed9e37235cd2da9678854bb67afd91afacbbbb6590fbe4c2f070b1107');
define('LOGGED_IN_SALT',   'cf32ff623321cb7445bd20bd059819842a50f287102c2988b9df03c5d203c289');
define('NONCE_SALT',       '8e00366777241c2cfa4b1e27a150f37df1ea460c1f66f26aba4b5f5ea066f491');

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
// define( 'MULTISITE', true );
// define( 'SUBDOMAIN_INSTALL', false );
// define( 'DOMAIN_CURRENT_SITE', '127.0.0.1' );
// define( 'PATH_CURRENT_SITE', '/wordpress/' );
// define( 'SITE_ID_CURRENT_SITE', 1 );
// define( 'BLOG_ID_CURRENT_SITE', 1 );

/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

if ( defined( 'WP_CLI' ) ) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');


/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**define('WP_TEMP_DIR', 'C:\Bitnami\wordpress-6.0.1-0\common\bin/apps/wordpress/tmp'); **/

define('WP_TEMP_DIR', ABSPATH . 'wp-content/');

//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/

if ( !defined( 'WP_CLI' ) ) {
    // remove x-pingback HTTP header
    add_filter('wp_headers', function($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
    // disable pingbacks
    add_filter( 'xmlrpc_methods', function( $methods ) {
            unset( $methods['pingback.ping'] );
            return $methods;
    });
    add_filter( 'auto_update_translation', '__return_false' );
}