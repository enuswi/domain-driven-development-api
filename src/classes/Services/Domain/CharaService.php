<?php
namespace app\Services\Domain;

use app\Repositories\CharaRepositoryInterface;

class CharaService
{
    /**
     * CharaService constructor.
     * @param CharaRepositoryInterface $charaRepository
     */
    public function __construct(protected CharaRepositoryInterface $charaRepository)
    {
        $this->charaRepository = $charaRepository;
    }

    /**
     * キャラの存在チェック
     * @param integer $id
     * @return boolean
     */
    public function isExistById(int $id): bool
    {
        if ($this->charaRepository->getById($id)) {
            return true;
        }
        return false;
    }
}