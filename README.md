# Slim strategies

Actions to implement in a Slim project based in `Contracts`.

Example middleware:

```php
class MockMiddleware extends \Slim\Strategies\Middleware {

	public function __construct($container = [])
	{
		parent::__construct($container);
	}

	public function __invoke(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response, callable $next)
	{
		$response = $response->write('Hello from middleware');

		return $next($request, $response);
	}

}
```

Example controller:

```php
class ControllerWelcome extends \Slim\Strategies\Controller {

	public function __invoke(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args)
	{
		$response->write("Welcome to Slim!");
		return $response;
	}

}
```