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
            'signature' => 'permit_empty|uploaded[signature]|max_size[signature,2048]|is_image[signature]|mime_in[signature,image/png,image/jpeg,image/jpg]',
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
        ];

        // Handle file upload untuk tanda tangan
        $signatureFile = $this->request->getFile('signature');
        if ($signatureFile && $signatureFile->isValid() && !$signatureFile->hasMoved()) {
            $signatureName = $signatureFile->getRandomName();
            $signatureFile->move('uploads/signatures/', $signatureName);

            // Hapus gambar lama jika ada dan file masih tersedia
            if (!empty($company->signature) && file_exists($company->signature)) {
                unlink($company->signature);
            }

            $data['signature'] = 'uploads/signatures/' . $signatureName;
        }

        // Handle file upload untuk logo perusahaan
        $logoFile = $this->request->getFile('company_logo');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $logoName = $logoFile->getRandomName();
            $logoFile->move('uploads/company_logos/', $logoName);

            // Hapus gambar lama jika ada dan file masih tersedia
            if (!empty($company->company_logo) && file_exists($company->company_logo)) {
                unlink($company->company_logo);
            }

            $data['company_logo'] = 'uploads/company_logos/' . $logoName;
        }

        // Update data perusahaan
        $company->update($data);

        return redirect()->back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
