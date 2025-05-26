<?php

namespace App\Controllers\Participant;

use App\Models\LogbooksModel;
use App\Libraries\BladeOneLibrary;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Controllers\BaseController;

class LogbooksController extends BaseController
{
    protected $logbookModel;
    protected $blade;

    public function __construct()
    {
        // Inisialisasi model dan BladeOneLibrary
        $this->logbookModel = new LogbooksModel();
        $this->blade = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar logbook.
     */
    public function index()
    {
        $user = service('authentication')->user();
        $userModel = new UserModel();
        $userData = $userModel->find($user->id); // Dapatkan user lengkap (dengan relasi)

        $participant = $userData->participant;

        if (!$participant) {
            // Tidak ada relasi participant, bisa redirect atau tampilkan pesan error
            return redirect()->back()->with('error', 'Data peserta tidak ditemukan.');
        }

        // Ambil logbook milik peserta yang sedang login
        $data['logbooks'] = \App\Models\LogbooksModel::where('participant_id', $participant->id)
            ->orderBy('created_at', 'DESC')
            ->get();

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
            'date' => 'required|valid_date[Y-m-d]',
            'activity' => 'required|min_length[10]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data yang telah tervalidasi
        $data = $this->request->getPost(['date', 'activity']);

        $user = UserModel::find(user_id());
        $data['participant_id'] = $user->participant->id;

        // Buat logbook dengan Eloquent
        $logbook = LogbooksModel::create($data);
        if (!$logbook) {
            return redirect()->back()->withInput()->with('errors', ['Unable to create logbook.']);
        }
        return redirect()->to('/logbooks')->with('success', 'Logbook berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengshow logbook.
     */
    public function show($id)
    {
        $logbook = LogbooksModel::find($id);
        if (!$logbook) {
            return redirect()->back()->with('errors', 'Logbook tidak ditemukan');
        }
        $data['logbook'] = $logbook;
        return $this->blade->render('logbooks.show', $data);
    }

    /**
     * Menampilkan form untuk mengedit logbook.
     */
    public function edit($id)
    {
        $logbook = LogbooksModel::find($id);
        if (!$logbook) {
            return redirect()->back()->with('errors', 'Logbook tidak ditemukan');
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
            return redirect()->back()->with('errors', 'Logbook tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'date' => 'required|valid_date[Y-m-d]',
            'activity' => 'required|min_length[10]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = $this->request->getPost(['date', 'activity']);

        $user = UserModel::find(user_id());
        $data['participant_id'] = $user->participant->id;

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
            return redirect()->back()->with('errors', 'Logbook tidak ditemukan');
        }
        $logbook->delete();
        return redirect()->to('/logbooks')->with('success', 'Logbook berhasil dihapus.');
    }
}
