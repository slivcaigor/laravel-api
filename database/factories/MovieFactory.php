<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake() -> words(rand(1, 3), true),
            'year' => fake() -> year(),
            'cashout' => fake() -> numberBetween(),
        ];
    }
}