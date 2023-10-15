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
    private string $path = '/limiter/';
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
            'limiter[User]' => 'Testing',
            'limiter[Processor]' => 'Testing',
            'limiter[Amplifier]' => 'Testing',
            'limiter[Speaker]' => 'Testing',
        ]);

        self::assertResponseRedirects('/limiter/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Limiter();
        $fixture->setUser('My Title');
        $fixture->setProcessor('My Title');
        $fixture->setAmplifier('My Title');
        $fixture->setSpeaker('My Title');

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
        $fixture->setUser('My Title');
        $fixture->setProcessor('My Title');
        $fixture->setAmplifier('My Title');
        $fixture->setSpeaker('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'limiter[User]' => 'Something New',
            'limiter[Processor]' => 'Something New',
            'limiter[Amplifier]' => 'Something New',
            'limiter[Speaker]' => 'Something New',
        ]);

        self::assertResponseRedirects('/limiter/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getProcessor());
        self::assertSame('Something New', $fixture[0]->getAmplifier());
        self::assertSame('Something New', $fixture[0]->getSpeaker());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Limiter();
        $fixture->setUser('My Title');
        $fixture->setProcessor('My Title');
        $fixture->setAmplifier('My Title');
        $fixture->setSpeaker('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/limiter/');
    }
}
