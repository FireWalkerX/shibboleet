<?PHP
namespace shibboleet\plugin\index;

function __plugin_init ()
{
  echo "<p>Hello World!</p>";
}

function dice_roll ()
{
  echo rand(1,6);
}
