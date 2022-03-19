<?php

declare(strict_types=1);

/**
 * This file is part of a Upply project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Handler;

use App\Domain\ArenaInterface;
use App\Domain\Knight;
use App\Domain\KnightRepositoryInterface;

class KnightHandler
{
    private KnightRepositoryInterface $knightRepository;
    private ArenaInterface $arena;

    public function __construct(KnightRepositoryInterface $knightRepository, ArenaInterface $arena)
    {
        $this->knightRepository = $knightRepository;
        $this->arena = $arena;
    }

    public function add(Knight $knight): void
    {
       $this->knightRepository->save($knight);
    }

    public function getKnight(string $id): ?Knight
    {
        return $this->knightRepository->findKnight($id);
    }

    public function listKnights(): iterable
    {
        return $this->knightRepository->getAll();
    }

    public function fight($knightA, $knightB): ?Knight
    {
        return $this->arena->fight($knightA, $knightB);
    }
}
