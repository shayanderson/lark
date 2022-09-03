<?php

declare(strict_types=1);

use App\LogHandler;
use Lark\Env;
use Lark\Logger;

/**
 * App bootstrap
 */

///////////////////////////////////////////////////////////////////////////////////////
// set directories
define('DIR_ROOT', dirname(__DIR__, 1));
const DIR_APP = __DIR__;
const DIR_MODELS = DIR_APP . '/Model';
const DIR_REVISIONS = DIR_ROOT . '/revisions';
const DIR_ROUTES = DIR_APP . '/routes';
const DIR_SCHEMAS = DIR_APP . '/schemas';
const DIR_TEMPLATES = DIR_ROOT . '/templates';

///////////////////////////////////////////////////////////////////////////////////////
// import autoloader
require_once DIR_ROOT . '/vendor/autoload.php';

///////////////////////////////////////////////////////////////////////////////////////
// import app helper functions
require_once DIR_APP . '/functions.php';

///////////////////////////////////////////////////////////////////////////////////////
// load .env file
Env::getInstance()->load(DIR_ROOT . '/.env');
// #todo change to: app()->use('env.load', DIR_ROOT . '/.env'); // without dir, auto root dir

///////////////////////////////////////////////////////////////////////////////////////
// app debug mode
const DEBUG = false;
const DEBUG_LOG = false;

///////////////////////////////////////////////////////////////////////////////////////
// init log handler
app()->logHandler = new LogHandler;
Logger::handler(app()->logHandler);

///////////////////////////////////////////////////////////////////////////////////////
// enable Lark debugging dump and logging #todo improve comment for debugger
// app()->use('debug.dump', true);
// app()->use('debug.log', true);

///////////////////////////////////////////////////////////////////////////////////////
// global database options
// app()->use('db.options', [
// 	'debug.dump' => true,
// 	'debug.log' => true,
// 	'find.limit' => 10_000
// ]);

///////////////////////////////////////////////////////////////////////////////////////
// database connections
app()->use('db.connection.default', [
	'hosts' => ['192.168.2.107'],
	'username' => env('DB_USER'),
	'password' => env('DB_PASSWORD'),
	'options' => [
		'debug.dump' => false,
		'debug.log' => false
	]
]);

///////////////////////////////////////////////////////////////////////////////////////
// store sessions in database
// app()->use('db.session', new App\Model\Session);
