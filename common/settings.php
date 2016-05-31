<?PHP

/* Debug */
define ( 'DEBUG_ENABLED', true );

/* MySQL Database Connection */
define ( 'DB_USER','root' );
define ( 'DB_PASS','root' );
define ( 'DB_HOST','127.0.0.1' );
define ( 'DB_NAME','shibboleet' );

/* Default Page */
define ( 'PAGE_404','404' );

/* Other things here... */
define ( 'DIR_PLUGINS','common/plugins/' );
define ( 'DIR_PAGES','common/pages/' );
define ( 'DIR_RESOURCES','/common/resources/' );

/* System Settings */
define ( 'SL_NAME', 'Shibboleet' );
define ( 'SL_TITLE', 'Shibboleet' );

global $menu;
$menu = [
  'Home' => '/',
  'Settings' => '/?p=settings',
];
