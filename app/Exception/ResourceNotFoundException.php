<?php
#version$
declare(strict_types=1);

namespace App\Exception;

use App\Exception;

/**
 * Resource not found exception
 *
 * @author Shay Anderson
 * #docs
 */
class ResourceNotFoundException extends Exception
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
		string $message = 'Resource not found',
		array $context = null,
		int $code = 0,
		\Throwable $previous = null
	)
	{
		parent::__construct($message, $context, $code, $previous);
	}
}
