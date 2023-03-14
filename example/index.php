<?php

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require 'vendor/autoload.php';

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App();

class ControllerWelcome extends \Slim\Strategies\Controller {

	public function __invoke(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args)
	{
		$response->write("Welcome to Slim!");
		return $response;
	}

}

class ControllerWithArgument extends \Slim\Strategies\Controller {

	function __invoke(\Psr\Http\Message\RequestInterface $request, \Psr\Http\Message\ResponseInterface $response, array $args) {
		$response->write("Hello, " . $args['name']);
		return $response;
	}

}

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

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
$app->get('/', ControllerWelcome::class)
	->add(MockMiddleware::class);

$app->get('/hello[/{name}]', ControllerWithArgument::class)
	->setArgument('name', 'World!');

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();