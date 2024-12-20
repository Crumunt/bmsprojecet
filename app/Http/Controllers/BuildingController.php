<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Contractor;
use App\Models\Task;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {

        $buildingData = Building::with('tasks')->get();

        return view('Manage.manage-buildings', ['buildingData' => $buildingData]);
        // dd($contractors);
    }

    public function store(Request $request)
    {

        // $data = $request->validate([
        //     'building_name' => 'required',
        //     'contractor_name' => 'required',
        //     'building_location' => 'required',
        //     'company_name' => 'required',
        //     'budget' => 'required',
        //     'starting_date' => 'required',
        //     'end_date' => 'required'
        // ]);

        $buildingData = $this->fetchBuildingData();

        foreach ($buildingData as $data) {
            $views[] = view(
                'components.dashboard.project-card',
                [
                    // 'building_name' => $data->building_name,
                    // 'tasks' => count($data->tasks),
                    // 'id' => $data->id,
                    // 'completionRate' => rand(1, 100)
                    $data
                ]
            )->render();
        }

        $combinedHtml = implode('', $views);

        return response()->json(['html' => $combinedHtml]);
    }

    private function fetchBuildingData()
    {

        $buildingData = Building::with('tasks')->get();

        $refinedBuildingData = [];
        foreach ($buildingData as $data) {
            array_push(
                $refinedBuildingData,
                [
                    'building_name' => $data->building_name,
                    'tasks' => count($data->tasks),
                    'id' => $data->id,
                    'completionRate' => rand(1, 100)
                ]
            );
        }

        return $refinedBuildingData;
    }
}
