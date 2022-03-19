<?php

namespace App\Infrastructure\DataMapper;

use App\Domain\Knight as KnightDomain;
use App\Infrastructure\Dto\AddKnightDto;
use App\Infrastructure\Entity\Knight as KnightEntity;
use App\Infrastructure\ViewModels\KnightVM;
use Symfony\Component\Uid\Uuid;

class KnightDataMapper implements KnightDataMapperInterface
{

    public function domainToEntity(KnightDomain $knightDomain): KnightEntity
    {
        $entity = new KnightEntity();
        $entity->setName($knightDomain->getName());
        $entity->setStrength($knightDomain->getStrength());
        $entity->setWeaponPower($knightDomain->getWeaponPower());

        return $entity;
    }

    public function entityToDomain(KnightEntity $knightEntity): KnightDomain
    {
        return new KnightDomain(
            $knightEntity->getId(),
            $knightEntity->getName(),
            $knightEntity->getStrength(),
            $knightEntity->getWeaponPower(),
        );
    }

    public function dtoAddKnightToDomain(AddKnightDto $addKnightDto): KnightDomain
    {
        return new KnightDomain(
            Uuid::v1()->getNode(),
            $addKnightDto->name,
            $addKnightDto->strength,
            $addKnightDto->weaponPower,
        );
    }
}