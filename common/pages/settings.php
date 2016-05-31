<?PHP \shibboleet\plugin\set_dependencies( 'template', 'user' ) ?>
<?=\shibboleet\plugin\template\get_header ( 'General :: Settings' , true , true )?>

<h3>Settings</h3>

<div class="sidebarMenu">
<ul>
  <li><a href="/?p=settings&s=users">Users</a></li>
</ul>
</div>

<?=\shibboleet\plugin\template\sidebar_to_body ()?>

<?=\shibboleet\page\get_subpage ()?>

<?=\shibboleet\plugin\template\get_footer ()?>
