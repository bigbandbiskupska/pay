<?php

namespace App;

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
		$defaults = [
			'vs' => null,
			'ks' => null,
			'ss' => null,
			'message' => '',
		];

		$router[] = new Route('[vs/<vs \d+>/][ks/<ks \d+>/][ss/<ss \d+>/][<amount \d+>/][<message>]', 'Pay:all', $defaults);
		$router[] = new Route('[vs/<vs \d+>/][ss/<ss \d+>/][ks/<ks \d+>/][<amount \d+>/][<message>]', 'Pay:all', $defaults);
		$router[] = new Route('[ss/<ss \d+>/][vs/<vs \d+>/][ks/<ks \d+>/][<amount \d+>/][<message>]', 'Pay:all', $defaults);
		$router[] = new Route('[ss/<ss \d+>/][ks/<ks \d+>/][vs/<vs \d+>/][<amount \d+>/][<message>]', 'Pay:all', $defaults);
		$router[] = new Route('[ks/<ks \d+>/][vs/<vs \d+>/][ss/<ss \d+>/][<amount \d+>/][<message>]', 'Pay:all', $defaults);
		$router[] = new Route('[ks/<ks \d+>/][ss/<ss \d+>/][vs/<vs \d+>/][<amount \d+>/][<message>]', 'Pay:all', $defaults);

		return $router;
	}
}