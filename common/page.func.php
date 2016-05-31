<?PHP
namespace shibboleet\page;

function get_page_request ( $type = 'p' )
{
  if ( isset ( $_GET[$type] ) ) $request = $_GET[$type];
  elseif ( isset ( $_POST[$type] ) ) $request = $_POST[$type];
  else $request = PAGE_DEFAULT;
  return $request;
}

function get_page_file ( $subpage )
{
  // Define files to check
  $pages = array (
    'requested' => DIR_PAGES . get_page_request () . ".php",
    '404'       => DIR_PAGES . PAGE_404 . ".php",
    'default'   => DIR_PAGES . PAGE_DEFAULT . ".php"
  );

  if ( $subpage == true )
    $pages['requested'] = DIR_PAGES . get_page_request ('s') . ".php";

  // Try files, return path if exists
  foreach ( $pages as $page => $file) {
    if ( file_exists ( $file ) )
      return $file ;
  }
  // No luck, return false
  return false;
}

function get_page ( $subpage=false )
{
  return get_page_file ( $subpage );
}
