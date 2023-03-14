<?php

namespace Slim\Strategies;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Router;
use Slim\Strategies\Interfaces\Http\ControllerInterface;

abstract class Controller implements ControllerInterface {

	/**
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * Access to Slim Router extracted from container
	 * @var Router
	 */
	protected $router;

	public function __construct($container = []) {
		$this->container = $container;
		// el router siempre viene dado en Slim a través del contenedor
		$this->router    = $this->container->get('router');
	}

	// inheritance with abstract method makes a forced implementation
	abstract function __invoke(RequestInterface $request, ResponseInterface $response, array $args);

}