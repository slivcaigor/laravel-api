<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class TagFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake() -> unique() -> words(rand(1, 3), true),
            'description' => fake() -> boolean() ? fake() -> text() : null,
        ];
    }
}