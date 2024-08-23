<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Fetch the list of all monsters
        $monsterListResponse = Http::get("https://www.dnd5eapi.co/api/monsters");

        if ($monsterListResponse->ok()) {
            $monsterList = $monsterListResponse->json()['results'];

            foreach ($monsterList as $monster) {
                // Fetch detailed data for each monster
                $monsterDetailResponse = Http::get("https://www.dnd5eapi.co{$monster['url']}");

                if ($monsterDetailResponse->ok()) {
                    $data = $monsterDetailResponse->json();

                    // Calculate initiative modifier from Dexterity
                    $dexterity = $data['dexterity'];
                    $initiative_modifier = floor(($dexterity - 10) / 2);

                    // Insert monster data into the database
                    DB::table('monsters')->insert([
                        'name' => $data['name'],
                        'alignment' => $data['alignment'] ?? null,
                        'size' => $data['size'],
                        'type' => $data['type'],
                        'cr' => $data['challenge_rating'],
                        'source_book' => 'Monster Manual',
                        'is_legendary' => isset($data['legendary_actions']),
                        'xp_amount' => $data['xp'],
                        'hit_points' => $data['hit_points'],
                        'initiative_modifier' => $initiative_modifier,
                        'is_dead' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $this->command->error("Failed to fetch data for {$monster['name']}");
                }
            }
        } else {
            $this->command->error("Failed to fetch the monster list.");
        }
    }
}
