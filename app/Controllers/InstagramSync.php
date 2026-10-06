<?php

namespace App\Controllers;

use App\Libraries\InstagramSyncService;

class InstagramSync extends BaseController
{
    public function index()
    {
        $result = (new InstagramSyncService())->sync();

        return $this->response->setJSON($result);
    }
}