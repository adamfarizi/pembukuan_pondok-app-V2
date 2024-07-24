<?php 

namespace App\Helpers;

class SemesterHelper
{
    public static function getCurrentSemester()
    {
        $bulan = date('n');
        $tahun = date('Y');

        if (in_array($bulan, [1, 2, 3, 4, 5, 6])) {
            return ['semester' => 'genap', 'tahun' => $tahun];
        } else {
            return ['semester' => 'ganjil', 'tahun' => $tahun];
        }
    }
}
