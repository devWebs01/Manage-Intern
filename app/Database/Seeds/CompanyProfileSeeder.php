<?php

namespace App\Database\Seeds;

use App\Models\CompanyProfileModel;
use CodeIgniter\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run()
    {
        require_once APPPATH . 'Config/Eloquent.php';

        // Cek apakah sudah ada data di tabel company_profiles
        if (CompanyProfileModel::exists()) {
            echo "Data perusahaan sudah ada. Seeder tidak dijalankan.\n";
            return;
        }

        // Jika belum ada data, maka tambahkan satu record
        CompanyProfileModel::create([
            'company_name' => 'PT Maju Jaya Sejahtera',
            'representative_name' => 'Dr. Hadi Wijaya',
            'position' => 'Direktur Utama',
            'signature_image' => 'uploads/signatures/sample-signature.png', // Pastikan gambar ini ada
        ]);

        echo "Seeder berhasil dijalankan: Data perusahaan ditambahkan.\n";
    }
}
