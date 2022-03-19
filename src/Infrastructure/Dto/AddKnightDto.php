<?php

namespace App\Infrastructure\Dto;


use Symfony\Component\Validator\Constraints as Assert;

class AddKnightDto
{
    /**
     * @var string
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     * @@Assert\Range(min="1")
     */
    public int $strength;

    /**
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     * @@Assert\Range(min="1")
     */
    public int $weaponPower;
}