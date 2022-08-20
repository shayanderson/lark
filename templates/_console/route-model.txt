<?php

declare(strict_types=1);

use App\Controller;

/**
 * Route file for "{$PATHBASE}"
 */
$controller = new Controller(new {$CLASSMODEL});

router()
	/**
	 * Use route controller
	 */
	->controller($controller);