<?php

declare(strict_types=1);

#todo finish


try
{
	require_once dirname(__DIR__, 1) . '/app/bootstrap.php';

	app()->run();
}
catch (Throwable $th)
{
	new App\Exception\Handler($th);
}
