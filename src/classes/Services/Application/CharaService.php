<?php
namespace app\Services\Application;

use app\Repositories\CharaRepositoryInterface;
use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;
use app\Services\Domain\CharaService as CharaDomainService;

class CharaService
{
    /**
     * @param CharaRepositoryInterface $charaRepository
     */
    protected $charaRepository;

    /**
     * @var CharaDomainService $charaDomainService
     */
    protected $charaDomainService;

    public function __construct(
        CharaRepositoryInterface $charaRepository,
        CharaDomainService $charaDomainService
    ) {
        $this->charaRepository = $charaRepository;
        $this->charaDomainService = $charaDomainService;
    }

    /**
     * @param integer $id
     * @param string $firstname
     * @param string $lastname
     * @param integer $age
     * @return boolean
     */
    public function store(int $id, string $firstname, string $lastname, int $age): bool
    {
        if ($this->charaDomainService->isExistById($id)) {
            return false;
        }

        if ($this->charaRepository->store($id, new Firstname($firstname), new Lastname($lastname), new Age($age))) {
            return true;
        }
        return false;
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