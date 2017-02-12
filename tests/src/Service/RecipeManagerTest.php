<?php

use PHPUnit\Framework\TestCase;
use Lunch\Service\RecipeManager;
use Lunch\Repository\IngredientRepository;
use Lunch\Repository\RecipeRepository;

class RecipeManagerTest extends TestCase
{
    private $service;

    public function setUp()
    {
        $ingredientRepository = new IngredientRepository();
        $recipeRepository = new RecipeRepository();

        $this->service = new RecipeManager($ingredientRepository, $recipeRepository);

        parent::setUp();
    }

    public function testGetRecipes()
    {
        $availableFrom = new \DateTime('2017-02-12');
        $recipes = $this->service->getRecipes($availableFrom);

        $this->assertCount(2, $recipes);
    }

    public function testAllExpired()
    {
        $availableFrom = new \DateTime('2017-03-12');
        $recipes = $this->service->getRecipes($availableFrom);

        $this->assertCount(0, $recipes);
    }
}