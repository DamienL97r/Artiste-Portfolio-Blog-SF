<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue(): void
    {
        $user = new User();

        $user->setEmail('true@test.com')
             ->setFirstname('firstname')
             ->setLastname('lastname')
             ->setPassword('password')
             ->setAbout('About')
             ->setInstagramAccount('instagram-account');

        $this->assertTrue($user->getEmail() === 'true@test.com');
        $this->assertTrue($user->getFirstname() === 'firstname');
        $this->assertTrue($user->getLastname() === 'lastname');
        $this->assertTrue($user->getPassword() === 'password');
        $this->assertTrue($user->getAbout() === 'About');
        $this->assertTrue($user->getInstagramAccount() === 'instagram-account');
    }

    public function testIsFalse(): void
    {
        $user = new User;

        $user->setEmail('true@test.com')
             ->setFirstname('firstname')
             ->setLastname('lastname')
             ->setPassword('password')
             ->setAbout('About')
             ->setInstagramAccount('instagram-account');

        $this->assertFalse($user->getEmail() === 'false@test.com');
        $this->assertFalse($user->getFirstname() === 'false');
        $this->assertFalse($user->getLastname() === 'false');
        $this->assertFalse($user->getPassword() === 'false');
        $this->assertFalse($user->getAbout() === 'false');
        $this->assertFalse($user->getInstagramAccount() === 'false');
    }

    public function testIsEmpty(): void
    {
        $user = new User;

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getLastname());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getAbout());
        $this->assertEmpty($user->getInstagramAccount());
    }
}
