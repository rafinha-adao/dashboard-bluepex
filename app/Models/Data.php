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

        exec("top -bn1 | grep 'Cpu(s)' | sed 's/.*, *\\([0-9.]*\\)%* id.*/\\1/' | awk '{print 100 - $1\"%\"}'", $cpuUsage);
        $cpuUsage = implode('', $cpuUsage);

        exec("free -m | awk '/Mem:/ {print $3\"MB / \"$2\"MB\"}'", $memoryUsage);
        $memoryUsage = implode('', $memoryUsage);

        exec("df -h | awk '/\\/$/ {printf \"%s / %s\", $3, $2}'", $diskUsage);
        $diskUsage = implode('', $diskUsage);

        exec("lsb_release -a", $osInfo);
        $osInfo = implode('', $osInfo);

        $data = [
            'CPU'       => $cpuUsage,
            'MEMORY'    => $memoryUsage,
            'DISK'      => $diskUsage,
            'SO'        => $osInfo
        ];

        return $data;
    }
}
