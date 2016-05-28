<?PHP
namespace shibboleet\plugin;

function set_dependencies ( )
{
  $dependencies = func_get_args ();
  foreach ($dependencies as $key => $value) {
    load_plugin ( $value );
  }
}

function load_plugin ( $plugin ) {
  $file = DIR_PLUGINS . $plugin  . "/main.func.php";
  if( file_exists ( $file ) )
  {
    require_once ( $file );
    call_user_func( '\shibboleet\plugin\\' . $plugin . '\__plugin_init' );
  }
  else
    \shibboleet\debug\log ( "Illegal plugin ($plugin), not leading." );
}
