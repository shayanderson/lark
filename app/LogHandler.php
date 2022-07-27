<?php

declare(strict_types=1);

namespace App;

use Lark\Logger;
use Lark\Logger\Record;

/**
 * Log handler
 */
class LogHandler extends \Lark\Logger\Handler
{
	/**
	 * Log
	 *
	 * @var array
	 */
	private array $log = [];

	/**
	 * Max records
	 *
	 * @var int
	 */
	private int $maxRecords;

	/**
	 * Init
	 *
	 * @param int $maxRecords
	 * @param int $level
	 * @param array $channelFilter
	 */
	public function __construct(
		int $maxRecords = 1000,
		int $level = Logger::LEVEL_DEBUG,
		array $channelFilter = null
	)
	{
		parent::__construct($level, $channelFilter);
		$this->maxRecords = $maxRecords;
	}

	/**
	 * Log getter
	 *
	 * @return array
	 */
	public function close()
	{
		return $this->log;
	}

	/**
	 * Write to log
	 *
	 * @param \Lark\Logger\Record $record
	 * @return void
	 */
	public function write(Record $record): void
	{
		if ($this->isHandling($record))
		{
			$this->log[] = $record;

			if (count($this->log) > $this->maxRecords) // limit records
			{
				array_shift($this->log);
			}
		}
	}
}
