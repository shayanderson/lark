<?php

declare(strict_types=1);

use Lark\Schema;

$schema = new Schema(array(
	'$index' =>
	(object) array(
		'access' => 1,
		'$name' => 'idxAccess',
	),
	'_id' =>
	array(
		0 => 'string',
		1 => 'id',
	),
	'data' => NULL,
	'access' =>
	array(
		0 => 'dbdatetime',
		1 => 'notNull',
	),
));

/**
 * Revision
 *
 * @id 20220000000000000$default$app$sessions$create
 */
return function (App\Model\Session $model) use ($schema): ?bool
{
	return $model->db()->create($schema);
};
