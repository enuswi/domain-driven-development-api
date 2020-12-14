<?php
namespace app\Services\Application;

use app\Repositories\CharaRepositoryInterface;
use app\Models\Domain\Entities\Chara;
use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;
use app\Services\Domain\CharaService as CharaDomainService;

/**
 * Class CharaService
 * @package app\Services\Application
 */
class CharaService
{
    /**
     * @param CharaRepositoryInterface $charaRepository
     */
    protected CharaRepositoryInterface $charaRepository;

    /**
     * @var CharaDomainService $charaDomainService
     */
    protected CharaDomainService $charaDomainService;

    /**
     * CharaService constructor.
     * @param CharaRepositoryInterface $charaRepository
     */
    public function __construct(
        CharaRepositoryInterface $charaRepository
    ) {
        $this->charaRepository = $charaRepository;
        $this->charaDomainService = new CharaDomainService($charaRepository);
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
        try {
            if ($this->charaDomainService->isExistById($id)) throw new \Exception('Chara.id is already exists.');

            $result = $this->charaRepository->store($id, new Firstname($firstname), new Lastname($lastname), new Age($age));
            if (!$result) throw new \Exception('create chara failed.');

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getCharaList(): array
    {
        $characters = $this->charaRepository->getList();
        foreach ($characters as $chara) {
            /** @var Chara $chara */
            $list[] = $chara->toArray();
        }
        return $list ?? [];
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCharaById(int $id): array
    {
        $chara = $this->charaRepository->getById($id);
        if (!$chara) {
            return [];
        }

        /** @var Chara $chara */
        return $chara->toArray();
    }
}