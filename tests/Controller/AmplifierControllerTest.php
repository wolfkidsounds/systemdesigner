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
    private string $path = '/amplifier/crud/';
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
            'amplifier[BrandId]' => 1,
            'amplifier[UserId]' => 1,
            'amplifier[Name]' => 'Test',
            'amplifier[Height]' => 1,
            'amplifier[OutputChannels]' => 1,
            'amplifier[Power16]' => 1,
            'amplifier[Power8]' => 1,
            'amplifier[Power4]' => 1,
            'amplifier[Power2]' => 1,
            'amplifier[PowerBridge8]' => 1,
            'amplifier[PowerBridge4]' => 1,
        ]);

        self::assertResponseRedirects('/amplifier/crud/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Amplifier();
        $fixture->setBrandId(1);
        $fixture->setUserId(1);
        $fixture->setName('Test');
        $fixture->setHeight(1);
        $fixture->setOutputChannels(1);
        $fixture->setPower16(1);
        $fixture->setPower8(1);
        $fixture->setPower4(1);
        $fixture->setPower2(1);
        $fixture->setPowerBridge8(1);
        $fixture->setPowerBridge4(1);

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
        $fixture->setBrandId(1);
        $fixture->setUserId(1);
        $fixture->setName('Test');
        $fixture->setHeight(1);
        $fixture->setOutputChannels(1);
        $fixture->setPower16(1);
        $fixture->setPower8(1);
        $fixture->setPower4(1);
        $fixture->setPower2(1);
        $fixture->setPowerBridge8(1);
        $fixture->setPowerBridge4(1);

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'amplifier[BrandId]' => 99,
            'amplifier[UserId]' => 99,
            'amplifier[Name]' => 'Test New',
            'amplifier[Height]' => 99,
            'amplifier[OutputChannels]' => 99,
            'amplifier[Power16]' => 99,
            'amplifier[Power8]' => 99,
            'amplifier[Power4]' => 99,
            'amplifier[Power2]' => 99,
            'amplifier[PowerBridge8]' => 99,
            'amplifier[PowerBridge4]' => 99,
        ]);

        self::assertResponseRedirects('/amplifier/crud/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getBrandId());
        self::assertSame('Something New', $fixture[0]->getUserId());
        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getHeight());
        self::assertSame('Something New', $fixture[0]->getOutputChannels());
        self::assertSame('Something New', $fixture[0]->getPower16());
        self::assertSame('Something New', $fixture[0]->getPower8());
        self::assertSame('Something New', $fixture[0]->getPower4());
        self::assertSame('Something New', $fixture[0]->getPower2());
        self::assertSame('Something New', $fixture[0]->getPowerBridge8());
        self::assertSame('Something New', $fixture[0]->getPowerBridge4());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Amplifier();
        $fixture->setBrandId(1);
        $fixture->setUserId(1);
        $fixture->setName('Remove');
        $fixture->setHeight(1);
        $fixture->setOutputChannels(1);
        $fixture->setPower16(1);
        $fixture->setPower8(1);
        $fixture->setPower4(1);
        $fixture->setPower2(1);
        $fixture->setPowerBridge8(1);
        $fixture->setPowerBridge4(1);

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/amplifier/crud/');
    }
}
