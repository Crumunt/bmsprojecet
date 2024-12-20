<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GeneratePdfController extends Controller
{
    //
    public function generatePdf($building_id)
    {
        $building_data = Building::with('tasks')->find($building_id);

        $data = [
            'building_data' => $building_data
        ];

        if ($building_data) {
            $pdf = Pdf::loadView('Manage.generate-report', $data);
            return $pdf->download('building_report.pdf');
        }
    }
}
