<?php

namespace App;
class Animal
{
    private string $name;
    private int $happinessValue;
    private string $favouriteFood;
    private int $foodReserves;
    private ?string $lastTime = null;

    public function __construct(string $name, int $happinessValue, string $favouriteFood, int $foodReserves)
    {

        $this->name = $name;
        $this->happinessValue = $happinessValue;
        $this->favouriteFood = $favouriteFood;
        $this->foodReserves = $foodReserves;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function play(): void
    {
        $this->happinessValue += 10;
        $this->foodReserves -= 1;
    }

    public function work(): void
    {
        $this->happinessValue -= 5;
        $this->foodReserves -= 3;
    }

    public function feed($food): void
    {
        if ($food === $this->favouriteFood) {
            $this->foodReserves += 10;
        } else {
            $this->happinessValue -= 5;
            $this->foodReserves -= 20;
        }
    }

    public function pet(): void
    {
        $this->happinessValue += 10;
    }

    public function getHappinessValue(): int
    {
        return $this->happinessValue;
    }

    public function setLastTime(string $lastTime): void
    {
        $this->lastTime = $lastTime;
    }

    public function getLastTime(): ?string
    {
        return $this->lastTime;
    }

    public function getFoodReserves(): int
    {
        return $this->foodReserves;
    }

    public function getDiscription(): string
    {
        return (
            "$this->name\n" .
            "Happiness value: $this->happinessValue\n" .
            "Favourite food: $this->favouriteFood\n" .
            "Food reserve:  $this->foodReserves"
        );
    }
}