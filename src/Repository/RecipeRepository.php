<?php

namespace Lunch\Repository;

use Lunch\Entity\Recipe;

class RecipeRepository extends InMemoryRepository
{
    const DATA_SOURCE_NAME = 'recipes.json';

    public function __construct()
    {
        $this->loadData(__DIR__.'/../../data/'.self::DATA_SOURCE_NAME);
        $this->resolveData();
    }

    public function findAll()
    {
        return $this->data;
    }

    private function resolveData()
    {
        $this->data = array_map(
            function ($ingredient) {
                return new Recipe($ingredient['title'], $ingredient['ingredients']);
            },
            $this->data['recipes']
        );
    }
}