<?php

declare(strict_types=1);

/**
 * App HTTP routes
 */

//////////////////////////////////////////////////////////////////////////////////////////
// middleware
// router()->bind();
// router()->matched();

// after middleware (optional)
router()->after(function ()
{
	// output log
	// pa(str_repeat('<br/>', 5), '<b>Log:</b>');
	// pa(app()->logHandler->close());

	if (DEBUG)
	{
		x();
	}
});

//////////////////////////////////////////////////////////////////////////////////////////
// routes load file (used for auto creating routes)
router()->load(require DIR_ROUTES . '/_load.php');

//////////////////////////////////////////////////////////////////////////////////////////
// routes

/**
 * GET /
 */
router()->get('/', function (): string
{
	return '<h1>Lark is ready.</h1>';
});

//////////////////////////////////////////////////////////////////////////////////////////
// route not found handler
router()->notFound(function ($method, $path)
{
	throw new App\Exception\RouteNotFoundException('Route not found', [
		'method' => $method,
		'path' => $path
	]);
});
