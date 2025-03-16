<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\BladeOneLibrary;
use App\Models\CompanyProfileModel;
use CodeIgniter\HTTP\ResponseInterface;

class CompanyProfileController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    public function show()
    {
        $data['company'] = CompanyProfileModel::first();
        return $this->blade->render('company_profile.show', $data);
    }

    public function update()
    {
        $company = CompanyProfileModel::first();

        if (!$company) {
            return redirect()->back()->with('errors', ['company' => 'Profil perusahaan tidak ditemukan.']);
        }

        // Validasi Input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'company_name' => 'required|string|max_length[255]',
            'representative_name' => 'required|string|max_length[255]',
            'position' => 'required|string|max_length[255]',
            'signature_data' => 'permit_empty', // Validasi untuk gambar tanda tangan
            'signature_code' => 'permit_empty', // Validasi untuk JSON stroke
            'company_logo' => 'permit_empty|uploaded[company_logo]|max_size[company_logo,2048]|is_image[company_logo]|mime_in[company_logo,image/png,image/jpeg,image/jpg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'company_name' => $this->request->getPost('company_name'),
            'representative_name' => $this->request->getPost('representative_name'),
            'position' => $this->request->getPost('position'),
            'signature_code' => $this->request->getPost('signature_code'), // Simpan JSON stroke
        ];

        // 🛠 **Simpan tanda tangan sebagai file gambar**
        $signatureData = $this->request->getPost('signature_data');
        if (!empty($signatureData)) {
            $folderPath = 'uploads/signatures/';

            // Hapus tanda tangan lama jika ada
            if (!empty($company->signature) && file_exists($company->signature)) {
                unlink($company->signature);
            }

            // Dekode base64 menjadi file gambar
            $imageParts = explode(";base64,", $signatureData);
            $imageTypeAux = explode("image/", $imageParts[0]);
            $imageType = $imageTypeAux[1];
            $imageBase64 = base64_decode($imageParts[1]);

            // Buat nama file unik
            $fileName = uniqid() . '.' . $imageType;
            $filePath = $folderPath . $fileName;

            // Simpan file gambar
            file_put_contents($filePath, $imageBase64);

            // Simpan path ke database
            $data['signature'] = $filePath;
        }

        // Update data perusahaan
        $company->update($data);

        return redirect()->back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

}
