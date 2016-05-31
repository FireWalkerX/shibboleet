<?php
namespace shibboleet\core;

function arr_str ( $data , $implode = ',' )
{
  if ( is_array ( $data ) )

    if ( count ( $data ) > 0 )
      return implode ( $implode, $data );

    else
      return current ( $data );

  else
    return $data;
}
