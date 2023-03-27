<?php
namespace App\Router;

use Psr\Http\Server\MiddlewareInterface;

class Route
{
	private $method;
	private $path;
	private $handler;
	private $middlewares = [];
	
	public function __construct($method, $path, $handler)
	{
		$this->method = $method;
		$this->path = $path;
		$this->handler = $handler;
	}
	
	public function addMiddleware(MiddlewareInterface $middleware)
	{
		$this->middlewares[] = $middleware;
	}
	
	public function handle($request, $response)
	{
		foreach ($this->middlewares as $middleware) {
			$request = $middleware->process($request);
		}
		
		call_user_func($this->handler, $request, $response);
	}
	
	public function match($method, $path)
	{
		return $this->method == $method && $this->path == $path;
	}
}
