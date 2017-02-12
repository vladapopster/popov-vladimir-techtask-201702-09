<?php

namespace Lunch\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Lunch\Controller\RecipeController;

class RecipeControllerTest extends TestCase
{
    private $controller;

    public function setUp()
    {
        $this->controller = new RecipeController();

        parent::setUp();
    }

    public function testLunchAction()
    {
        $availableFrom = new \DateTime();

        $response = $this->controller->lunchAction($availableFrom);
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);

        $recipes = json_decode($response->getContent(), true);

        $this->assertCount(2, $recipes);
        $this->assertEquals(0, $recipes[0]['count_best_before_expired_ingredients']);
    }
}