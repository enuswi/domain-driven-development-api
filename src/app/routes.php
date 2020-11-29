<?php
/**
 * ルーティング設定
 * @var \Slim\App $app
 */

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface;

$app->group('/api', function (RouteCollectorProxyInterface $group) {
	$group->group('/v1', function (RouteCollectorProxyInterface $group) {
		$group->get('/get_charas', \app\Controllers\CharaController::class)->setName('get_charas'); // キャラ一覧取得API
		$group->get('/get_chara/{id:[0-9]+}', \app\Controllers\CharaController::class . ':getById')->setName('get_chara'); // キャラ取得API
	});
});

/**
 * PHP環境設定確認ページ
 */
$app->get('/php_info', function (Request $request, Response $response, $args) {
    phpinfo();
    return $response;
});

/**
 * エラーハンドリング（404以外は500）
 */
$app->addRoutingMiddleware();
$customErrorHandler = function(
	Request $request,
	Throwable $exception,
	bool $displayErrorDetails,
	bool $logErrors,
	bool $logErrorDetails
) use ($app) {
	$status = $exception->getCode();
	$response = $app->getResponseFactory()->createResponse();

	if ($status === StatusCodeInterface::STATUS_NOT_FOUND) {
		$response->getBody()->write('404');
		return $response->withStatus(StatusCodeInterface::STATUS_NOT_FOUND);
	}

	$response->getBody()->write('500');
	return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
};

$errorMiddleware = $app->addErrorMiddleware(false, false, false);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);