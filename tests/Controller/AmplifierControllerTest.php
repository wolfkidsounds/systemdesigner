<?php

namespace App\Test\Controller;

use App\Entity\Amplifier;
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

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Amplifier index');

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
            'amplifier[Name]' => 'Testing',
            'amplifier[Power16]' => 'Testing',
            'amplifier[Power8]' => 'Testing',
            'amplifier[Power4]' => 'Testing',
            'amplifier[Power2]' => 'Testing',
            'amplifier[PowerBridge8]' => 'Testing',
            'amplifier[PowerBridge4]' => 'Testing',
            'amplifier[User]' => 'Testing',
            'amplifier[Manufacturer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/amplifier/');

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

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getPower16());
        self::assertSame('Something New', $fixture[0]->getPower8());
        self::assertSame('Something New', $fixture[0]->getPower4());
        self::assertSame('Something New', $fixture[0]->getPower2());
        self::assertSame('Something New', $fixture[0]->getPowerBridge8());
        self::assertSame('Something New', $fixture[0]->getPowerBridge4());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getManufacturer());
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

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/amplifier/');
    }
}
