<?PHP
session_start ();

/* Files to include before starting system */
foreach(array (
    'settings',
    'plugin.func',
    'logon.func',
    'database.func',
    'page.func',
) as $file) { include ( "common/$file.php" ); }

/* Verify PHP version */
if ( version_compare ( phpversion (), '5.6', '<' ) )
    die ( 'PHP out of date - please use version 5.6 or higher.' );

/* Connect to database */
\shibboleet\db\connect ();

/* Validate login */
\shibboleet\logon\validate () or exit ( \shibboleet\logon\loginForm () );

/* Load Required plugin */
\shibboleet\plugin\load_plugin ();
?>
