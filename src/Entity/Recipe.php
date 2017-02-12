<?php

namespace Lunch\Entity;

class Recipe
{
    private $title;
    private $ingredients;

    public function __construct(string $title, array $ingredients)
    {
        $this->title = $title;
        $this->ingredients = $ingredients;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getIngredients() : array
    {
        return $this->ingredients;
    }

    public function countBestBeforeExpiredIngredients() : int
    {
        $usedByCount = array_reduce(
            $this->ingredients,
            function ($count, $ingredient) {
                if ($ingredient->getBestBefore() < new \DateTime()) {
                    $count++;
                }
                return $count;
            }, 0
        );

        return $usedByCount;
    }
}