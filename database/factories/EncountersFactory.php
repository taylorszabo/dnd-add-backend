<?php

namespace Database\Factories;

use App\Models\Encounters;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EncountersFactory extends Factory
{
    protected $model = Encounters::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
