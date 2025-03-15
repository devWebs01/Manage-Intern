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

        $validation = \Config\Services::validation();
        $validation->setRules([
            'company_name' => 'required',
            'representative_name' => 'required',
            'position' => 'required',
            'signature' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'company_name' => $this->request->getPost('company_name'),
            'representative_name' => $this->request->getPost('representative_name'),
            'position' => $this->request->getPost('position'),
        ];
        // Handle file upload
        if ($file = $this->request->getFile('signature')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/signatures/', $newName);
                $data['signature'] = 'uploads/signatures/' . $newName;
            }
        }

        $company->update($data);

        return redirect()->back()->with('success', 'Profil perusahaan diperbarui.');
    }
}

