<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encode;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encode = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEmail('superadmin@admin.com');
        $user->setName("Admin");
        $plainPassword = 'ryanpass';
        $encoded = $this->encode->encodePassword($user, $plainPassword);
        $user->setPassword($plainPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
