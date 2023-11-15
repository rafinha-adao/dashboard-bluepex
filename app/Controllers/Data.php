<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Data as ModelsData;

class Data extends BaseController
{
    public function index()
    {
        $dataModel = model(ModelsData::class);
        return $this->response->setJSON($dataModel->getData());
    }
}
