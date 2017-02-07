<?php

namespace NextrasDemos\Datagrid;

use Nette\Configurator;

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Configurator();
$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->addConfig(__DIR__ . '/config.neon');
$configurator->createRobotLoader()->addDirectory(__DIR__)->register();

return $configurator->createContainer();
