<?

/**
 * Front contoller
 */


// echo "Requested URL = ". $_SERVER['QUERY_STRING'];


/**
 * Routing
 */

require '../Core/Router.php';

$router = new Router();

// echo get_class($router);

//add the routes
// $router->add('', ['contoller' => 'Home', 'action' => 'index']);
// $router->add('posts', ['contoller' => 'Posts', 'action' => 'index']);
// $router->add('posts/new', ['contoller' => 'Posts', 'action' => 'new']);
$router->add('{contoller}/{action}');
$router->add('{contoller}/{id:\d+}/{action}');

//Display the routing table
// echo '<pre>';
// var_dump($router->getRoutes());
// echo '</pre>';



//Match the requested route
$url = $_SERVER['QUERY_STRING'];
if ($router->match($url)) {
	echo '<pre>';
	var_dump($router->getParams());
	var_dump($router->getRoutes());
	echo '</pre>';
}else{
	echo "No route found for URL '$url'";
}
?>