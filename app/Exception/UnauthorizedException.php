<?php
#version$
declare(strict_types=1);

namespace App\Exception;

use App\Exception;

/**
 * Unauthorized (HTTP 401) exception
 *
 * @author Shay Anderson
 */
class UnauthorizedException extends Exception
{
	/**
	 * @inheritDoc
	 */
	protected $code = 401;

	/**
	 * Init
	 *
	 * @param string $message
	 * @param array|null $context
	 * @param integer $code
	 * @param \Throwable|null $previous
	 */
	public function __construct(
		string $message = 'Permission denied',
		array $context = null,
		int $code = 0,
		\Throwable $previous = null
	)
	{
		parent::__construct($message, $context, $code, $previous);
	}
}
