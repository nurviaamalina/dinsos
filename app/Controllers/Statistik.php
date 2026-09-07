<?php

namespace App\Controllers;

class Statistik extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Statistik'
        ];

        return view('Dashboard_statistik/dashboard_statistik', $data);
    }
}