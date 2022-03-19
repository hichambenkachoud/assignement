<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain;

class Arena implements ArenaInterface
{
    public function fight(Fighter $fighterA, Fighter $fighterB): ?Fighter
    {
        $fight = $fighterA->getPower() <=> $fighterB->getPower();

        if($fight > 0) {
            return $fighterA;
        } elseif ($fight < 0) {
            return $fighterB;
        }

        return null;
    }
}
