<?PHP
namespace shibboleet\plugin\user;

function __plugin_init ()
{
    /* Stop executing if table is missing */
    if ( !\shibboleet\db\table_exists ( 'users' ) ) die ( 0 );
}

function get_users ()
{
    global $db;
    /* Get all tables */
    $result = $db->query( "select * from users;" );
    if ( $result->num_rows > 0 )
        while ( $row = $result->fetch_assoc () )
            foreach($row as $id => $data)
                $user[$row['id']][$id] = $data;

    if ( count ( $user ) == 1 ) return reset($user);
    else return $user;
}
