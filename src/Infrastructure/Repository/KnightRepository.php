<?php

namespace App\Infrastructure\Repository;

use App\Domain\Knight as KnightDomain;
use App\Domain\KnightRepositoryInterface;
use App\Infrastructure\DataMapper\KnightDataMapperInterface;
use App\Infrastructure\Entity\Knight;
use App\Infrastructure\ViewModels\KnightVM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Knight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Knight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Knight[]    findAll()
 * @method Knight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KnightRepository extends ServiceEntityRepository implements KnightRepositoryInterface
{
    private KnightDataMapperInterface $knightDataMapper;

    public function __construct(ManagerRegistry $registry, KnightDataMapperInterface $knightDataMapper)
    {
        parent::__construct($registry, Knight::class);
        $this->knightDataMapper = $knightDataMapper;
    }

    public function getAll(): iterable
    {
        return $this->_em->createQueryBuilder()
            ->select('k')
            ->from(Knight::class, 'k')
            ->getQuery()
            ->getResult();
    }

    public function save(KnightDomain $knight): void
    {
        $entity = $this->knightDataMapper->domainToEntity($knight);

        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function findKnight(string $id): ?KnightDomain // change this
    {
        $entity = $this->find($id);
        if (!$entity) {
            return null;
        }

        return $this->knightDataMapper->entityToDomain($entity);
    }
}
