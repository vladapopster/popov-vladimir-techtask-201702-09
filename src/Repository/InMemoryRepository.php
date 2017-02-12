<?php

namespace Lunch\Repository;

class InMemoryRepository
{
    protected $data;

    public function loadData(string $source)
    {
        if (!file_exists($source)) {
            throw new \RuntimeException('Invalid repository source.');
        }

        $json = file_get_contents($source);

        $this->data = json_decode($json, true);
    }
}