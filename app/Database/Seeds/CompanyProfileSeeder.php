<?php

namespace App\Database\Seeds;

use App\Models\CompanyProfileModel;
use CodeIgniter\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run()
    {
        require_once APPPATH . "Config/Eloquent.php";

        // Cek apakah sudah ada data di tabel company_profiles
        if (CompanyProfileModel::exists()) {
            echo "Data perusahaan sudah ada. Seeder tidak dijalankan.\n";
            return;
        }

        // URL Logo Perusahaan
        $companyLogoUrl = "https://www.ptpn4.co.id/assets/img/favicon.png";
        $storagePath = "uploads/company_logos/"; // Folder penyimpanan

        // Buat folder jika belum ada
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0777, true);
        }

        // Download dan simpan logo ke storage
        $logoName = uniqid("logo_") . ".png"; // Nama file unik
        $logoPath = $storagePath . $logoName;

        try {
            $imageData = file_get_contents($companyLogoUrl);
            if ($imageData !== false) {
                file_put_contents($logoPath, $imageData);
                echo "Logo perusahaan berhasil diunduh dan disimpan: $logoPath\n";
            } else {
                $logoPath = "uploads/company_logos/default-logo.png"; // Gunakan default jika gagal
                echo "Gagal mengunduh logo, menggunakan default: $logoPath\n";
            }
        } catch (\Exception $e) {
            $logoPath = "uploads/company_logos/default-logo.png";
            echo "Terjadi error saat mengunduh logo: " . $e->getMessage() . "\n";
        }

        // Jika belum ada data, tambahkan satu record
        CompanyProfileModel::create([
            "company_name" => "PT Perkebunan Nusantara IV Regional IV",
            "representative_name" => "Hery Kurniawan",
            "position" => "Kepala Bagian SDM & Sistem Manajemen",
            "signature_image" => "uploads/signatures/sample-signature.png", // Pastikan gambar ini ada
            "company_logo" => $logoPath, // Simpan path logo
        ]);

        echo "Seeder berhasil dijalankan: Data perusahaan ditambahkan.\n";
    }
}
