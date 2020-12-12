<?php

namespace app\Controllers;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @param ContainerInterface $container
     * @return void
     */
    public function __construct(protected ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * index()をデフォルトメソッドにする
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        return $this->index($request, $response, $args);
    }

    /**
     * コントローラクラスのデフォルトメソッド
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    abstract public function index(Request $request, Response $response, array $args): Response;

    /**
     * APIレスポンス：Success
     * @param Response $response
     * @param array|null $data
     * @param int $statusCode
     * @param string $statusType
     * @return Response
     */
    protected function responseSuccess(
        Response $response,
        ?array $data = null,
        int $statusCode = StatusCodeInterface::STATUS_OK,
        string $statusType = 'success'
    ): Response
    {
        return $this->responseFormat($response, $data, $statusCode, $statusType);
    }

    /**
     * APIレスポンス：Failed
     * @param Response $response
     * @param array|null $data
     * @param int $statusCode
     * @param string $statusType
     * @return Response
     */
    protected function responseError(
        Response $response,
        ?array $data = null,
        int $statusCode = StatusCodeInterface::STATUS_BAD_REQUEST,
        string $statusType = 'failed'
    ): Response
    {
        return $this->responseFormat($response, $data, $statusCode, $statusType);
    }

    /**
     * APIレスポンスの雛形
     * @param Response $response
     * @param array $data
     * @param int $statusCode
     * @param string $statusType
     * @return Response
     */
    private function responseFormat(
        Response $response,
        array $data,
        int $statusCode,
        string $statusType
    ): Response
    {
        $responseData = [
            'status' => [
                'code' => $statusCode,
                'type' => $statusType,
            ],
            'response' => $data
        ];
        $response->getBody()->write(json_encode($responseData));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
