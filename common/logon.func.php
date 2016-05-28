<?PHP
namespace shibboleet\logon;

function validate ()
{
  global $db;

  /* Install table if it dosen't exists. */
  \shibboleet\db\create_table_if_not_exists('users',"CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(240) NOT NULL,
    `password` varchar(240) NOT NULL,
    `enabled` int(1) NOT NULL,
    `token` varchar(240) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;") or die("Couldn't create table 'users'.");

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
    $token = $db->real_escape_string ( $_SESSION['token'] );
    $result = $db->query ( "select token from `users` where `token`='$token' and `enabled`='1' limit 1" );
    if ( $result->num_rows > 0 )
      return true;
    else destroySession ();
    unset ( $result );
  }
  elseif ( isset ( $_POST['username'] ) && isset ( $_POST['password'] ) )
    {
      $username = $db->real_escape_string ( $_POST['username'] );
      $result = $db->query ( "select id,password from `users` where `username`='$username' and `enabled`='1' limit 1;" );
      if ( $result->num_rows > 0 )
      {
        $row = $result->fetch_assoc ();
        unset ( $result );
        $id = $row['id'];
        $hash = $row['password'];
        unset ( $row );
        if ( password_verify ( $_POST['password'], $hash ) )
        {
          $genToken = true;
        }
        else
        {
          \shibboleet\debug\log ( "Failed login attempt." );
          destroySession ();
        }
      }
      else destroySession ();
    }

  if ( $genToken == true )
  {
    $token = $db->real_escape_string ( base64_encode ( openssl_random_pseudo_bytes ( 30 ) ) );
    $_SESSION['token'] = $token;
    $db->query ( "update `users` set `token`='$token' where `id`='$id';" );
    header( 'Location: /' );
  }
  return false;
}

function destroySession()
{
  \shibboleet\debug\log( "Session Destroyed" );
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
