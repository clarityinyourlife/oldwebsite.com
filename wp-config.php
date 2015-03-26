<?php
// ** MySQL settings ** //
define('DB_NAME', 'clarityi_lskA8');    // The name of the database
define('DB_USER', 'clarityi_679m8');     // Your MySQL username
define('DB_PASSWORD', 'Mr9MsBzfCSw5'); // ...and password
define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Change SECRET_KEY to a unique phrase.  You won't have to remember it later,
// so make it long and complicated.  You can visit https://www.grc.com/passwords.htm
// to get a phrase generated for you, or just make something up.
define('AUTH_KEY',         '+?5@wCU0fnz`)!Nlp:Womv},Z|1zSD7|yIW]>;=@wB+|HMeUX$PwxpjRVoe5$b#&');
define('SECURE_AUTH_KEY',  'k|jX[GOZ<E<Zq<U y2-Vxwti`$+,^N?c Hqqr,1<|^F>H~HNg,>Y^|sIWxpph;6Z');
define('LOGGED_IN_KEY',    'M7Lwch25qhbqDE0f(9V#s(k=}ZS:Q|L4H1~MUGOk6XXZ=IRZO7(26&O^h?TF29:D');
define('NONCE_KEY',        'w$Lg,C4swX8pvi/XoXbGV;P9i(H7:8whOE95K~xHZ+OO.Sn XwBUKC4@}y5g-:pI');
define('AUTH_SALT',        'vIuMzd,S`&`y~?dl=V5ey;8x]-n%~lYa)X)zCYeZY!n--IVkW_TnG!nS=5wi=OS_');
define('SECURE_AUTH_SALT', 'e_?NakX.VZ@q,uA^a;}tJ^0,7/RRQ.AnSCt5h8^nMkK-&BWYveZems22>mn>iCG_');
define('LOGGED_IN_SALT',   '-<]Wb0E&I2`<uu*|r,4T>+Y6gUZY,C|Yw_O;(yhLsA_&Q)MMU5<>^ J1lfDDGhX`');
define('NONCE_SALT',       'u#IYq+9U()]r+,>7irq[bsS<]AQ{5eHC[{%/o1g3CE<1@d`GxV+b!,-8,E]:x7s*');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
?>
