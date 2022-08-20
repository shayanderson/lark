<?php

declare(strict_types=1);

namespace App\Model;

use App\Model;
use Lark\Schema;

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
	 * Schema getter
	 *
	 * @return Schema
	 */
	public static function schema(): Schema
	{
		return new Schema(
			require DIR_SCHEMAS . '/sessions.php'
		);
	}
}
