<?php

declare(strict_types=1);

namespace App\Exception;

use App\Exception;
use Throwable;

/**
 * Exception handler
 *
 * @author Shay Anderson
 *
 * #docs
 * #todo finish
 */
class Handler
{
	public function __construct(Throwable $th)
	{
		Exception::handle($th, function (array $info) use ($th)
		{
			$code = $th->getCode();

			if (!$code || $code > 599)
			{
				$code = 500;
			}

			// log error
			// ...

			// output message as error
			if (!DEBUG)
			{
				halt($code, $th->getMessage());
			}

			///////////////////////////////////////////////////////////////////////////////////////
			// debugging
			// set response code
			res()->code($code);

			// output exception
			echo '<pre>' . print_r($info, true) . '</pre>';

			// output trace string
			echo '<pre>' . $th->getTraceAsString() . '</pre>';

			// dump exception
			x($th);
		});
	}
}
