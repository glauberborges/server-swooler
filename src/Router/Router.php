<?php

namespace  App\Router;

use Psr\Http\Server\MiddlewareInterface;

class Router
{
	private $routes = [];
	
	public function addRoute($method, $path, $handler)
	{
		$route = new Route($method, $path, $handler);
		$this->routes[] = $route;
		return $route;
	}
	
	public function addMiddlewareToRoute($route, MiddlewareInterface $middleware)
	{
		$route->addMiddleware($middleware);
	}
	
	public function handle($request, $response)
	{
		foreach ($this->routes as $route) {
			if ($route->match($request->server['request_method'], $request->server['path_info'])) {
				$route->handle($request, $response);
				return;
			}
		}
		
		$response->status(404);
		$response->end();
	}
}
