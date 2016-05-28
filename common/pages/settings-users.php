<?PHP \shibboleet\plugin\set_dependencies( 'template', 'user' ) ?>
<?=\shibboleet\plugin\template\get_header ( 'Users :: Settings' , true , true )?>

<h2>Users</h2>
  <ul>
    <li>List users</li>
    <li>List users</li>
    <li>List users</li>
    <li>List users</li>
  </ul>

<?=\shibboleet\plugin\template\sidebar_to_body ()?>

<table width="100%">
  <tr class="header">
    <td class='right' width="5%"># id</td>
    <td>Username</td>
    <td>Name</td>
    <td>E-mal</td>
    <td>Active</td>
  </tr>
<?php
foreach ( \shibboleet\plugin\user\get_users () as $id => $data)
{
  echo "<tr>";
  echo "<td class='right'>" . $data['id'] . "</td>";
  echo "<td>" . $data['username'] . "</td>";
  echo "<td>" . $data['name'] . "</td>";
  echo "<td>" . $data['email'] . "</td>";
  echo "<td>" . ( $data['enabled'] == 1 ? "yes" : "no" ) . "</td>";
  echo "</tr>";
}
?>
</table>

<?=\shibboleet\plugin\template\get_footer ()?>
