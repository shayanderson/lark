<?php

declare(strict_types=1);

namespace App\Exception;

/**
 * Route not found (HTTP 404) exception
 */
class RouteNotFoundException extends \Lark\Exception
{
	/**
	 * @inheritDoc
	 */
	protected $code = 404;
}
