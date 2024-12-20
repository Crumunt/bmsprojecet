<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class ViewBuilding extends Controller
{
    //
    public function loadBuilding($id)
    {

        $project = Building::with('tasks')->find($id);

        if ($project) {
            return view('view-building', ['building_data' => $project])->render();
        }

        return view('dashboard')->render();
    }
}
