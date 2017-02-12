<?php

namespace Lunch\Tests\Repository;

use PHPUnit\Framework\TestCase;
use Lunch\Repository\IngredientRepository;

class IngredientRepositoryTest extends TestCase
{
    private $repository;

    public function setUp()
    {
        $this->repository = new IngredientRepository();

        parent::setUp();
    }

    public function testFindAvailableIngredientsUseBy()
    {
        $usedByDate = new \DateTime('2017-02-26');
        $ingredients = $this->repository->findAvailableIngredientsUseBy($usedByDate);

        $this->assertCount(14, $ingredients);
    }

    public function testFindAllExpired()
    {
        $usedByDate = new \DateTime('2017-02-28');
        $ingredients = $this->repository->findAvailableIngredientsUseBy($usedByDate);

        $this->assertCount(0, $ingredients);
    }
}
