<?php

namespace NextrasDemos\Datagrid;

use Nette\Application\Application;


$container = require_once __DIR__ . '/../app/bootstrap.php';
$app = $container->getByType(Application::class);
$app->run();
