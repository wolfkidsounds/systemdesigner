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
    private string $path = '/processor/';
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
            'processor[Name]' => 'Testing',
            'processor[ChannelsInput]' => 'Testing',
            'processor[ChannelsOutput]' => 'Testing',
            'processor[OutputOffset]' => 'Testing',
            'processor[User]' => 'Testing',
            'processor[Manufacturer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/processor/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Processor();
        $fixture->setName('My Title');
        $fixture->setChannelsInput('My Title');
        $fixture->setChannelsOutput('My Title');
        $fixture->setOutputOffset('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

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
        $fixture->setName('My Title');
        $fixture->setChannelsInput('My Title');
        $fixture->setChannelsOutput('My Title');
        $fixture->setOutputOffset('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'processor[Name]' => 'Something New',
            'processor[ChannelsInput]' => 'Something New',
            'processor[ChannelsOutput]' => 'Something New',
            'processor[OutputOffset]' => 'Something New',
            'processor[User]' => 'Something New',
            'processor[Manufacturer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/processor/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getChannelsInput());
        self::assertSame('Something New', $fixture[0]->getChannelsOutput());
        self::assertSame('Something New', $fixture[0]->getOutputOffset());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getManufacturer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Processor();
        $fixture->setName('My Title');
        $fixture->setChannelsInput('My Title');
        $fixture->setChannelsOutput('My Title');
        $fixture->setOutputOffset('My Title');
        $fixture->setUser('My Title');
        $fixture->setManufacturer('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/processor/');
    }
}
