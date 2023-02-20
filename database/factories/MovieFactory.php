<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class MovieFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake() -> words(rand(1, 3), true),
            'year' => fake() -> year('now'),
            'cashout' => fake() -> numberBetween(100000000, 1000000000000),
        ];
    }
}