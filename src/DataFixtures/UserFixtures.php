<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('eric@pulsationaudio.com');
        $user1->setUsername('Pulsation Audio');
        $user1->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user1->setPassword('$2y$13$/UvTDWJOKuW4StGkRm5me.URelOL.OxRd3wweuqg4iEaAFiiaNP0.');
        $user1->setSubscriber(true);

        $manager->persist($user1);
        $manager->flush();

        $user2 = new User();
        $user2->setEmail('test@pulsationaudio.com');
        $user2->setUsername('Test User');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword('$2y$13$/UvTDWJOKuW4StGkRm5me.URelOL.OxRd3wweuqg4iEaAFiiaNP0.');
        $user2->setSubscriber(false);

        $manager->persist($user2);

        // Define references to these users
        $this->addReference('user_1', $user1);
        $this->addReference('user_2', $user2);

        $manager->flush();
    }
}
