<?php

namespace Lunch\Repository;

use Lunch\Entity\Ingredient;

class IngredientRepository extends InMemoryRepository
{
    const DATA_SOURCE_NAME = 'ingredients.json';

    public function __construct()
    {
        $this->loadData(__DIR__.'/../../data/'.self::DATA_SOURCE_NAME);
        $this->resolveData();
    }

    public function findAvailableIngredientsUseBy(\DateTime $useBy) : array
    {
        return array_filter($this->data, function ($ingredient) use ($useBy) {
            return $ingredient->getUseBy() > $useBy;
        });
    }

    public function findOneByTitle($title)
    {
        $result = array_filter($this->data, function ($ingredient) use ($title) {
            return $ingredient->getTitle() === $title;
        });

        return $result[0] ?? null;
    }

    private function resolveData()
    {
        $this->data = array_map(
            function ($ingredient) {
                return new Ingredient($ingredient['title'], new \DateTime($ingredient['best-before']), new \DateTime($ingredient['use-by']));
            },
            $this->data['ingredients']
        );
    }
}
