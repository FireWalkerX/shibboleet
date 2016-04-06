<?PHP
namespace shibboleet\db;

/* Database Connect */
function connect ()
{
    global $db;
    $db = new \mysqli ( DB_HOST, DB_USER, DB_PASS, DB_NAME );
    if ( $db->connect_error )
    {
        die ( 'Connect Error (' . $db->connect_errno . ') ' . $db->connect_error );
    }
}

/* Check if table exists */
function table_exists ( $table )
{
    global $db;
    $result = $db->query ( "show tables like '$table';" );
    if ( $result->num_rows > 0 ) return true;
    else return false;
}

/* Create table if not exists */
function create_table_if_not_exists ( $table , $query )
{
    global $db;
    if ( !table_exists ( $table ) )
	{
        if ( $db->query ( $query ) ) return true;
	}
	else 
	{
		return true;
	}
    return false;
}
