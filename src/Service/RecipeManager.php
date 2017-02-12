<?php

namespace Lunch\Service;

use Lunch\Repository\IngredientRepository;
use Lunch\Repository\RecipeRepository;

class RecipeManager
{
    private $ingredientRepository;
    private $recipeRepository;

    public function __construct(IngredientRepository $ingredientRepository, RecipeRepository $recipeRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
        $this->recipeRepository = $recipeRepository;
    }

    public function getRecipes(\DateTime $availableFrom = null)
    {
        $availableFrom = $availableFrom ?: new \DateTime();

        $availableIngredients = $this->ingredientRepository->findAvailableIngredientsUseBy($availableFrom);
        $recipes = $this->assembleRecipes($availableIngredients, $this->recipeRepository->findAll());

        return $this->orderByBestBefore($recipes, $availableFrom);
    }

    private function assembleRecipes(array $availableIngredients, array $recipes) : array
    {
        return array_filter($recipes, function ($recipe) use ($availableIngredients) {
            $ingredients = $recipe->getIngredients();
            $availableIngredients = $this->filterIngredients($availableIngredients);

            if (array_intersect($ingredients, $availableIngredients) !== $ingredients) {
                return false;
            }

            return true;
        });
    }

    private function filterIngredients(array $ingredients) : array
    {
        return array_map(
            function ($ingredient) {
                return $ingredient->getTitle();
            },
            $ingredients
        );
    }

    private function orderByBestBefore(array $recipes, \DateTime $availableFrom) : array
    {
        $ingredientRepository = $this->ingredientRepository;

        array_walk($recipes, function (&$recipe) use ($ingredientRepository, $availableFrom) {
            $countBestBeforeExpiredIngredients = 0;
            $ingredients = $recipe->getIngredients();
            foreach($ingredients as $ingredientTitle) {
                $ingredient = $ingredientRepository->findOneByTitle($ingredientTitle);
                if ($ingredient && $ingredient->getBestBefore() > $availableFrom) {
                    $countBestBeforeExpiredIngredients++;
                }
            }

            $recipe->setCountBestBeforeExpiredIngredients($countBestBeforeExpiredIngredients);
        });

        usort($recipes, function($a, $b)
        {
            return $a->getCountBestBeforeExpiredIngredients() > $b->getCountBestBeforeExpiredIngredients();
        });

        return $recipes;
    }
}