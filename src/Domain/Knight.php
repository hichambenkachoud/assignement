<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain;

class Knight implements Fighter
{
    private string $id;
    private string $name;
    private int $strength;
    private int $weaponPower;

    public function __construct(string $id, string $name, int $strength, int $weaponPower)
    {
        $this->id = $id;
        $this->name = $name;
        $this->strength = $strength;
        $this->weaponPower = $weaponPower;
    }


    public function getID(): string
    {
        return $this->id;
    }

    public function getPower(): float
    {
        return $this->strength + $this->weaponPower;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getWeaponPower(): int
    {
        return $this->weaponPower;
    }
}
