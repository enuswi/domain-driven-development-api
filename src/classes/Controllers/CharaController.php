<?php
namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use app\Repositories\CharaRepository;
use app\Services\Application\CharaService;

class CharaController extends AbstractController
{
    /**
     * @param CharaService $charaService
     */
    protected $charaService;

    /**
     * @param CharaRepository $charaRepository
     */
    protected $charaRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        // DIコンテナから'CharaRepository'を取得
        $this->charaRepository = $container->get('CharaRepository');
        $this->charaService = new CharaService($this->charaRepository);
    }

    /**
     * キャラ一覧を取得する
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function index(Request $request, Response $response, array $args): Response
    {
        $data = $this->charaService->getCharaList();
        return $this->responseSuccess($response, $data);
    }

    /**
     * 指定IDのキャラを取得する
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getById(Request $request, Response $response, array $args): Response
    {
        $charaId = (int) $args['id'] ?? null;
        if (!$charaId) {
            return $this->responseError($response);
        }
        $chara = $this->charaService->getCharaById($charaId);
        if (!$chara) {
            return $this->responseError($response);
        }
        return $this->responseSuccess($response, $chara);
    }
}