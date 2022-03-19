<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain;

interface KnightRepositoryInterface
{
    public function findKnight(string $id): ?Knight;

    public function getAll(): iterable;

    public function save(Knight $knight): void;
}
