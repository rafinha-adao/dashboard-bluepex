<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Data as DataModel;

class Data extends BaseController
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $dataModel = model(DataModel::class);

        $data = [
            'cpu'       => $dataModel->getCpuUsage(),
            'memory'    => $dataModel->getMemoryUsage(),
            'disk'      => $dataModel->getDiskUsage(),
            'os'        => $dataModel->getOS()
        ];

        return $this->response->setJSON($data);
    }
}
