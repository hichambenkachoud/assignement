<?php

namespace App\Tests\Integration;

use App\Domain\Knight;
use App\Domain\KnightRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Uid\Uuid;

class KnightRepositoryTest extends  WebTestCase
{
    public function testAddKnight(): void
    {
        // Arrange
        $knight1 = new Knight(Uuid::v1()->toBinary(), 'Hicham', 15, 20);
        $knight2 = new Knight(Uuid::v1()->toBinary(), 'Karim', 30, 12);

        self::bootKernel();
        $repository = self::getContainer()->get(KnightRepositoryInterface::class);

        // act
        $repository->save($knight1);
        $repository->save($knight2);

        // act
        $record = $repository->findOneBy(['name' => 'Hicham']);

        // Assert
        $this->assertNotNull($record);
    }

    /**
     * @requires testAddKnight
     */
    public function testFindAllKnight(): void
    {
        // Arrange
        self::bootKernel();
        $repository = self::getContainer()->get(KnightRepositoryInterface::class);

        // act
        $records = $repository->findAll();

        // Assert
        $this->assertEquals(2, count($records));
    }

    public function testKnightNotFount(): void
    {
        // Arrange
        self::bootKernel();
        $repository = self::getContainer()->get(KnightRepositoryInterface::class);

        // act
        $record = $repository->find(Uuid::v1()->toBinary());

        // Assert
        $this->assertNull($record);
    }
}