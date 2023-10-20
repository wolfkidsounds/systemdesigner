<?php // ManufacturerFixtures.php
namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ManufacturerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Create and persist manufacturer entities
        $manufacturer1 = new Manufacturer();
        $manufacturer1->setName('Manufacturer 1');
        $manufacturer1->setUser($this->getReference('user_1')); // Reference to your User fixture
        $manufacturer1->setValidated(true);

        $manufacturer2 = new Manufacturer();
        $manufacturer2->setName('Manufacturer 2');
        $manufacturer2->setUser($this->getReference('user_2')); // Reference to your User fixture
        $manufacturer2->setValidated(false);

        // Add more manufacturers as needed

        $manager->persist($manufacturer1);
        $manager->persist($manufacturer2);

        $this->addReference('manufacturer_1', $manufacturer1);
        $this->addReference('manufacturer_2', $manufacturer2);

        // Flush the entities to the database
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class, // Add your User fixtures class here
        ];
    }
}