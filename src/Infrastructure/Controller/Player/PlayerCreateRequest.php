<?php

namespace TableDragon\Infrastructure\Controller\Player;

use TableDragon\Application\Player\PlayerDTO;
use TableDragon\Infrastructure\Controller\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

class PlayerCreateRequest extends BaseRequest
{
    #[Assert\NotBlank(message: 'Name field must not be empty')]
    #[Assert\Type('string')]
    public readonly string $name;

    #[Assert\NotBlank(message: 'Surname field must not be empty')]
    #[Assert\Type('string')]
    public readonly string $surname;

    #[Assert\NotBlank()]
    #[Assert\Type('string')]
    public readonly string $number;

    #[Assert\NotBlank()]
    #[Assert\Positive()]
    public readonly int $category_id;

    public function getDTO(): PlayerDTO
    {
        return new PlayerDTO(
            $this->name,
            $this->surname,
            $this->number,
            $this->category_id,
        );
    }
}