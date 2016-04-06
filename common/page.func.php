<?PHP
namespace shibboleet\page;

function get_requested ()
{
    $pages_allowed = array(
        'user'
    );

    if ( isset ( $_GET['p'] ) )
    {
        if ( in_array ( $_GET['p'] , $pages_allowed ) )
        {
            return $_GET['p'];
        }
        else
        {
            return 404;
        }
    }
    else
    {
        return "index";
    }
}
