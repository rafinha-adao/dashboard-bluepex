<?php

namespace App\Models;

use CodeIgniter\Model;

class Data extends Model
{
    /**
     * linux
     */

    public function getCpuUsage()
    {
        exec("top -b -n 1 | grep '%Cpu(s)'", $output);

        preg_match('/\d+\.\d+/', $output[0], $matches);

        $data = [
            'usage' => floatval($matches[0]),
            'available' => 100 - floatval($matches[0])
        ];

        return $data;
    }

    public function getMemoryUsage()
    {
        exec("free -m", $output);

        $values = preg_split('/\s+/', $output[1]);

        $data = [
            'total' => intval($values[1]),
            'used' => intval($values[2]),
            'free' => intval($values[3]),
            'used_percent' => (floatval($values[2]) / intval($values[1])) * 100
        ];

        return $data;
    }

    public function getDiskUsage()
    {
        exec("df -h", $output);

        $values = preg_split('/\s+/', $output[1]);

        $data = [
            'total' => intval($values[1]),
            'used' => intval($values[2]),
            'free' => intval($values[3]),
            'used_percent' => floatval($values[4])
        ];

        return $data;
    }

    public function getOS()
    {
        exec("uname -a", $output);
        $data = implode(" ", $output);

        return $data;
    }

    /**
     * MacOS
     */
    /*
    public function getCpuUsage()
    {
        exec("top -l 1 | grep 'CPU usage'", $output);

        preg_match('/\d+\.\d+/', $output[0], $matches);

        $data = [
            'usage' => floatval($matches[0]),
            'available' => 100 - floatval($matches[0])
        ];

        return $data;
    }

    public function getMemoryUsage()
    {
        exec("top -l 1 -s 0 | grep PhysMem", $output);

        preg_match_all('/\d+/', $output[0], $matches);

        $total = intval($matches[0][0]);
        $used = intval($matches[0][1]);
        $free = $total - $used;
        $used_percent = ($used / $total) * 100;

        $data = [
            'total' => $total,
            'used' => $used,
            'free' => $free,
            'used_percent' => $used_percent
        ];

        return $data;
    }

    public function getDiskUsage()
    {
        exec("df -h /", $output);

        $values = preg_split('/\s+/', $output[1]);

        $data = [
            'total' => intval($values[1]),
            'used' => intval($values[2]),
            'free' => intval($values[3]),
            'used_percent' => floatval($values[4])
        ];

        return $data;
    }

    public function getOS()
    {
        exec("uname -a", $output);
        $data = implode(" ", $output);

        return $data;
    }
    */
}
