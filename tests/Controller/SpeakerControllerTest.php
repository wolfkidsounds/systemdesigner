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
    private string $path = '/speaker/crud/';
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
            'speaker[BrandId]' => 'Testing',
            'speaker[UserId]' => 'Testing',
            'speaker[Name]' => 'Testing',
            'speaker[Bandwidth]' => 'Testing',
            'speaker[PowerRms]' => 'Testing',
            'speaker[Impedance]' => 'Testing',
            'speaker[Spl]' => 'Testing',
        ]);

        self::assertResponseRedirects('/speaker/crud/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Speaker();
        $fixture->setBrandId('My Title');
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setBandwidth('My Title');
        $fixture->setPowerRms('My Title');
        $fixture->setImpedance('My Title');
        $fixture->setSpl('My Title');

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
        $fixture->setBrandId('My Title');
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setBandwidth('My Title');
        $fixture->setPowerRms('My Title');
        $fixture->setImpedance('My Title');
        $fixture->setSpl('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'speaker[BrandId]' => 'Something New',
            'speaker[UserId]' => 'Something New',
            'speaker[Name]' => 'Something New',
            'speaker[Bandwidth]' => 'Something New',
            'speaker[PowerRms]' => 'Something New',
            'speaker[Impedance]' => 'Something New',
            'speaker[Spl]' => 'Something New',
        ]);

        self::assertResponseRedirects('/speaker/crud/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getBrandId());
        self::assertSame('Something New', $fixture[0]->getUserId());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getBandwidth());
        self::assertSame('Something New', $fixture[0]->getPowerRms());
        self::assertSame('Something New', $fixture[0]->getImpedance());
        self::assertSame('Something New', $fixture[0]->getSpl());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Speaker();
        $fixture->setBrandId('My Title');
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setBandwidth('My Title');
        $fixture->setPowerRms('My Title');
        $fixture->setImpedance('My Title');
        $fixture->setSpl('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/speaker/crud/');
    }
}
