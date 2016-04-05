<?PHP
namespace shibboleet\logon;

function validate ()
{
    global $db;

    $genToken = false;
    if ( isset ( $_SESSION['token'] ) )
    {
        $token = $_SESSION['token'];
        $query = "select token from `users` where `token`='$token' limit 1"; 
    }
    else
    {
        $username = $db->real_escape_string($_POST['username']);
        $password = $db->real_escape_string(md5($_POST['password']));
        $query = "select id from `users` where `username`='$username' and `password`='$password' limit 1;";
        $genToken = true;
    }

	// Validate logon, and/or set token
    $result = $db->query ( $query );
    if ( $result->num_rows > 0 )
    {
        if ( $genToken == true )
        {
			$id = $result->fetch_assoc(); $id = $id['id'];
            $token = $db->real_escape_string ( base64_encode ( openssl_random_pseudo_bytes ( 30 ) ) );
            $_SESSION['token'] = $token; 
            $db->query ( "update `users` set `token`='$token' where `id`='$id';" );
        }
        
        return true;
    }
	else
	{
		unset ( $_SESSION );
		session_destroy();
	}
    return false;
}

function login()
{
	$out  = '<!DOCTYPE html>';
	$out .= '<html>';
	$out .= '<head>';
	$out .= '<meta charset="UTF-8">';
	$out .= '<title>Title of the document</title>';
	$out .= '</head>';
	$out .= '<body>';
	$out .= '<p>Authentication required</p>';
	$out .= '<form method="post">';
	$out .= '<input type="text" name="username" value="jobbe" /><br />';
	$out .= '<input type="password" name="password" value="hunter2" /><br />';
	$out .= '<input type="submit" name="login" />';
	$out .= '</form>';
	$out .= '</body>';
	$out .= '</html>';
	return $out;
}
