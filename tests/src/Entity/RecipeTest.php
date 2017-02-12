<?php

namespace Lunch\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Lunch\Entity\Recipe;
use Lunch\Entity\Ingredient;

final class RecipeTest extends TestCase
{
    public function testCountBestBeforeExpiredIngredients()
    {
        $tomorrow = new \DateTime();
        $tomorrow->add(new \DateInterval('P1D'));

        $yesterday = new \DateTime();
        $yesterday->sub(new \DateInterval('P1D'));

        $ingredient = new Ingredient('Peper', $tomorrow, $tomorrow);
        $ingredientBestBeforeYesterday = new Ingredient('Salt', $yesterday, $tomorrow);

        $recipe = new Recipe('Bolognese', [$ingredient, $ingredientBestBeforeYesterday]);

        $this->assertEquals(1, $recipe->countBestBeforeExpiredIngredients());
    }
}