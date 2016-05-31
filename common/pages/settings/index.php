<?PHP \shibboleet\plugin\set_dependencies( 'template', 'user' ) ?>
<?=\shibboleet\plugin\template\get_header (
  ( isset ( $_GET['s'] ) ? ucfirst ( $_GET['s'] ) . ' :: ' : '' ) . 'Settings' , true , true )?>

<h3>Settings</h3>

<div class="sidebarMenu">
<ul>
  <li><a href="/?p=settings">General</a></li>
  <li><a href="/?p=settings&s=users">Users</a></li>
</ul>
</div>

<?=\shibboleet\plugin\template\sidebar_to_body ()?>

<?PHP include (\shibboleet\page\get_page ( true ))?>

<?=\shibboleet\plugin\template\get_footer ()?>
