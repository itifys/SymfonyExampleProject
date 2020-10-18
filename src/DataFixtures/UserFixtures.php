<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder)
  {
    $this->passwordEncoder = $passwordEncoder;
  }
    public function load(ObjectManager $manager)
    {
      $user =
        [
          'email' => 'admin@gmail.com',
          'password' => 'AdminPassword150',
          'roles' => ['ROLE_ADMIN'],
        ]
      ;

      $new_user = new User();
      $new_user->setEmail($user['email']);
      $new_user->setPassword(
        $this->passwordEncoder->encodePassword($new_user, $user['password'])
      );
      $new_user->setRoles($user['roles']);
      $manager->persist($new_user);

      $manager->flush();
    }
}
