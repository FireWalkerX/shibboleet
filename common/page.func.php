<?PHP
namespace shibboleet\page;

/* user request -> page exists -> check dependencies -> load dependencies -> load page -> display page */

function load_page() { 
    if(plugin_requested ())
        if(require_once ( plugin_requested () ))
           \shibboleet\plugin\sub\__plugin_init ();
}

function page_requested() {
        if ( file_exists ( DIR_PLUGINS . \shibboleet\page\get_requested ( ) ) )
            return DIR_PLUGINS . \shibboleet\page\get_requested () . '/main.func.php';
        else
            return false;
}
