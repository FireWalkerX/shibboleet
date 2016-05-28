<?php
namespace shibboleet\debug;

function log( $string )
{
  if ( DEBUG_ENABLED )
  {
    openlog("appLog", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    syslog(LOG_DEBUG, $string);
    closelog();
  }
}

function errorlog( $string )
{
  return error_log( $string, 0 );
}
 ?>
