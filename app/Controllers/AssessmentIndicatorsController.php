<?php

namespace App\Controllers;

use App\Models\AssessmentIndicatorModel;
use App\Libraries\BladeOneLibrary;
use CodeIgniter\Exceptions\PageNotFoundException;

class AssessmentIndicatorsController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    public function index()
    {
        $data['indicators'] = AssessmentIndicatorModel::get();
        return $this->blade->render('assessment_indicators.index', $data);
    }

    public function new()
    {
        return $this->blade->render('assessment_indicators.create');
    }

    public function create()
    {
        $rules = ['component' => 'required'];
        $validation = \Config\Services::validation()->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Simpan data menggunakan Eloquent
        AssessmentIndicatorModel::create([
            'component' => $this->request->getPost('component'),
        ]);

        return redirect()->to('/assessment-indicators')->with('success', 'Indikator penilaian berhasil dibuat.');
    }



    public function edit($id)
    {
        $indicator = AssessmentIndicatorModel::find($id);
        if (!$indicator) {
            return redirect()->back()->with('errors','Indikator tidak ditemukan');
        }
        $data['indicator'] = $indicator;
        return $this->blade->render('assessment_indicators.edit', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if (!AssessmentIndicatorModel::update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', AssessmentIndicatorModel::errors());
        }
        return redirect()->to('/assessment-indicators')->with('success', 'Indikator penilaian berhasil diperbarui.');
    }

    public function delete($id)
    {
        $indicator = AssessmentIndicatorModel::find($id);
        if (!$indicator) {
            return redirect()->back()->with('errors','Indikator tidak ditemukan');
        }
        $indicator->delete($id);
        return redirect()->to('/assessment-indicators')->with('success', 'Indikator penilaian berhasil dihapus.');
    }
}
