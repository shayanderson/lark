<?php

declare(strict_types=1);

namespace App;

use Lark\Router;
use Lark\Router\RouteControllerInterface;

/**
 * Route controller
 */
class RouteController implements RouteControllerInterface
{
	/**
	 * Route model
	 *
	 * @var RouteModel
	 */
	private RouteModel $routeModel;

	/**
	 * Init
	 *
	 * @param RouteModel $routeModel
	 */
	public function __construct(RouteModel $routeModel)
	{
		$this->routeModel = $routeModel;
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
				return $this->routeModel->delete(
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
				return $this->routeModel->deleteDoc($id);
			})

			/**
			 * GET /[base-route]
			 *
			 * (fetch documents)
			 */
			->get('/', function (): array
			{
				return $this->routeModel->get();
			})

			/**
			 * GET /[base-route]/{id}
			 *
			 * (fetch single document)
			 */
			->get('/([0-9a-fA-F]{24})', function (string $id): array
			{
				return $this->routeModel->getDoc($id);
			})

			/**
			 * PATCH /[base-route]
			 *
			 * (update documents)
			 */
			->patch('/', function (): array
			{
				return $this->routeModel->patch(
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
				return $this->routeModel->patchDoc(
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
				return $this->routeModel->post(
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
				return $this->routeModel->postDoc(
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
				return $this->routeModel->put(
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
				return $this->routeModel->putDoc(
					$id,
					req()->jsonObject()
				);
			});
	}
}
