<?PHP
namespace shibboleet\plugin;

function load_plugin() { 

    echo plugin_requested ();

    if(plugin_requested ())
        if(require_once ( plugin_requested () ))
           \shibboleet\plugin\sub\__plugin_init ();

}

function plugin_requested() {
        if ( file_exists ( DIR_PLUGINS . \shibboleet\page\get_requested ( ) ) )
            return DIR_PLUGINS . \shibboleet\page\get_requested () . '/main.func.php';
        else
            return false;
}
