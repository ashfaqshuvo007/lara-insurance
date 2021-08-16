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
define( 'DB_NAME', 'admin_sigblog' );

/** MySQL database username */
define( 'DB_USER', 'admin_sigblog' );

/** MySQL database password */
define( 'DB_PASSWORD', 'DcrxscloQ5' );

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
define( 'AUTH_KEY',         '}J:oqX7U% l>IG4x%ca8+I:VQ(H_ec+Y[.N|3o03:R?j6*Az*%=8}^.a%o7g;A8@' );
define( 'SECURE_AUTH_KEY',  '{JA<j`cx(f-Z)gN<-%4;0Gc^!lb1=)|,YL3?%j>m1}.01:Tr(d9fm;TrqCQMQ1ar' );
define( 'LOGGED_IN_KEY',    '<*c:&jt{?ib 5rKe|/vy}yI+e#@:la/^k[ZrB}b_UHAx+//*,T;~pS@BKD:6T>%9' );
define( 'NONCE_KEY',        'KDgGS#5O9c=!5FXTz,JwX/zMFnSbWjvP$A}C+ aYA@CyclIkNN6$n1~H1=o,_85;' );
define( 'AUTH_SALT',        '5_.4roPqPUPcf@oMl?fX=1~PkZiSZ,VU=,=obHB^={Nt?;qGHVJ&ry&Lp~N)Yo:(' );
define( 'SECURE_AUTH_SALT', '4.q~0m1BwUBQ8Y^Z?p9 tRROzhb#O7&$:.Rm=6S>Jts3zkh,{Uc0#RPrnb#/hr4u' );
define( 'LOGGED_IN_SALT',   'Z+a0x!xRG0>TiIvv1!~]v6x[dWta] qQ7ii#{`~iHiD:M$ wBlXNbnl~,]UC#k(-' );
define( 'NONCE_SALT',       'tvoOz ,NGU!N]GOV:U_6O4r&CpO^Xg[V[Un75v[?bQNu!0;Q(IqgfmF#Q5tLDk|5' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sig_';

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
