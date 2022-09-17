<?php

declare(strict_types=1);

namespace App\Model;

use App\Model;

/**
 * Session model
 *
 * @author Shay Anderson
 */
class Session extends Model
{
	/**
	 * Database string
	 */
	const DBS = 'default$app$sessions';

	/**
	 * Schema file
	 */
	const SCHEMA = 'sessions.php';
}
