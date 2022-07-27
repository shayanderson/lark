# Lark

Lark is a modern, lightweight app framework designed specifically for developing REST APIs.

## Installation

Create project directory and move to the project directory:
```
mkdir myapp
cd myapp
```

Install using composer:
```
composer create-project lark/app ./
```
Then, initialize project:
```
php lark --init
```

## Console
Lark Console is available to assist in creating routes, schemas and models. Lark Console can be run from the project root directory.
```
lark route items
```
Namespaces can also be used.
```
lark route api/items
```

## Middleware
Create middleware files in the `app/Middleware` directory.

Example middleware class:
```php
namespace App\Middleware;
use Lark\Request;
use Lark\Response;

class UserMiddleware
{
	public function auth(Request $req, Response $res): void
	{
		// auth here
	}
}
```
For this example, the middleware can be setup in `app/routes.php` like:
```php
router()->matched([App\Middleware\UserMiddleware::class, "auth"]);
```

> Read the [framework docs](https://github.com/shayanderson/lark-framework#middleware) on middleware.

## App Class
#todo docs about app class props + methods

## MVC Application
Lark can use controllers that are common in MVC applications. Create controller files in the `app/Controller` directory and extend the base `App\Controller` class.

Example base controller class `app/Controller.php`:
```php
namespace App;
use Lark\Response;

abstract class Controller
{
	protected Response $res;

	public function __construct()
	{
		$this->res = app()->response();
	}
}
```
Example controller class `app/Controller/ItemsController.php`:
```php
namespace App\Controller;
use App\Model\Item as ItemModel;

class ItemsController extends \App\Controller
{
    private ItemModel $model;

	public function __construct()
	{
		$this->model = new ItemModel;
	}

	public function get(): void
	{
		$this->res->json(
			$this->model->find()
		);
	}
}
```
For this example, a route can be setup in `app/routes.php` like:
```php
router()->get("/items", [App\Controller\ItemsController::class, "get"]);
```

> Read the [framework docs](https://github.com/shayanderson/lark-framework#route-actions) on route actions.

## Custom Validation Rules
Custom validation rules should be created in the `app/Validator` directory like `app/Validator/MyRule.php`.

> Read the [framework docs](https://github.com/shayanderson/lark-framework#custom-validation-rule) on custom validation rules.

