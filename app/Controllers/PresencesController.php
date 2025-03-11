<?php

namespace App\Controllers;

use App\Models\PresencesModel;
use App\Libraries\BladeOneLibrary;
use CodeIgniter\Exceptions\PageNotFoundException;

class PresencesController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar presensi.
     */
    public function index()
    {
        $today = date('Y-m-d');
        // Mengambil data presensi dengan urutan tanggal (misalnya DESC)
        $presences = PresencesModel::orderBy('date', 'DESC')->get();

        // Cek apakah sudah ada check_in hari ini
        $hasCheckInToday = $presences->contains(function ($presence) use ($today) {
            return $presence->date === $today && !empty($presence->check_in);
        });

        $data = [
            'presences' => $presences,
            'hasCheckInToday' => $hasCheckInToday
        ];
        return $this->blade->render('presences.index', $data);
    }

    /**
     * Menampilkan form untuk input presensi baru.
     */
    public function new()
    {
        return $this->blade->render('presences.create');
    }

    /**
     * Menyimpan data presensi baru.
     */
    public function create()
    {
        $data = $this->request->getPost();

        // Validasi menggunakan CodeIgniter Validation (sesuaikan aturan jika diperlukan)
        $validation = \Config\Services::validation();
        $rules = [
            'participant_id' => 'required|integer|is_natural_no_zero',
            'date'           => 'required|valid_date[Y-m-d]',
            'check_in'       => 'required|valid_date[H:i:s]',
            'check_out'      => 'permit_empty|valid_date[H:i:s]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        try {
            $presence = PresencesModel::create($data);
            if (!$presence) {
                return redirect()->back()->withInput()->with('errors', ['Gagal membuat presensi.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }
        return redirect()->to('/presences')->with('success', 'Presensi berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit presensi.
     */
    public function edit($id)
    {
        $presence = PresencesModel::find($id);
        if (!$presence) {
            return redirect()->back()->with('errors','Presensi tidak ditemukan');
        }
        $data = ['presence' => $presence];
        return $this->blade->render('presences.edit', $data);
    }

    /**
     * Memperbarui data presensi.
     */
    public function update($id)
    {
        $presence = PresencesModel::find($id);
        if (!$presence) {
            return redirect()->back()->with('errors','Presensi tidak ditemukan');
        }

        $data = $this->request->getPost();

        $validation = \Config\Services::validation();
        $rules = [
            'participant_id' => 'required|integer|is_natural_no_zero',
            'date'           => 'required|valid_date[Y-m-d]',
            'check_in'       => 'required|valid_date[H:i:s]',
            'check_out'      => 'permit_empty|valid_date[H:i:s]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }
        
        try {
            $presence->update($data);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }
        return redirect()->to('/presences')->with('success', 'Presensi berhasil diperbarui.');
    }

    /**
     * Menghapus data presensi.
     */
    public function delete($id)
    {
        $presence = PresencesModel::find($id);
        if (!$presence) {
            return redirect()->back()->with('errors','Presensi tidak ditemukan');
        }
        try {
            $presence->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }
        return redirect()->to('/presences')->with('success', 'Presensi berhasil dihapus.');
    }
}
