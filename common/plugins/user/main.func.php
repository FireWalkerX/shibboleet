<?PHP
namespace shibboleet\plugin\user;

function __plugin_init ()
{
  /* Stop executing if table is missing */
  if ( !\shibboleet\db\table_exists ( 'users' ) ) die ( 0 );
}

function get_users ()
{
  global $db;
  /* Get all tables */
  $user = false;
  $result = $db->query( "select * from users;" );
  if ( $result->num_rows > 0 )
    while ( $row = $result->fetch_assoc () )
      foreach($row as $id => $data)
        $user[$row['id']][$id] = $data;
  return $user;
}

function get_user ( $id = false )
{
  if ( $id == false ) return false;
  global $db;
  /* Get all tables */
  $row = false;
  $id = $db->real_escape_string ( $id );
  $result = $db->query( "select * from users where ID = '$id';" );
  if ( $result->num_rows > 0 )
    $row = $result->fetch_assoc ();
  return $row;
}
