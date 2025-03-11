<?php

namespace App\Controllers;

use App\Models\LogbooksModel;
use App\Libraries\BladeOneLibrary;
use CodeIgniter\Exceptions\PageNotFoundException;

class LogbooksController extends BaseController
{
    protected $logbookModel;
    protected $blade;

    public function __construct()
    {
        // Inisialisasi model dan BladeOneLibrary
        $this->logbookModel = new LogbooksModel();
        $this->blade        = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar logbook.
     */
    public function index()
    {
        $data['logbooks'] = $this->logbookModel->orderBy('created_at', 'DESC')->get();
        return $this->blade->render('logbooks.index', $data);
    }

    /**
     * Menampilkan form untuk membuat logbook baru.
     */
    public function new()
    {
        return $this->blade->render('logbooks.create');
    }

    /**
     * Menyimpan data logbook baru.
     */
    public function create()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'participant_id' => 'required|integer|is_natural_no_zero',
            'date'           => 'required|valid_date[Y-m-d]',
            'activity'       => 'required|min_length[10]|max_length[1000]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        
        // Ambil data yang telah tervalidasi
        $data = $this->request->getPost(['participant_id', 'date', 'activity']);
        
        // Buat logbook dengan Eloquent
        $logbook = LogbooksModel::create($data);
        if (!$logbook) {
            return redirect()->back()->withInput()->with('errors', ['Unable to create logbook.']);
        }
        return redirect()->to('/logbooks')->with('success', 'Logbook berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit logbook.
     */
    public function edit($id)
    {
        $logbook = LogbooksModel::find($id);
        if (!$logbook) {
            return redirect()->back()->with('errors','Logbook tidak ditemukan');
        }
        $data['logbook'] = $logbook;
        return $this->blade->render('logbooks.edit', $data);
    }

    /**
     * Memperbarui data logbook.
     */
    public function update($id)
    {
        $logbook = LogbooksModel::find($id);
        if (!$logbook) {
            return redirect()->back()->with('errors','Logbook tidak ditemukan');
        }
        
        $validation = \Config\Services::validation();
        $rules = [
            'participant_id' => 'required|integer|is_natural_no_zero',
            'date'           => 'required|valid_date[Y-m-d]',
            'activity'       => 'required|min_length[10]|max_length[1000]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        
        $data = $this->request->getPost(['participant_id', 'date', 'activity']);
        
        // Perbarui data logbook
        $logbook->update($data);
        return redirect()->to('/logbooks')->with('success', 'Logbook berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) data logbook.
     */
    public function delete($id)
    {
        $logbook = LogbooksModel::find($id);
        if (!$logbook) {
            return redirect()->back()->with('errors','Logbook tidak ditemukan');
        }
        $logbook->delete();
        return redirect()->to('/logbooks')->with('success', 'Logbook berhasil dihapus.');
    }
}
