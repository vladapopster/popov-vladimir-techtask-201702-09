<?php

namespace Lunch\Controller;

use Lunch\Repository\IngredientRepository;
use Lunch\Repository\RecipeRepository;
use Lunch\Service\RecipeManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializerBuilder;
use Lunch\Service\SocialNotifyer;

class RecipeController
{
    private $socialNotifier;

    public function __construct()
    {
        $this->socialNotifier = new SocialNotifyer();
    }

    public function lunchAction(\DateTime $availableFrom)
    {
        $ingredientRepository = new IngredientRepository();
        $recipeRepository = new RecipeRepository();

        $recipeManager = new RecipeManager($ingredientRepository, $recipeRepository);
        $recipes = $recipeManager->getRecipes($availableFrom);
        $serializer = SerializerBuilder::create()->build();

        $this->socialNotifier->notify();

        return new JsonResponse($serializer->serialize($recipes, 'json'), 200, [], true);
    }
}
