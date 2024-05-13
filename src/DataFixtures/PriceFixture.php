<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PriceFixture extends Fixture implements DependentFixtureInterface
{
    public const PRICE_REFERENCE = 'price1';
    public const PRICE_REFERENCE2 = 'price2';

    public function load(ObjectManager $manager): void
    {
        $price = new Price();
        $price->setValue(10.0);
        $price->setWashStation($this->getReference(WashStationFixtures::WASH_STATION_REFERENCE));
        $price->setModelUser($this->getReference(UserFixtures::USER_REFERENCE));

        $manager->persist($price);
        $manager->flush();

        $this->addReference('price1', $price);

        $price = new Price();
        $price->setValue(20.0);
        $price->setWashStation($this->getReference(WashStationFixtures::WASH_STATION_REFERENCE2));
        $price->setModelUser($this->getReference(UserFixtures::ADMIN_REFERENCE));

        $manager->persist($price);
        $manager->flush();

        $this->addReference('price2', $price);
    }

    public function getDependencies(): array
    {
        return [
            WashStationFixtures::class,
            UserFixtures::class,
        ];
    }
}
