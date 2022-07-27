<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

/**
 * Exception handler
 *
 * #docs
 * #todo finish
 */
class Handler
{
	public function __construct(Throwable $th)
	{
		\Lark\Exception::handle($th, function (array $info) use ($th)
		{
			$code = $th->getCode();

			if (!$code || $code > 599)
			{
				$code = 500;
			}

			// log error
			// ...

			#todo if not debug strip $info[source]

			pa('<h5><pre>' . print_r($info, true) . '</pre></h5>');

			#todo improve
			if (DEBUG)
			{
				x();
			}

			// respond with error
			#todo uncomment:
			// app()->response()
			// 	->code($code)
			// 	->json($info);
		});
	}
}
