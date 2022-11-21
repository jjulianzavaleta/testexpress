<?php

define( 'WP_CACHE', false );

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

define( 'DB_NAME', "exampledb" );

define('FS_METHOD', 'direct');


/** MySQL database username */

define( 'DB_USER', "exampleuser" );


/** MySQL database password */

define( 'DB_PASSWORD', "examplepass" );


/** MySQL hostname */

define( 'DB_HOST', "mariadb" );


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

define( 'AUTH_KEY',         'ry1J!`!gNHK[c+U52I CE-`+1va`%.sD~U88;zG=A{9X%_H`dbH7u|ab2eT-Z:H^' );

define( 'SECURE_AUTH_KEY',  'gOd2:hZ,lH(&`f`WffRuU@E)46E|EVv79t&tv<9ip*1:Uqxa}]Iyd:@s/=@WQ2HI' );

define( 'LOGGED_IN_KEY',    'p{> 0f=Ro9sTbI~<(F~Ru%8sw7[9w-&sI%VbSAe]>8IE^jU6aX(Gj;xu-+d|0O<5' );

define( 'NONCE_KEY',        'dMqPJ`Dx8=8B!/)D|UsH7U:GXo=<a1hnHU1>]_ztGX`p>,[!A;-}-6)5[V>=L]^w' );

define( 'AUTH_SALT',        '+|9F}s}BbQ[P2s/Z!-GqDXkKO#xXR*)(f0?A-X>J6w$9e/<,J[-jBs:aViYXquL1' );

define( 'SECURE_AUTH_SALT', 'O)-,NOl9UqO4vC`no_&G0}^RW`] $UDw#PX/Od_U7S_$[*(!h$!4f8~w)|2B+oUl' );

define( 'LOGGED_IN_SALT',   'ebS9*>X7@DDqhKguK;n+&]qP4apD%WYK.ftG:4P(%n`R[!O@0OzaxY18J~j`drwS' );

define( 'NONCE_SALT',       'd)Z;k~owr^8Uu{LO[X6qsM=eB A~rgvR=]>R5SLdz{Z}W>aMW#Of}0ZwBZiWgyM]' );


/**#@-*/

define( 'WP_MEMORY_LIMIT', '512M' );

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

define( 'WP_DEBUG', true );

define( 'AUTOMATIC_UPDATER_DISABLED', true );

define( 'WP_AUTO_UPDATE_CORE', false );

/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once( ABSPATH . 'wp-settings.php' );


// define ('WP_ALLOW_REPAIR', 'true');


define('DISALLOW_FILE_EDIT', false);
define('DISALLOW_FILE_MODS', false);
