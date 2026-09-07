<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Statistik extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Statistik'
        ];

        return view('admin/dashboard_statistik', $data);
    }
}