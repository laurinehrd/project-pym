<?php

// tests/Entity/IngredientsTest.php

namespace App\Tests\Entity;

use App\Entity\Ingredients;
use PHPUnit\Framework\TestCase;

class IngredientsTest extends TestCase
{
    public function testName()
    {
        $ingredient = new Ingredients();
        $name = "Test 2";
        
        $ingredient->setName($name);
        $this->assertEquals("test_2", $ingredient->getName());
    }
}