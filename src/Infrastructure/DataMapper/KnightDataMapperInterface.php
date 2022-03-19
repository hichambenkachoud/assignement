<?php

namespace App\Infrastructure\DataMapper;

use App\Domain\Knight as KnightDomain;
use App\Infrastructure\Entity\Knight as KnightEntity;

interface KnightDataMapperInterface
{
    public function domainToEntity(KnightDomain $knightDomain): KnightEntity;
    public function entityToDomain(KnightEntity $knightEntity): KnightDomain;
}