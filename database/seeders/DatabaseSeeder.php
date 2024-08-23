<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $response = Http::get('https://api.open5e.com/v1/monsters/');
        $monsters = $response->json();

        foreach ($monsters['results'] as $monster) {
            $monsterDetail = Http::get("https://api.open5e.com/v1/monsters/{$monster['slug']}")->json();
            DB::table('monsters')->insert([
                'name' => $monsterDetail['name'],
                'alignment' => $monsterDetail['alignment'],
                'size' => $monsterDetail['size'],
                'type' => $monsterDetail['type'],
                'cr' => $monsterDetail['cr'],
                'source_book' => $monsterDetail['document__title'],
                'is_legendary' => !empty($monsterDetail['legendary_actions']),
                'xp_amount' => $this->calculateXP($monsterDetail['cr']),
                'hit_points' => $monsterDetail['hit_points'],
                'initiative_modifier' => $this->calculateInitiative($monsterDetail['dexterity']),
                'is_dead' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function calculateXP($cr): int
    {
        $xpTable = [
            0 => 10, 0.125 => 25, 0.25 => 50, 0.5 => 100, 1 => 200,
            2 => 450, 3 => 700, 4 => 1100, 5 => 1800, 6 => 2300,
            7 => 2900, 8 => 3900, 9 => 5000, 10 => 5900, 11 => 7200,
            12 => 8400, 13 => 10000, 14 => 11500, 15 => 13000, 16 => 15000,
            17 => 18000, 18 => 20000, 19 => 22000, 20 => 25000, 21 => 33000,
            22 => 41000, 23 => 50000, 24 => 62000, 25 => 75000, 26 => 90000,
            27 => 105000, 28 => 120000, 29 => 135000, 30 => 155000,
        ];

        return $xpTable[$cr] ?? 0;
    }

    private function calculateInitiative($dexterity): float
    {
        return floor(($dexterity - 10) / 2);
    }
}
