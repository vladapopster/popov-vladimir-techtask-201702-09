<?php

namespace Lunch\Entity;

class Recipe
{
    private $title;
    private $ingredients;
    private $countBestBeforeExpiredIngredients = 0;

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

    public function getCountBestBeforeExpiredIngredients()
    {
        return $this->countBestBeforeExpiredIngredients;
    }

    public function setCountBestBeforeExpiredIngredients($countBestBeforeExpiredIngredients)
    {
        $this->countBestBeforeExpiredIngredients = $countBestBeforeExpiredIngredients;

        return $this;
    }
}
