<?php

/**
 * Schema file for "sessions"
 */

return [
	'$index' => ['access' => 1, '$name' => 'idxAccess'],
	'_id' => ['string', 'id'],
	'data' => null,
	'access' => ['dbdatetime', 'notNull']
];
