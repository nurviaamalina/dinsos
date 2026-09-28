<?php

namespace App\Controllers;

use App\Models\InstagramModel;

class Instagram extends BaseController
{
    public function index()
{
    $model = new InstagramModel();

    $instagram = $model
        ->orderBy('posted_at', 'DESC')
        ->findAll(6);

    return view('Instagram/index', [
        'instagram' => $instagram
    ]);
}
}