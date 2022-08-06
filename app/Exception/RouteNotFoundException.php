<?php

declare(strict_types=1);

namespace App\Exception;

use App\Exception;

/**
 * Route not found (HTTP 404) exception
 */
class RouteNotFoundException extends Exception
{
	/**
	 * @inheritDoc
	 */
	protected $code = 404;
}
