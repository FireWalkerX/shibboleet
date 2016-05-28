<?PHP \shibboleet\plugin\set_dependencies( 'index', 'user' ) ?>

<pre>
<?php
foreach ( \shibboleet\plugin\user\get_users () as $id => $data)
{
  print_r ($data);
}
?></pre>

<a href="/?p=home">home</a>
<br />
<br />
