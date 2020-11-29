<?php
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);

/**
 * DIコンテナ
 */
require __DIR__ . '/app/container.php';

$app = AppFactory::create();

/**
 * ルーティング
 */
require __DIR__ . '/app/routes.php';

$app->run();