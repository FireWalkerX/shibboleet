<?PHP
namespace shibboleet\page;

function get_page_request ()
{
  if ( isset (  $_GET['p'] ) ) $request = $_GET['p'];
  elseif ( isset ( $_POST['p'] ) ) $request = $_POST['p'];
  else $request = PAGE_DEFAULT;
  return $request;
}

function page_exist_or_default ( )
{
  $page = DIR_PAGES . get_page_request () . ".php";
  $default = DIR_PAGES . PAGE_DEFAULT . ".php";
  if ( file_exists ( $page ) )
    return $page;
  elseif ( file_exists ( $default ) )
    return $default;
  else
    return false;
}

function get_page ()
{
  return page_exist_or_default ();
}
