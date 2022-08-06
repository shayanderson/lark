<?php

declare(strict_types=1);

use Lark\Filter;
use Lark\Validator;

/**
 * App helper functions
 */

/**
 * Filter helper
 *
 * @return Filter
 */
function filter(): Filter
{
	return Filter::getInstance();
}

/**
 * Check if CLI
 *
 * @return boolean
 */
function is_cli(): bool
{
	return PHP_SAPI === 'cli';
}

/**
 * Validator helper
 *
 * @param array|object $data
 * @param array|\Lark\Schema $schema
 * @param int $flags
 * @return Validator
 */
function validate($data, $schema, int $entityFlags = 0): Validator
{
	return new Validator($data, $schema, $entityFlags);
}
