<?php

declare(strict_types=1);

use Lark\Filter;
use Lark\Json\Decoder as JsonDecoder;
use Lark\Validator;

/**
 * App helper functions
 *
 * @author Shay Anderson
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
 * Decode JSON string
 *
 * @param string $json
 * @param boolean|null $associative
 * @param integer $depth
 * @param integer $flags
 * @return mixed
 * @throws Lark\Exception On JSON decode error
 */
function json_decoder(string $json, ?bool $associative = null, int $depth = 512, int $flags = 0)
{
	return JsonDecoder::decode($json, $associative, $depth, $flags);
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
