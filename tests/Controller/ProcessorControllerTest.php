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
    private string $path = '/processor/crud/';
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
            'processor[BrandId]' => 'Testing',
            'processor[UserId]' => 'Testing',
            'processor[Name]' => 'Testing',
            'processor[Inputs]' => 'Testing',
            'processor[Outputs]' => 'Testing',
            'processor[ProcessorOffset]' => 'Testing',
        ]);

        self::assertResponseRedirects('/processor/crud/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Processor();
        $fixture->setBrandId('My Title');
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setInputs('My Title');
        $fixture->setOutputs('My Title');
        $fixture->setProcessorOffset('My Title');

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
        $fixture->setBrandId('My Title');
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setInputs('My Title');
        $fixture->setOutputs('My Title');
        $fixture->setProcessorOffset('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'processor[BrandId]' => 'Something New',
            'processor[UserId]' => 'Something New',
            'processor[Name]' => 'Something New',
            'processor[Inputs]' => 'Something New',
            'processor[Outputs]' => 'Something New',
            'processor[ProcessorOffset]' => 'Something New',
        ]);

        self::assertResponseRedirects('/processor/crud/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getBrandId());
        self::assertSame('Something New', $fixture[0]->getUserId());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getInputs());
        self::assertSame('Something New', $fixture[0]->getOutputs());
        self::assertSame('Something New', $fixture[0]->getProcessorOffset());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Processor();
        $fixture->setBrandId('My Title');
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setInputs('My Title');
        $fixture->setOutputs('My Title');
        $fixture->setProcessorOffset('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/processor/crud/');
    }
}
