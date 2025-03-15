<?php

namespace App\Database\Seeds;

use App\Models\CompanyProfileModel;
use CodeIgniter\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run()
    {
        require_once APPPATH . 'Config/Eloquent.php';

        CompanyProfileModel::create([
            'company_name' => 'PT Maju Jaya Sejahtera',
            'representative_name' => 'Dr. Hadi Wijaya',
            'position' => 'Direktur Utama',
            'signature_image' => 'uploads/signatures/sample-signature.png', // Pastikan gambar ini ada
        ]);
    }
}
