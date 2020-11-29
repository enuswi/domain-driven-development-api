<?php
namespace app\Services\Application;

use app\Repositories\ICharaRepository;
use app\Models\Domain\Entities\Chara;

class CharaService
{
    /**
     * @param ICharaRepository $charaRepository
     */
    protected $charaRepository;

    public function __construct(ICharaRepository $charaRepository)
    {
        $this->charaRepository = $charaRepository;
    }

    /**
     * @return array
     */
    public function getCharaList(): array
    {
        $charas = $this->charaRepository->getList();
        foreach ($charas as $chara) {
            /** @var Chara $chara */
            $list[] = $chara->toArray();
        }
        return $list ?? [];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCharaById(int $id)
    {
        $chara = $this->charaRepository->getById($id);
        if (!$chara) {
            return [];
        }

        /** @var Chara $chara */
        return $chara->toArray();
    }
}