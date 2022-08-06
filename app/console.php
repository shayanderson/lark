<?php

declare(strict_types=1);

use App\Exception as AppException;

/**
 * CLI app
 * #docs
 */

$isDebug = false;

try
{
	require_once './bootstrap.php';

	/** @var \Lark\Cli $cli */
	$cli = Lark\Cli::getInstance();
	$out = $cli->output();

	// global options
	$cli->option('-d, --debug', 'Enable debug mode', function () use ($isDebug)
	{
		$isDebug = true;
	});

	// help command
	$cli->command('help', 'Display help')
		->arg('command', 'Command name', ['optional'])
		->action(function ($command = null) use ($cli)
		{
			$command ? $cli->helpCommand($command) : $cli->help();
		});

	// run CLI app
	$cli->run($_SERVER['argv']);
}
catch (Throwable $th)
{
	#todo mv to app ex handler
	AppException::handle($th, function (array $info) use ($cli, $isDebug, $th)
	{
		if (!$cli)
		{
			throw $th;
		}

		$cli->output()->error($th->getMessage());

		if ($isDebug)
		{
			$cli->output()->echo(
				print_r($info, true)
			);
		}

		$cli->exit(
			$th->getCode() ? $th->getCode() : 1
		);
	});
}
