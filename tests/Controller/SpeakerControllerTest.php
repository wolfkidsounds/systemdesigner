<?php

namespace App\Test\Controller;

use App\Entity\Speaker;
use App\Repository\SpeakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpeakerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SpeakerRepository $repository;
    private string $path = '/speaker/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Speaker::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Speaker index');

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
            'speaker[Name]' => 'Testing',
            'speaker[PowerRMS]' => 'Testing',
            'speaker[PowerPeak]' => 'Testing',
            'speaker[Impedance]' => 'Testing',
            'speaker[SPL]' => 'Testing',
            'speaker[Manual]' => 'Testing',
            'speaker[Validated]' => 'Testing',
            'speaker[User]' => 'Testing',
            'speaker[Manufacturer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/speaker/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Speaker();
        $fixture->setName('My Title');
        $fixture->setPowerRMS('My Title');
        $fixture->setPowerPeak('My Title');
        $fixture->setImpedance('My Title');
        $fixture->setSPL('My Title');
        $fixture->setManual('My Title');
        $fixture->setValidated('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Speaker');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Speaker();
        $fixture->setName('My Title');
        $fixture->setPowerRMS('My Title');
        $fixture->setPowerPeak('My Title');
        $fixture->setImpedance('My Title');
        $fixture->setSPL('My Title');
        $fixture->setManual('My Title');
        $fixture->setValidated('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'speaker[Name]' => 'Something New',
            'speaker[PowerRMS]' => 'Something New',
            'speaker[PowerPeak]' => 'Something New',
            'speaker[Impedance]' => 'Something New',
            'speaker[SPL]' => 'Something New',
            'speaker[Manual]' => 'Something New',
            'speaker[Validated]' => 'Something New',
            'speaker[User]' => 'Something New',
            'speaker[Manufacturer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/speaker/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getPowerRMS());
        self::assertSame('Something New', $fixture[0]->getPowerPeak());
        self::assertSame('Something New', $fixture[0]->getImpedance());
        self::assertSame('Something New', $fixture[0]->getSPL());
        self::assertSame('Something New', $fixture[0]->getManual());
        self::assertSame('Something New', $fixture[0]->getValidated());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getManufacturer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Speaker();
        $fixture->setName('My Title');
        $fixture->setPowerRMS('My Title');
        $fixture->setPowerPeak('My Title');
        $fixture->setImpedance('My Title');
        $fixture->setSPL('My Title');
        $fixture->setManual('My Title');
        $fixture->setValidated('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/speaker/');
    }
}
