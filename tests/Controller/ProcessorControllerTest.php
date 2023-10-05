<?php

namespace App\Test\Controller;

use App\Entity\Processor;
use App\Repository\ProcessorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProcessorControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProcessorRepository $repository;
    private string $path = '/processor';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Processor::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Processor index');

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
            'processor[Brand]' => 'Brand Name',
            'processor[Name]' => 'Controller Name',
            'processor[ChannelsInput]' => rand(1,8),
            'processor[ChannelsOutput]' => rand(1,16),
            'processor[OutputOffset]' => rand(1,30),
        ]);

        self::assertResponseRedirects('/processor');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Processor();
        $fixture->setBrand('Brand Name');
        $fixture->setName('Controller Name');
        $fixture->setChannelsInput(rand(1,8));
        $fixture->setChannelsOutput(rand(1,16));
        $fixture->setOutputOffset(rand(1,30));

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Processor');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Processor();
        $fixture->setBrand('Brand Name');
        $fixture->setName('Brand Controller');
        $fixture->setChannelsInput(rand(1,8));
        $fixture->setChannelsOutput(rand(1,8));
        $fixture->setOutputOffset(rand(1,20));

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'processor[Brand]' => 'Another Brand',
            'processor[Name]' => 'Another Controller',
            'processor[ChannelsInput]' => 1,
            'processor[ChannelsOutput]' => 2,
            'processor[OutputOffset]' => 3,
        ]);

        self::assertResponseRedirects('/processor');

        $fixture = $this->repository->findAll();

        self::assertSame('Another Brand', $fixture[0]->getBrand());
        self::assertSame('Another Controller', $fixture[0]->getName());
        self::assertSame(1, $fixture[0]->getChannelsInput());
        self::assertSame(2, $fixture[0]->getChannelsOutput());
        self::assertSame(3, $fixture[0]->getOutputOffset());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Processor();
        $fixture->setBrand('My Title');
        $fixture->setName('My Title');
        $fixture->setChannelsInput(99);
        $fixture->setChannelsOutput(99);
        $fixture->setOutputOffset(99);

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/processor');
    }
}
