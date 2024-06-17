<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Paint;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class PaintTest extends TestCase
{
    public function testIsTrue(): void
    {
        $paint = new Paint();
        $datetime = new DateTime();
        $category = new Category();
        $user = new User();

        $paint->setName('name')
             ->setWidth(22.20)
             ->setHeight(22.20)
             ->setOnSale(true)
             ->setPrice(22.20)
             ->setRealisationDate($datetime)
             ->setCreatedAt($datetime)
             ->setDescription('description')
             ->setPortfolio(true)
             ->setSlug('slug')
             ->setFile('file')
             ->addCategory($category)
             ->setUser($user);

        $this->assertTrue($paint->getName() === 'name');
        $this->assertTrue($paint->getWidth() == 22.20);
        $this->assertTrue($paint->getHeight() == 22.20);
        $this->assertTrue($paint->isOnSale() === true);
        $this->assertTrue($paint->getPrice() == 22.20);
        $this->assertTrue($paint->getRealisationDate() === $datetime);
        $this->assertTrue($paint->getCreatedAt() === $datetime);
        $this->assertTrue($paint->getDescription() === 'description');
        $this->assertTrue($paint->isPortfolio() === true);
        $this->assertTrue($paint->getSlug() === 'slug');
        $this->assertTrue($paint->getFile() === 'file');
        $this->assertContains($category, $paint->getCategory());
        $this->assertTrue($paint->getUser() === $user);
    }

    public function testIsFalse(): void
    {
        $paint = new Paint();
        $datetime = new DateTime();
        $category = new Category();
        $user = new User();

        $paint->setName('name')
             ->setWidth(20.20)
             ->setHeight(20.20)
             ->setOnSale(true)
             ->setPrice(20.20)
             ->setRealisationDate($datetime)
             ->setCreatedAt($datetime)
             ->setDescription('description')
             ->setPortfolio(true)
             ->setSlug('slug')
             ->setFile('file')
             ->addCategory($category)
             ->setUser($user);

            $this->assertFalse($paint->getName() === 'false');
            $this->assertFalse($paint->getWidth() === 22.20);
            $this->assertFalse($paint->getHeight() === 22.20);
            $this->assertFalse($paint->isOnSale() === false);
            $this->assertFalse($paint->getPrice() === 22.20);
            $this->assertFalse($paint->getRealisationDate() === new DateTime());
            $this->assertFalse($paint->getCreatedAt() === new DateTime());
            $this->assertFalse($paint->getDescription() === 'false');
            $this->assertFalse($paint->isPortfolio() === false);
            $this->assertFalse($paint->getSlug() === 'false');
            $this->assertFalse($paint->getFile() === 'false');
            $this->assertNotContains(new Category(), $paint->getCategory());
            $this->assertFalse($paint->getUser() === new User());
    }

    public function testIsEmpty(): void
    {
        $paint = new Paint();

        $this->assertEmpty($paint->getName());
        $this->assertEmpty($paint->getWidth());
        $this->assertEmpty($paint->getHeight());
        $this->assertEmpty($paint->isOnSale());
        $this->assertEmpty($paint->getPrice());
        $this->assertEmpty($paint->getRealisationDate());
        $this->assertEmpty($paint->getCreatedAt());
        $this->assertEmpty($paint->getDescription());
        $this->assertEmpty($paint->isPortfolio());
        $this->assertEmpty($paint->getSlug());
        $this->assertEmpty($paint->getFile());
        $this->assertEmpty($paint->getCategory());
        $this->assertEmpty($paint->getUser());
    }
}
