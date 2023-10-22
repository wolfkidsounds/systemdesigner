<?php

namespace App\Test\Controller;

use App\Entity\Chassis;
use App\Repository\ChassisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChassisControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ChassisRepository $repository;
    private string $path = '/chassis/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Chassis::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chassis index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'chassis[Name]' => 'Testing',
            'chassis[Validated]' => 'Testing',
            'chassis[User]' => 'Testing',
            'chassis[Manufacturer]' => 'Testing',
            'chassis[speakers]' => 'Testing',
        ]);

        self::assertResponseRedirects('/chassis/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chassis();
        $fixture->setName('My Title');
        $fixture->setValidated('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');
        $fixture->setSpeakers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chassis');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chassis();
        $fixture->setName('My Title');
        $fixture->setValidated('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');
        $fixture->setSpeakers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'chassis[Name]' => 'Something New',
            'chassis[Validated]' => 'Something New',
            'chassis[User]' => 'Something New',
            'chassis[Manufacturer]' => 'Something New',
            'chassis[speakers]' => 'Something New',
        ]);

        self::assertResponseRedirects('/chassis/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getValidated());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getManufacturer());
        self::assertSame('Something New', $fixture[0]->getSpeakers());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Chassis();
        $fixture->setName('My Title');
        $fixture->setValidated('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');
        $fixture->setSpeakers('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/chassis/');
    }
}
