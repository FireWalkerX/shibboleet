<?PHP
namespace shibboleet\logon;

function install ()
{
  /* Install table if it dosen't exists. */
  \shibboleet\db\create_table_if_not_exists('users',"CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(240) NOT NULL,
    `password` varchar(240) NOT NULL,
    `enabled` int(1) NOT NULL,
    `token` varchar(240) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;") or die("Couldn't create table 'users'.");
}

function validate ()
{
  global $db;

  install ();

  if ( signout () )
  {
    return false;
  }
  elseif ( validateToken () )
  {
    return true;
  }
  elseif ( validateLogin () )
  {
    return true;
  }
  return false;
}

function validateToken()
{
  if ( isset ( $_SESSION['token'] ) )
  {
    global $db;
    $token = $db->real_escape_string ( $_SESSION['token'] );
    $result = $db->query ( "select token from `users` where `token`='$token' and `enabled`='1' limit 1" );
    if ( $result->num_rows > 0 )
      return true;
    else destroySession ();
    unset ( $result );
  }
  return false;
}

function validateLogin()
{
  if ( isset ( $_POST['username'] ) && isset ( $_POST['password'] ) )
  {
    global $db;
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
        generateToken ( $id );
        return true;
      }
      else
      {
        \shibboleet\debug\log ( "Failed login attempt." );
        destroySession ();
      }
    }
    else destroySession ();
  }
  return false;
}

function generateToken ( $id )
{
  global $db;
  $token = $db->real_escape_string ( base64_encode ( openssl_random_pseudo_bytes ( 30 ) ) );
  $_SESSION['token'] = $token;
  $db->query ( "update `users` set `token`='$token' where `id`='$id';" );
  header( 'Location: /' );
}

function signout()
{
  /* Check for logout request
  *  Using a post till i figgure out how to omit a stupid "bug" in Safari. */
  if ( isset ( $_POST['signout'] ) )
  {
    destroySession ();
    header( 'Location: /' );
    return true;
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
  $page = DIR_PAGES . "login.php";
  if ( $page != false )
    include ( $page );
}
