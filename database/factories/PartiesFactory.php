<?php

namespace Database\Factories;

use App\Models\Parties;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PartiesFactory extends Factory
{
    protected $model = Parties::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}