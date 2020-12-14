<?php
namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use app\Repositories\CharaRepositoryInterface;
use app\Services\Application\CharaService;

class CharaController extends AbstractController
{
    /**
     * @var CharaService $charaService
     */
    protected CharaService $charaService;

    /**
     * @var CharaRepositoryInterface $charaRepository
     */
    protected CharaRepositoryInterface $charaRepository;

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
        return $this->responseSuccess(response: $response, data: $data);
    }

    /**
     * 指定IDのキャラを取得する
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @throws \Exception
     * @return Response
     */
    public function getById(Request $request, Response $response, array $args): Response
    {
        try {
            $charaId = (int) $args['id'] ?? null;
            if (!$charaId) throw new \Exception('Chara.id is not found.');

            $chara = $this->charaService->getCharaById(id: $charaId);
            if (!$chara) throw new \Exception('Chara not found.');

            return $this->responseSuccess(response: $response, data: $chara);
        } catch (\Exception $e) {
            return  $this->responseError(response: $response);
        }
    }
}