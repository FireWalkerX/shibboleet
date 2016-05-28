<?php
namespace shibboleet\debug;

function log( $string )
{
  return error_log( $string, 0 );
}
 ?>
