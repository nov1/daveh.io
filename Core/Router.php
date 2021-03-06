<?

/**
 * Router
 */

class Router
{
protected $routes = [];
protected $params = [];




public function add($route, $params = [])
{
	// Convert the route to a regular expression: escape forward slashes
	$route = preg_replace('/\//', '\\/', $route);
	// Convert variables e.g. {controller}
	$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
	// Convert variables with custom regular expressions e.g. {id:\d+}
	$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
	// Add start and end delimiters, and case insensitive flag
	$route = '/^' . $route . '$/i';
	$this->routes[$route] = $params;
}


public function getRoutes()
{
	return $this->routes;
}

public function match($url)
{
    foreach ($this->routes as $route => $params) {
        if (preg_match($route, $url, $matches)) {
            // Get named capture group values
            foreach ($matches as $key => $match) {
                if (is_string($key)) {
                    $params[$key] = $match;
                }
            }
            $this->params = $params;
            return true;
        }
    }
    return false;
}

public function getParams()
{
	return $this->params;
}



}

?>