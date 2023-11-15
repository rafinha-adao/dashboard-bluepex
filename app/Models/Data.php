<?php

namespace App\Models;

use CodeIgniter\Model;

class Data extends Model
{
    public function getData()
    {
        /**
         * get CPU data
         * get memory data
         * get disk data
         * get SO data
         */

         // test json data
        $data = [
            'CPU' => 'CPU DATA',
            'MEMORY' => 'MEMORY DATA',
            'DISK' => 'DISK DATA',
            'SO' => 'SO DATA'
        ];

        return $data;
    }
}
