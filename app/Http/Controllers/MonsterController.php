<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monsters;
use Inertia\Inertia;

class MonsterController extends Controller
{
    public function getMonster($id)
    {
        $monster = Monsters::find($id);

        if (!$monster) {
            return response()->json(['message' => 'Monster not found'], 404);
        }

        return response()->json([
            'id' => $monster->id,
            'name' => $monster->name,
            'cr' => $monster->cr,
        ]);
    }


    public function getAllMonsters()
    {
        $monsters = Monsters::all(['id', 'name', 'alignment', 'size', 'type', 'cr', 'source_book']);
        return response()->json($monsters);
    }

    public function show($id)
    {
        $monster = Monsters::find($id);

        if (!$monster) {
            return redirect()->route('monsters.index')->with('error', 'Monster not found');
        }

        return Inertia::render('Monsters/Show', [
            'monster' => [
                'id' => $monster->id,
                'name' => $monster->name,
                'cr' => $monster->cr,
            ]
        ]);
    }
}


