<?php

declare(strict_types=1);

use App\Exception\RouteNotFoundException;

/**
 * App HTTP routes
 */

///////////////////////////////////////////////////////////////////////////////////////
// middleware
// router()->bind();
// router()->matched();
// router()->after();

///////////////////////////////////////////////////////////////////////////////////////
// routes load file (used for auto creating routes)
router()->load(require DIR_ROUTES . '/_load.php');

///////////////////////////////////////////////////////////////////////////////////////
// routes

/**
 * GET /
 */
router()->get('/', function (): string
{
	return '<h1>Lark is ready.</h1>';
});

///////////////////////////////////////////////////////////////////////////////////////
// route not found handler
router()->notFound(function ($method, $path)
{
	throw new RouteNotFoundException('Route not found', [
		'method' => $method,
		'path' => $path
	]);
});
