<?php

namespace Jtl\Shop4\Tests\Backend\Services\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Jtl\Shop4\Entity\Auth\User;

class AuthSimpleUserFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('cspoo');
        // hashed password '12345'
        $user->setPassword('$2y$10$3AOtEwFJY.L69XgFD2oJqeiKn986iJP2.ZnbquYMx8pjVJoOGNv1K');

        $manager->persist($user);
        $manager->flush();
    }
}