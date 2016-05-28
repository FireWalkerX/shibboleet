<?PHP
namespace shibboleet\logon;

function validate ()
{
  global $db;

  /* User table - used to install table upon first run */
  $users_table = "CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(240) NOT NULL,
    `password` varchar(240) NOT NULL,
    `enabled` int(1) NOT NULL,
    `token` varchar(240) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;";

  /* Install table if it dosen't exists. */
  \shibboleet\db\create_table_if_not_exists('users',$users_table) or die("Couldn't create table 'users'.");

  /* Check for logout request
  *  Using a post till i figgure out how to omit a stupid "bug" in Safari. */
  if ( isset ( $_POST['signout'] ) )
  {
    destroySession ();
    header( 'Location: /' );
    return false;
  }

  /* Check if session token is set */
  $genToken = false;
  if ( isset ( $_SESSION['token'] ) )
  {
    $token = $_SESSION['token'];
    $query = "select token from `users` where `token`='$token' and `enabled`='1' limit 1";
  }
  else
  {
    /* No token is set, check if _POST was performed, then try logon */
    if ( isset ( $_POST['username'] ) && isset ( $_POST['password'] ) )
    {
      $username = $db->real_escape_string( $_POST['username'] );
      $password = $db->real_escape_string( md5 ( $_POST['password'] ) );
      $query = "select id from `users` where `username`='$username' and `password`='$password' and `enabled`='1' limit 1;";
      $genToken = true;
    }
    else $query = false;
  }

  // Run query from above, and update token
  if($query != false)
  {
    $result = $db->query ( $query );
    if ( $result->num_rows > 0 )
    {
      if ( $genToken == true )
      {
        $id = $result->fetch_assoc(); $id = $id['id'];
        $token = $db->real_escape_string ( base64_encode ( openssl_random_pseudo_bytes ( 30 ) ) );
        $_SESSION['token'] = $token;
        $db->query ( "update `users` set `token`='$token' where `id`='$id';" );
        header( 'Location: /' );
      }
      return true;
    }
    else
    {
      destroySession ();
    }
  }
  return false;
}

function destroySession()
{
  error_log("Session Destroyed", 0);
  unset ( $_SESSION );
  session_destroy ();
}

function logoutButton ( $text='Signout' )
{
  return '<form method="post"><button type="submit" name="signout">' . $text . '</button></form>';
}

function loginForm()
{
  $out  = '<!DOCTYPE html>';
  $out .= '<html>';
  $out .= '<head>';
  $out .= '<meta charset="UTF-8">';
  $out .= '<title>Shibboleet!</title>';
  $out .= '</head>';
  $out .= '<body>';
  $out .= '<p>Authentication required</p>';
  $out .= '<form method="post">';
  $out .= '<input type="text" name="username" value="jobbe" /><br />';
  $out .= '<input type="password" name="password" value="hunter2" /><br />';
  $out .= '<button type="submit">Login</button>';
  $out .= '</form>';
  $out .= '</body>';
  $out .= '</html>';
  return $out;
}
