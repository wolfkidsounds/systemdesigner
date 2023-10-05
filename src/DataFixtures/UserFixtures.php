<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('eric@pulsationaudio.com');
        $user->setUsername('Pulsation Audio');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setPassword('$2y$13$/UvTDWJOKuW4StGkRm5me.URelOL.OxRd3wweuqg4iEaAFiiaNP0.');

        $manager->persist($user);
        $manager->flush();
    }
}
