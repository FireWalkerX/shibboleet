<?php \shibboleet\plugin\set_dependencies ( 'template' )?>
<?=\shibboleet\plugin\template\get_header ( 'Login Required', false )?>


<p>Authentication required</p>
<form method="post">
<input type="text" name="username" value="jobbe" /><br />
<input type="password" name="password" value="hunter2" /><br />
<button type="submit">Login</button>
</form>

<?=\shibboleet\plugin\template\get_footer ()?>
