<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PresencesModel;
use App\Libraries\BladeOneLibrary;



use CodeIgniter\HTTP\ResponseInterface;

class PresencesController extends BaseController
{
    protected $presencesModel;
    protected $blade;

    public function __construct()
    {
        $this->presencesModel = new PresencesModel();
        $this->blade = new BladeOneLibrary();
    }

    // Tampilkan semua data presensi
    public function index()
    {
        $today = date('Y-m-d');
        $presences = $this->presencesModel->findAll();
    
        // Cek apakah sudah ada check_in hari ini
        $hasCheckInToday = false;
        foreach ($presences as $presence) {
            if ($presence->date === $today && !empty($presence->check_in)) {
                $hasCheckInToday = true;
                break;
            }
        }
    
        $data = [
            'presences' => $presences,
            'hasCheckInToday' => $hasCheckInToday
        ];
        return $this->blade->render('presences.index', $data);
    }

    // Form untuk input presensi baru
    public function new()
    {
        return $this->blade->render('presences.create');
    }

    // Simpan data presensi baru
    public function create()
    {
        $data = $this->request->getPost();
        log_message('debug', 'Data yang diterima: ' . print_r($data, true));

        if (!$this->presencesModel->insert($data)) {
            log_message('error', 'Gagal menyimpan data: ' . print_r($this->presencesModel->errors(), true));
            return redirect()->back()->withInput()->with('errors', $this->presencesModel->errors());
        }

        return redirect()->to('/presences')->with('success', 'Presensi berhasil ditambahkan.');
    }

    // Form edit presensi
    public function edit($id)
    {
        $data['presence'] = $this->presencesModel->find($id);
        return $this->blade->render('presences.edit', $data);
    }

    // Update data presensi
    public function update($id)
    {
        $data = $this->request->getPost();
        log_message('debug', 'Data yang diterima: ' . print_r($data, true));  

        if (!$this->presencesModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->presencesModel->errors());
        }

        return redirect()->to('/presences')->with('success', 'Presensi berhasil diperbarui.');
    }
}
