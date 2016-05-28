<?PHP \shibboleet\plugin\set_dependencies( 'template', 'user' ) ?>
<?=\shibboleet\plugin\template\get_header ( 'Users :: Settings' )?>

<pre>
<?php
foreach ( \shibboleet\plugin\user\get_users () as $id => $data)
{
  print_r ($data);
}
?></pre>

<?=\shibboleet\plugin\template\get_footer ()?>
