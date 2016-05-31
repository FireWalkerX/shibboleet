<?PHP \shibboleet\plugin\set_dependencies( 'template', 'user' ) ?>
<?PHP
if (
  isset ( $_POST['name'] )
  && isset ( $_POST['email'] )
) \shibboleet\plugin\user\update_user (
  $_GET['id'],
  array
  (
    'name' => $_POST['name'],
    'email' => $_POST['email'],
  )
);
?>

<?PHP $user = \shibboleet\plugin\user\get_user ( ['id','username','name','email','enabled','token'], $_GET['id'] )?>
<form method="post">
<p>ID: <?=$user['id']?></p>
<p>Username: <?=$user['username']?></p>
<p>Name: <input type="text" name="name" value="<?=$user['name']?>" /></p>
<p>E-mail: <input type="text" name="email" value="<?=$user['email']?>" /></p>
<p>Enabled: <?=( $user['enabled'] == 1 ? "Yes" : "No" )?></p>
<p>Been logged in: <?=( empty ( $user['token'] ) ? "No" : "Yes" )?></p>
<button type="submit">Update userdata</button>
</form>
