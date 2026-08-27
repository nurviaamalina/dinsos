<?php

namespace App\Controllers;

class Bidang extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Bidang Linjamsos'
        ];

        return view('bidang', $data);
    }
}