<?PHP
namespace shibboleet

function load_plugin() { require_once ( plugin_requested () ); }

function plugin_requested() {
        if ( file_exists ( plugin_requested () ) )
            return DIR_PLUGINS . get_requested();
}

function get_requested()
{
        if ( isset ( $_GET['p'] ) ) switch ( $_GET['p'] ) {
        
            case "user": return "user/user_index.php"; break;
            default: return "404";
        
        } else
            return "index";
}

?>
