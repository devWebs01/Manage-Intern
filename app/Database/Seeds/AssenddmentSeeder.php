<?php

namespace App\Database\Seeds;

use App\Models\AssessmentIndicatorModel;
use CodeIgniter\Database\Seeder;

class AssenddmentSeeder extends Seeder
{
    public function run()
    {
         // Pastikan Eloquent sudah di-boot
         require_once APPPATH . 'Config/Eloquent.php';
         
         $data = [
            ['component' => 'Integritas (Etika, Moral dan Kesungguhan)'],
            ['component' => 'Ketepatan waktu dalam bekerja'],
            ['component' => 'Keahlian berdasarkan bidang ilmu'],
            ['component' => 'Kerjasama dalam tim'],
            ['component' => 'Komunikasi'],
            ['component' => 'Penggunaan teknologi informasi'],
            ['component' => 'Pengembangan diri'],
        ];
        
        foreach ($data as $key => $item) {
            AssessmentIndicatorModel::create([
                'component' => $item['component']
            ]);
        }
        
    }
}
