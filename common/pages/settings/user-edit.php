<?PHP \shibboleet\plugin\set_dependencies( 'template', 'user' ) ?>
<?PHP $user = \shibboleet\plugin\user\get_user ( $_GET['id'] )?>

<p>ID: <?=$user['id']?></p>
<p>Username: <input type="text" value="<?=$user['username']?>" /></p>
<p>Name: <input type="text" value="<?=$user['name']?>" /></p>
<p>E-mail: <input type="text" value="<?=$user['email']?>" /></p>
<p>Enabled: <?=( $user['enabled'] == 1 ? "Yes" : "No" )?></p>
<p>Been logged in: <?=( empty ( $user['token'] ) ? "No" : "Yes" )?></p>




<br />
<br />
<br />
<br />
<br />
<pre><?php print_r ( $user ); ?></pre>
