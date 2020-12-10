<?php
namespace app\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use app\Repositories\CharaRepository;
use app\Services\Application\CharaService;
use app\Services\Domain\CharaService as CharaDomainService;

class CharaController extends AbstractController
{
    /**
     * @var CharaService $charaService
     */
    protected $charaService;

    /**
     * @var CharaRepository $charaRepository
     */
    protected $charaRepository;

    /**
     * @var CharaDomainService $charaDomainService
     */
    protected $charaDomainService;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        // DIコンテナから'CharaRepository'を取得
        $this->charaRepository = $container->get('CharaRepository');
        $this->charaDomainServie = new CharaDomainService($this->charaRepository);
        $this->charaService = new CharaService($this->charaRepository, $this->charaDomainService);
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