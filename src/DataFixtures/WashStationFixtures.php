<?php

namespace App\DataFixtures;

use App\Entity\WashStation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WashStationFixtures extends Fixture
{
    public const WASH_STATION_REFERENCE = 'washStation1';
    public const WASH_STATION_REFERENCE2 = 'washStation2';

    public function load(ObjectManager $manager): void
    {
        $washStation = new WashStation();
        $washStation->setName('Wash Station 1');
        $washStation->setAddress('Address 1');
        $washStation->setLongitude(1);
        $washStation->setLatitude(1);
        $manager->persist($washStation);

        $this->addReference('washStation1', $washStation);

        $washStation = new WashStation();
        $washStation->setName('Wash Station 2');
        $washStation->setAddress('Address 2');
        $washStation->setLongitude(2);
        $washStation->setLatitude(2);
        $manager->persist($washStation);

        $this->addReference('washStation2', $washStation);

        $manager->flush();
    }
}
