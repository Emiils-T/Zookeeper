<?php

namespace App;

class Food
{
    private string $food;

    public function __construct(string $food)
    {
        $this->food = $food;
    }

    public function getFood(): string
    {
        return $this->food;
    }
}