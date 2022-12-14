<?php

declare(strict_types=1);

namespace App\Exception;

use App\Exception;

/**
 * Route not found (HTTP 404) exception
 *
 * @author Shay Anderson
 */
class RouteNotFoundException extends Exception
{
	/**
	 * @inheritDoc
	 */
	protected $code = 404;

	/**
	 * Init
	 *
	 * @param string $message
	 * @param array|null $context
	 * @param integer $code
	 * @param \Throwable|null $previous
	 */
	public function __construct(
		string $message = 'Route not found',
		array $context = null,
		int $code = 0,
		\Throwable $previous = null
	)
	{
		parent::__construct($message, $context, $code, $previous);
	}
}
