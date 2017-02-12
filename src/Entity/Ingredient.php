<?php

namespace Lunch\Entity;

class Ingredient
{
    private $title;
    private $bestBefore;
    private $useBy;

    public function __construct(string $title, \DateTime $bestBefore, \DateTime $useBy)
    {
        $this->title = $title;
        $this->bestBefore = $bestBefore;
        $this->useBy = $useBy;
    }

    public function getTitle() :string
    {
        return $this->title;
    }

    public function getBestBefore() : \DateTime
    {
        return $this->bestBefore;
    }

    public function getUseBy() : \DateTime
    {
        return $this->useBy;
    }

    public function canBeUsed() : bool
    {
        return $this->useBy < new \DateTime();
    }
}
