<?php

declare(strict_types=1);

namespace App\Exception;

use App\Exception;
use Lark\Debugger;
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
			$isDebug = defined('DEBUG') && DEBUG;
			$code = $th->getCode();

			if (!$code || $code > 599)
			{
				$code = 500;
			}

			// add more exception info
			if ($isDebug)
			{
				$info['file'] = $th->getFile();
				$info['line'] = $th->getLine();

				if ($th instanceof \Lark\Exception)
				{
					$info['context'] = $th->getContext();
				}
			}

			// log errors except 404
			if ($code !== 404)
			{
				logger()->error($th->getMessage(), $info);
			}

			// output message as error
			if (!$isDebug)
			{
				halt($code, $th->getMessage());
			}

			///////////////////////////////////////////////////////////////////////////////////////
			// debugging
			// set response code
			res()->code($code);

			// do not debug dump
			if (!req()->query('debug')->has())
			{
				halt($code, $info);
			}

			// output exception
			echo '<pre>' . print_r($info, true) . '</pre>';

			// output trace string
			echo '<pre>' . $th->getTraceAsString() . '</pre>';

			// dump
			Debugger::append();
			Debugger::dump(false);

			// output log
			echo '<pre>' . print_r(app()->logHandler->close(), true) . '</pre>';
		});
	}
}
