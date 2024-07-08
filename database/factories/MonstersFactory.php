<?php

namespace Database\Factories;

use App\Models\Monsters;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MonstersFactory extends Factory
{
    protected $model = Monsters::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'alignment' => $this->faker->randomElement(['Lawful Good', 'Neutral', 'Chaotic Evil']),
            'size' => $this->faker->randomElement(['Tiny', 'Small', 'Medium', 'Large', 'Huge', 'Gargantuan']),
            'type' => $this->faker->word,
            'cr' => $this->faker->numberBetween(0, 30), // Challenge Rating
            'environment' => $this->faker->word,
            'source_book' => $this->faker->word,
            'is_legendary' => $this->faker->boolean,
            'xp_amount' => $this->faker->numberBetween(10, 50000),
            'hit_points' => $this->faker->numberBetween(1, 1000),
            'initiative_modifier' => $this->faker->numberBetween(-5, 5),
            'is_dead' => $this->faker->boolean,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
