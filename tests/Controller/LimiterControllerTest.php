<?php

namespace App\Test\Controller;

use App\Entity\Limiter;
use App\Repository\LimiterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LimiterControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private LimiterRepository $repository;
    private string $path = '/limiter/crud/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Limiter::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Limiter index');

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
            'limiter[UserId]' => 'Testing',
            'limiter[Name]' => 'Testing',
            'limiter[AmplifierId]' => 'Testing',
            'limiter[ProcessorId]' => 'Testing',
            'limiter[SpeakerId]' => 'Testing',
            'limiter[PeakLimiter]' => 'Testing',
            'limiter[RmsLimiter]' => 'Testing',
        ]);

        self::assertResponseRedirects('/limiter/crud/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Limiter();
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setAmplifierId('My Title');
        $fixture->setProcessorId('My Title');
        $fixture->setSpeakerId('My Title');
        $fixture->setPeakLimiter('My Title');
        $fixture->setRmsLimiter('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Limiter');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Limiter();
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setAmplifierId('My Title');
        $fixture->setProcessorId('My Title');
        $fixture->setSpeakerId('My Title');
        $fixture->setPeakLimiter('My Title');
        $fixture->setRmsLimiter('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'limiter[UserId]' => 'Something New',
            'limiter[Name]' => 'Something New',
            'limiter[AmplifierId]' => 'Something New',
            'limiter[ProcessorId]' => 'Something New',
            'limiter[SpeakerId]' => 'Something New',
            'limiter[PeakLimiter]' => 'Something New',
            'limiter[RmsLimiter]' => 'Something New',
        ]);

        self::assertResponseRedirects('/limiter/crud/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUserId());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getAmplifierId());
        self::assertSame('Something New', $fixture[0]->getProcessorId());
        self::assertSame('Something New', $fixture[0]->getSpeakerId());
        self::assertSame('Something New', $fixture[0]->getPeakLimiter());
        self::assertSame('Something New', $fixture[0]->getRmsLimiter());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Limiter();
        $fixture->setUserId('My Title');
        $fixture->setName('My Title');
        $fixture->setAmplifierId('My Title');
        $fixture->setProcessorId('My Title');
        $fixture->setSpeakerId('My Title');
        $fixture->setPeakLimiter('My Title');
        $fixture->setRmsLimiter('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/limiter/crud/');
    }
}
