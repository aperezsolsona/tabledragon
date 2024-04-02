<?php

namespace TableDragon\Infrastructure\Persistence\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use TableDragon\Domain\Player\Player;
use TableDragon\Infrastructure\Persistence\CategoryRepository;
use TableDragon\Infrastructure\Persistence\PlayerRepository;

class PlayerFixtures extends Fixture
{
    const PLAYER1_UUID = '962f24fc-36e0-4b9d-8ff7-09450a45b767';
    const PLAYER2_UUID = '463fd68f-6867-4b41-a273-2f432b6fcb06';

    public function __construct(
        public readonly PlayerRepository $playerRepository,
        public readonly CategoryRepository $categoryRepository,
    ){}


    /**
     * Loads two players in database
     */
    public function load(ObjectManager $manager)
    {
        $existingCategory = $this->categoryRepository->findOneBy(['id'=>1]);

        // Creates some players for testing
        $player1 = new Player(
            self::PLAYER1_UUID,
            'TestName1',
            'TestSurname1',
            'P1234',
            $existingCategory
        );
        $manager->persist($player1);

        $player2 = new Player(
            self::PLAYER2_UUID,
            'TestName2',
            'TestSurname2',
            'P9876',
            $existingCategory
        );
        $manager->persist($player2);
        $manager->flush();
    }

    public function deleteFixture(ObjectManager $manager): void
    {
        $player1 = $this->playerRepository->find(self::PLAYER1_UUID);
        $player2 = $this->playerRepository->find(self::PLAYER2_UUID);

        $manager->remove($player1);
        $manager->remove($player2);
        $manager->flush();
    }
}