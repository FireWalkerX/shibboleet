<?PHP
session_start ();
include('common/template.func.php');
include('common/logon.func.php');

if ( version_compare ( phpversion (), '5.6', '<' ) )
{
    die ( 'PHP out of date - please use version 5.6 or higher' );
}

/* Connect to database  */
$db = new mysqli ( DB_HOST, DB_USER, DB_PASS, DB_NAME );
if ( $db->connect_error )
{
    die ( 'Connect Error (' . $db->connect_errno . ') ' . $db->connect_error );
}

/* validate login */
shibboleet\logon\validate() or exit(shibboleet\logon\login()) ;

if ( isset ( $_GET['p'] ) ) switch ( $_GET['p'] )
{
    case "user": $page = "user/user_index.php"; break;
    default: $page = "404";
}
else
    $page = "index";

$plugin_file = DIR_PLUGINS . $page;
if ( file_exists ( $plugin_file ) )
{
    shibboleet\template\__template("header");
    require_once ( $plugin_file );
    shibboleet\template\__template("footer");
}
?>
