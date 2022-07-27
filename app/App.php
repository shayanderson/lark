<?php

declare(strict_types=1);

namespace App;

/**
 * App
 */
class App extends \Lark\App
{
	#todo docs, implement
	use \Lark\App\Store;

	/**
	 * Log handler object
	 *
	 * @var LogHandler
	 */
	public LogHandler $logHandler;
}
