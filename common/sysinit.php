<?PHP
session_start ();

/* Verify PHP version */
if ( version_compare ( phpversion (), '5.6', '<' ) )
  die ( 'PHP out of date - please use version 5.6 or higher.' );

/* Files to include before starting system */
foreach(array (
  'settings',
  'plugin.func',
  'logon.func',
  'database.func',
  'page.func',
) as $file) { include ( "common/$file.php" ); }

/* Connect to database */
\shibboleet\db\connect ();

/* Validate login */
\shibboleet\logon\validate () or exit ( \shibboleet\logon\loginForm () );

/* Load Requested Page */
$page = \shibboleet\page\get_page ();
if ( $page != false )
  include ( $page );
?>
