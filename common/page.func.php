<?PHP
namespace shibboleet\page;

function get_page_request ()
{
  if ( isset (  $_GET['p'] ) ) $request = $_GET['p'];
  elseif ( isset ( $_POST['p'] ) ) $request = $_POST['p'];
  else $request = PAGE_DEFAULT;
  return $request;
}

function get_page_file ( )
{
  // Define files to check
  $pages = array (
    'requested' => DIR_PAGES . get_page_request () . ".php",
    '404'       => DIR_PAGES . PAGE_404 . ".php",
    'default'   => DIR_PAGES . PAGE_DEFAULT . ".php"
  );
  // Try files, return path if exists
  foreach ( $pages as $page => $file) {
    if ( file_exists ( $file ) )
      return $file ;
  }
  // No luck, return false
  return false;
}

function get_page_file ()
{
  return get_page_path ();
}
