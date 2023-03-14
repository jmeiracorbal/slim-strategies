<?php

namespace Slim\Strategies\Interfaces\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ControllerInterface {

	public function __invoke(RequestInterface $request, ResponseInterface $response, array $args);

}