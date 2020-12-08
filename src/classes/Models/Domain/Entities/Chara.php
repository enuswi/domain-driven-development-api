<?php
namespace app\Models\Domain\Entities;

use app\Models\Domain\ValueObjects\Chara\Age;
use app\Models\Domain\ValueObjects\Chara\Firstname;
use app\Models\Domain\ValueObjects\Chara\Lastname;

class Chara extends AbstractEntity
{
    const ID        = 'id';
    const FIRSTNAME = 'firstname';
    const LASTNAME  = 'lastname';
    const AGE       = 'age';

    /**
     * @param int $id
     */
    private $id;

    /**
     * @param Firstname $firstname
     */
    private $firstname;

    /**
     * @param Lastname $lastname
     */
    private $lastname;

    /**
     * @param Age $age
     */
    private $age;

    public function __construct(
        int $id,
        Firstname $firstname,
        Lastname $lastname,
        Age $age
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Firstname
     */
    public function getFirstname(): Firstname
    {
        return $this->firstname;
    }

    /**
     * @return Lastname
     */
    public function getLastname(): Lastname
    {
        return $this->lastname;
    }

    /**
     * @return Age
     */
    public function getAge(): Age
    {
        return $this->age;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            self::ID        => $this->getId(),
            self::FIRSTNAME => $this->getFirstname()->getValue(),
            self::LASTNAME  => $this->getLastname()->getValue(),
            self::AGE       => $this->getAge()->getValue(),
        ];
    }
}
