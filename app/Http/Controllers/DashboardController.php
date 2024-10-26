<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $users = [
            [
                'name'=>'alexa',
                'age'=>'19'
            ],
            [
                'name'=>'lorenz',
                'age'=>'20'
            ]
        ];
        return view("dashboard");
    }
}
