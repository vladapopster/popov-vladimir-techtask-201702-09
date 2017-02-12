<?php

require_once __DIR__.'/../vendor/autoload.php';

use Lunch\Controller\RecipeController;

$app = new Silex\Application();

$app->get('/lunch', function() use($app) {
    $availableFrom = new \DateTime();

    return (new RecipeController())->lunchAction($availableFrom);
});

$app->run();
