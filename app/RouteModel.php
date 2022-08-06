<?php

declare(strict_types=1);

namespace App;

use stdClass;

/**
 * Route model
 */
class RouteModel
{
	/**
	 * Model object
	 *
	 * @var Model
	 */
	private Model $model;

	/**
	 * Init
	 *
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Delete documents
	 *
	 * @param array $ids
	 * @return array{affected: int}
	 */
	public function delete(array $ids): array
	{
		return [
			'affected' => $this->model->db()->deleteIds($ids)
		];
	}

	/**
	 * Delete single document
	 *
	 * @param string $id
	 * @return array{affected: int}
	 */
	public function deleteDoc(string $id): array
	{
		if (!$this->model->db()->hasIds([$id]))
		{
			return self::resourceNotFound();
		}

		return [
			'affected' => $this->model->db()->deleteIds([$id])
		];
	}

	/**
	 * Fetch documents
	 *
	 * @return array
	 */
	public function get(): array
	{
		return $this->model->db()->find();
	}

	/**
	 * Fetch single document
	 *
	 * @param string $id
	 * @return array
	 */
	public function getDoc(string $id): array
	{
		return $this->model->db()->findId($id) ?? self::resourceNotFound();
	}

	/**
	 * Model object getter
	 *
	 * @return Model
	 */
	public function model(): Model
	{
		return $this->model;
	}

	/**
	 * Update documents
	 *
	 * @param array $docs
	 * @return array
	 */
	public function patch(array $docs): array
	{
		return $this->model->db()->findIds(
			$this->model->db()->updateBulk($docs)
		);
	}

	/**
	 * Update single document
	 *
	 * @param string $id
	 * @param stdClass $doc
	 * @return array
	 */
	public function patchDoc(string $id, stdClass $doc): array
	{
		return $this->model->db()->updateId($id, $doc) ?? self::resourceNotFound();
	}

	/**
	 * Create documents
	 *
	 * @param array $docs
	 * @return array
	 */
	public function post(array $docs): array
	{
		return $this->model->db()->findIds(
			$this->model->db()->insert($docs)
		);
	}

	/**
	 * Create single document
	 *
	 * @param stdClass $doc
	 * @return array
	 */
	public function postDoc(stdClass $doc): array
	{
		return $this->model->db()->findId(
			$this->model->db()->insertOne($doc)
		);
	}

	/**
	 * Replace documents
	 *
	 * @param array $docs
	 * @return array
	 */
	public function put(array $docs): array
	{
		return $this->model->db()->findIds(
			$this->model->db()->replaceBulk($docs)
		);
	}

	/**
	 * Replace single document
	 *
	 * @param string $id
	 * @param stdClass $doc
	 * @return array
	 */
	public function putDoc(string $id, stdClass $doc): array
	{
		return $this->model->db()->replaceId($id, $doc) ?? self::resourceNotFound();
	}

	/**
	 * Resource not found
	 *
	 * @return array{message: string}
	 */
	private static function resourceNotFound(): array
	{
		res()->code(404);
		return ['message' => 'Resource not found'];
	}
}
