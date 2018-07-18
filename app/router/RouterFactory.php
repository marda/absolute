<?php

namespace Absolute\Router;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

    // MODULE REST API ROUTE
    $router[] = new Route('api/<module>[/<presenter>][/<action>][/<urlId>]', array(
      'presenter' => 'Default',
      'action' => 'default',
    ));

		return $router;
	}
}
