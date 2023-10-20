<?php // AmplifierControllerTest.php

namespace App\Test\Controller;

use App\Entity\Amplifier;
use App\DataFixtures\UserFixtures;
use App\Repository\AmplifierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AmplifierControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AmplifierRepository $repository;
    private string $path = '/amplifier/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Amplifier::class);
        $this->manager = static::getContainer()->get('doctrine')->getManager();

        // Remove all existing Amplifier objects from the database
        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Amplifier index');

        // Use the $crawler to perform additional assertions, if needed
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        // Generate random values
        $randomName = 'RandomName' . rand();
        $randomPower16 = rand(1, 100); // Adjust the range as needed
        $randomPower8 = rand(1, 100);
        $randomPower4 = rand(1, 100);
        $randomPower2 = rand(1, 100);
        $randomPowerBridge8 = rand(1, 100);
        $randomPowerBridge4 = rand(1, 100);

        $this->client->submitForm('Save', [
            'amplifier[Name]' => $randomName,
            'amplifier[Power16]' => $randomPower16,
            'amplifier[Power8]' => $randomPower8,
            'amplifier[Power4]' => $randomPower4,
            'amplifier[Power2]' => $randomPower2,
            'amplifier[PowerBridge8]' => $randomPowerBridge8,
            'amplifier[PowerBridge4]' => $randomPowerBridge4,
            'amplifier[User]' => $user->getId(1), // Assuming User has an ID field
            'amplifier[Manufacturer]' => $manufacturer->getId(1), // Assuming Manufacturer has an ID field
        ]);

        self::assertResponseRedirects('/amplifier/');

        // Check that a new object is created in the repository
        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();

        $fixture = new Amplifier();
        $fixture->setName('My Title');
        $fixture->setPower16('My Title');
        $fixture->setPower8('My Title');
        $fixture->setPower4('My Title');
        $fixture->setPower2('My Title');
        $fixture->setPowerBridge8('My Title');
        $fixture->setPowerBridge4('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Amplifier');

        // Use assertions to check that the properties are properly displayed.
        self::assertSelectorTextContains('h1', 'My Title'); // Adjust the selector as needed
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Amplifier();
        $fixture->setName('My Title');
        $fixture->setPower16('My Title');
        $fixture->setPower8('My Title');
        $fixture->setPower4('My Title');
        $fixture->setPower2('My Title');
        $fixture->setPowerBridge8('My Title');
        $fixture->setPowerBridge4('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Update', [
            'amplifier[Name]' => 'Something New',
            'amplifier[Power16]' => 'Something New',
            'amplifier[Power8]' => 'Something New',
            'amplifier[Power4]' => 'Something New',
            'amplifier[Power2]' => 'Something New',
            'amplifier[PowerBridge8]' => 'Something New',
            'amplifier[PowerBridge4]' => 'Something New',
            'amplifier[User]' => 'Something New',
            'amplifier[Manufacturer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/amplifier/');

        $updatedFixture = $this->repository->find($fixture->getId());

        self::assertSame('Something New', $updatedFixture->getName());
        self::assertSame('Something New', $updatedFixture->getPower16());
        self::assertSame('Something New', $updatedFixture->getPower8());
        self::assertSame('Something New', $updatedFixture->getPower4());
        self::assertSame('Something New', $updatedFixture->getPower2());
        self::assertSame('Something New', $updatedFixture->getPowerBridge8());
        self::assertSame('Something New', $updatedFixture->getPowerBridge4());
        self::assertSame('Something New', $updatedFixture->getUser());
        self::assertSame('Something New', $updatedFixture->getManufacturer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Amplifier();
        $fixture->setName('My Title');
        $fixture->setPower16('My Title');
        $fixture->setPower8('My Title');
        $fixture->setPower4('My Title');
        $fixture->setPower2('My Title');
        $fixture->setPowerBridge8('My Title');
        $fixture->setPowerBridge4('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/amplifier/');

        // Check that the object is removed from the repository
        self::assertSame($originalNumObjectsInRepository - 1, count($this->repository->findAll()));
    }
}
