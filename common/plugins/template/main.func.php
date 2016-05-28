<?PHP
namespace shibboleet\plugin\template;

function __plugin_init ()
{
}

function get_header ( $title )
{
  $header  = "<!DOCTYPE html>";
  $header .= "<html>";
  $header .= "<head>";
  $header .= '<meta charset="UTF-8">';
  $header .= "<title>$title :: Shibboleet</title>";
  $header .= '<link href="' . DIR_RESOURCES . 'style.css" rel="stylesheet" type="text/css" />';
  $header .= "</head>";
  $header .= "<body>";
  $header .= '<div id="wrapper">test';
  return $header;
}


function get_footer ()
{
  $footer  = '</div>';
  $footer .= '</body>';
  $footer .= '</html>';
}
