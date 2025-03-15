<?php

namespace App\Filters;

use App\Models\CompanyProfileModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GlobalDataFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Pastikan Eloquent diaktifkan
        service('eloquent');

        // Ambil nama perusahaan dari database
        $company = CompanyProfileModel::first();
        $companyName = $company ? $company->company_name : 'Nama Perusahaan Default';

        // Kirim variabel ke semua view
        $GLOBALS['companyName'] = $companyName;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah request
    }
}
