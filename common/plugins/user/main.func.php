<?PHP
namespace shibboleet\plugin\user;

function __plugin_init ()
{
  /* Stop executing if table is missing */
  if ( !\shibboleet\db\table_exists ( 'users' ) ) die ( 0 );
}

function get_user ( $columns = false, $id = false )
{
  global $db;

  $id = \shibboleet\core\arr_str ( $id, " or id = " );
  $columns = \shibboleet\core\arr_str ( $columns );

  if ( $id != false )
  {
    $id = $db->real_escape_string ( $id );
    $id = "where id = '$id'";
  }
  /* Get all tables */
  $row = false;
  $result = $db->query( "select $columns from `users` $id;" );

  if ( $result->num_rows > 0 )
    while ( $row = $result->fetch_assoc () )
      foreach($row as $id => $data)
        $user[$row['id']][$id] = $data;


  if ( count ( $user ) > 1)
    return $user;
  else
    return current ( $user );
}

function update_user ( $id, $data )
{
  global $db;

  $id = $db->real_escape_string ( $id );
  foreach ( $data as $column => $value )
    $update_string[] = $db->real_escape_string ( $column ) . " = '" . $db->real_escape_string ( $value ) . "'";
  $update_string = implode ( $update_string, ',' );
  $query = "update `users` set $update_string where id = '$id'";
  $db->query( $query );
  return true;
}
