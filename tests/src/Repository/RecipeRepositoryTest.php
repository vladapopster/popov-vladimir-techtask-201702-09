<?php

namespace Lunch\Tests\Repository;

use PHPUnit\Framework\TestCase;
use Lunch\Repository\RecipeRepository;
use Lunch\Entity\Recipe;

class RecipeRepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        $this->repository = new RecipeRepository();

        parent::setUp();
    }

    public function testFindAll()
    {
        $recipes = $this->repository->findAll();//print_r($recipes);exit;

        $this->assertCount(4, $recipes);
        $this->assertInstanceOf(Recipe::class, $recipes[0]);
    }
}