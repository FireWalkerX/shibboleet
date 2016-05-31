<?PHP
namespace shibboleet\page;

function get_page_request ( $type = 'p' )
{
  if ( isset ( $_GET[$type] ) ) $request = $_GET[$type];
  elseif ( isset ( $_POST[$type] ) ) $request = $_POST[$type];
  else $request = false;
  return $request;
}

function get_page_file ( $subpage )
{
  // Define files to check
  $pages = [
    'requested' => DIR_PAGES . get_page_request () . "/index.php",
    'fallback'  => DIR_PAGES . get_page_request () . ".php",
    '404'       => DIR_PAGES . PAGE_404 . ".php",
  ];

  if ( $subpage == true )
  {
    $pages['requested'] = DIR_PAGES . get_page_request ('p') . '/' . get_page_request ('s') . ".php";
    if ( !isset ( $_GET['s'] ) )
      $pages['fallback'] = DIR_PAGES . get_page_request ('p') . "/home.php";
    /* We really don't want the user to request index, this will create an infinite loop, instead be nice
     * to the user, and give them the home file instead. */
    if($_GET['s'] == 'index')
      $pages['requested'] = DIR_PAGES . get_page_request ('p') . "/home.php";
  }

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
