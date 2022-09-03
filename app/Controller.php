<?php

declare(strict_types=1);

namespace App;

use App\Exception\ResourceNotFoundException;
use Lark\HookableTrait;
use Lark\Router;
use Lark\Router\RouteControllerInterface;
use stdClass;

/**
 * Route controller
 *
 * @author Shay Anderson
 */
class Controller implements RouteControllerInterface
{
	use HookableTrait;

	/**
	 * Model
	 *
	 * @var Model
	 */
	protected Model $model;

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
	 * @inheritDoc
	 */
	public function bind(Router $router): void
	{
		$router
			/**
			 * DELETE /[base-route]
			 *
			 * (delete documents)
			 */
			->delete('/', function (): array
			{
				return $this->delete(
					req()->jsonArray()
				);
			})

			/**
			 * DELETE /[base-route]/{id}
			 *
			 * (delete single document)
			 */
			->delete('/([0-9a-fA-F]{24})', function (string $id): array
			{
				return $this->deleteDoc($id);
			})

			/**
			 * GET /[base-route]
			 *
			 * (fetch documents)
			 */
			->get('/', function (): array
			{
				return $this->get();
			})

			/**
			 * GET /[base-route]/{id}
			 *
			 * (fetch single document)
			 */
			->get('/([0-9a-fA-F]{24})', function (string $id): array
			{
				return $this->getDoc($id);
			})

			/**
			 * PATCH /[base-route]
			 *
			 * (update documents)
			 */
			->patch('/', function (): array
			{
				return $this->patch(
					req()->jsonArray()
				);
			})

			/**
			 * PATCH /[base-route]/{id}
			 *
			 * (update single document)
			 */
			->patch('/([0-9a-fA-F]{24})', function (string $id): array
			{
				return $this->patchDoc(
					$id,
					req()->jsonObject()
				);
			})

			/**
			 * POST /[base-route]
			 *
			 * (create documents)
			 */
			->post('/', function (): array
			{
				return $this->post(
					req()->jsonArray()
				);
			})

			/**
			 * POST /[base-route]/_doc
			 *
			 * (create single document)
			 */
			->post('/_doc', function (): array
			{
				return $this->postDoc(
					req()->jsonObject()
				);
			})

			/**
			 * PUT /[base-route]
			 *
			 * (replace documents)
			 */
			->put('/', function (): array
			{
				return $this->put(
					req()->jsonArray()
				);
			})

			/**
			 * PUT /[base-route]/{id}
			 *
			 * (replace single document)
			 */
			->put('/([0-9a-fA-F]{24})', function (string $id): array
			{
				return $this->putDoc(
					$id,
					req()->jsonObject()
				);
			});
	}

	/**
	 * Delete documents
	 *
	 * @param array $ids
	 * @return array{affected: int}
	 */
	public function delete(array $ids): array
	{
		$this->hook(__FUNCTION__, $ids);

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
		$this->hook(__FUNCTION__, $id);

		if (!$this->model->db()->hasIds([$id]))
		{
			throw new ResourceNotFoundException;
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
		$this->hook(__FUNCTION__);

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
		$this->hook(__FUNCTION__, $id);

		return $this->model->db()->findId($id) ?? throw new ResourceNotFoundException;
	}

	/**
	 * Update documents
	 *
	 * @param array $docs
	 * @return array
	 */
	public function patch(array $docs): array
	{
		$this->hook(__FUNCTION__, $docs);

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
		$this->hook(__FUNCTION__, $id, $doc);

		return $this->model->db()->updateId($id, $doc) ?? throw new ResourceNotFoundException;
	}

	/**
	 * Create documents
	 *
	 * @param array $docs
	 * @return array
	 */
	public function post(array $docs): array
	{
		$this->hook(__FUNCTION__, $docs);

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
		$this->hook(__FUNCTION__, $doc);

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
		$this->hook(__FUNCTION__, $docs);

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
		$this->hook(__FUNCTION__, $id, $doc);

		return $this->model->db()->replaceId($id, $doc) ?? throw new ResourceNotFoundException;
	}
}
