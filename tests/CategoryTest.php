<?php

namespace App\Tests;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testIsTrue(): void
    {
        $category = new Category();

        $category->setName('name')
                 ->setDescription('description')
                 ->setSlug('slug');

        $this->assertTrue($category->getName() === 'name');
        $this->assertTrue($category->getDescription() === 'description');
        $this->assertTrue($category->getSlug() === 'slug');
    }

    public function testIsFalse(): void
    {
        $category = new Category();

        $category->setName('name')
                 ->setDescription('description')
                 ->setSlug('slug');

        $this->assertFalse($category->getName() === 'false');
        $this->assertFalse($category->getDescription() === 'false');
        $this->assertFalse($category->getSlug() === 'false');
    }

    public function testIsEmpty(): void
    {
        $category = new Category();

        $this->assertEmpty($category->getName());
        $this->assertEmpty($category->getDescription());
        $this->assertEmpty($category->getSlug());
    }
}
