<?php

namespace Slim\Strategies;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Router;
use Slim\Strategies\Interfaces\Http\MiddlewareInterface;

abstract class Middleware implements MiddlewareInterface {

	/**
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * @var Router
	 */
	protected $router;

	public function __construct($container = []) {
		$this->container = $container;

		// el router siempre viene dado por Slim a través del contenedor
		$this->router    = $this->container->get('router');

	}

	// inheritance with abstract method makes a forced implementation
	abstract function __invoke(RequestInterface $request, ResponseInterface $response, callable $next);

}