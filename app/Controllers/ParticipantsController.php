<?php

namespace App\Controllers;

use App\Models\ParticipantsModel;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;
use CodeIgniter\Exceptions\PageNotFoundException;

class ParticipantsController extends BaseController
{
    protected $participantModel;
    protected $userModel;
    protected $blade;

    public function __construct()
    {
        // Inisialisasi model Eloquent dan BladeOneLibrary
        $this->participantModel = new ParticipantsModel();
        $this->userModel        = new UserModel();
        $this->blade            = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar partisipan.
     */
    public function index()
    {
        // Mengambil data partisipan secara Eloquent
        $data['participants'] = $this->participantModel->orderBy('created_at', 'DESC')->get();
        return $this->blade->render('participants.index', $data);
    }

    /**
     * Menampilkan form untuk menambah partisipan baru.
     */
    public function new()
    {
        return $this->blade->render('participants.create');
    }

    /**
     * Menyimpan data partisipan baru beserta data pengguna baru.
     */
    public function create()
    {
        // Validasi input untuk user dan partisipan
        $validation = \Config\Services::validation();
        $rules = [
            // Validasi untuk User
            'email'    => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            // Validasi untuk Participant
            'full_name'   => 'required|min_length[3]|max_length[255]',
            'institution' => 'required|min_length[3]|max_length[255]',
            'level'       => 'required',
            'start_date'  => 'required|valid_date[Y-m-d]',
            'end_date'    => 'required|valid_date[Y-m-d]',
            'status'      => 'required|in_list[Active, Completed, Dropped]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        
        // Data untuk User
        $userData = [
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        // Buat user dengan Eloquent
        $user = UserModel::create($userData);
        if (!$user) {
            return redirect()->back()->withInput()->with('errors', ['Unable to create user.']);
        }
        
        // Data untuk Participant
        $participantData = [
            'user_id'     => $user->id,
            'full_name'   => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'level'       => $this->request->getPost('level'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status')
        ];
        $participant = ParticipantsModel::create($participantData);
        if (!$participant) {
            return redirect()->back()->withInput()->with('errors', ['Unable to create participant.']);
        }
        
        return redirect()->to('/participants')->with('success', 'Partisipan berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit partisipan dan data pengguna terkait.
     */
    public function edit($id = null)
    {
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            throw new PageNotFoundException('Partisipan tidak ditemukan');
        }
        $user = UserModel::find($participant->user_id);
        if (!$user) {
            throw new PageNotFoundException('Pengguna terkait partisipan tidak ditemukan');
        }
        $data = [
            'participant' => $participant,
            'user'        => $user
        ];
        return $this->blade->render('participants.edit', $data);
    }

    /**
     * Memperbarui data partisipan dan data pengguna terkait.
     */
    public function update($id = null)
    {
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            throw new PageNotFoundException('Partisipan tidak ditemukan');
        }
        $user = UserModel::find($participant->user_id);
        if (!$user) {
            throw new PageNotFoundException('Pengguna terkait partisipan tidak ditemukan');
        }
        
        $validation = \Config\Services::validation();
        $rules = [
            // Validasi data user (abaikan record milik user yang sedang diupdate)
            'email'    => "required|valid_email|is_unique[users.email,id,{$user->id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$user->id}]",
            // Validasi data partisipan
            'full_name'   => 'required|min_length[3]|max_length[255]',
            'institution' => 'required|min_length[3]|max_length[255]',
            'level'       => 'required',
            'start_date'  => 'required|valid_date[Y-m-d]',
            'end_date'    => 'required|valid_date[Y-m-d]',
            'status'      => 'required|in_list[Active, Completed, Dropped]',
        ];
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }
        
        // Update data User
        $userData = [
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];
        if ($this->request->getPost('password')) {
            $userData['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $user->update($userData);
        
        // Update data Participant
        $participantData = [
            'full_name'   => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'level'       => $this->request->getPost('level'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status')
        ];
        $participant->update($participantData);
        
        return redirect()->to('/participants')->with('success', 'Partisipan berhasil diperbarui.');
    }
    
    /**
     * Menghapus (soft delete) data partisipan.
     * Jika diperlukan, juga dapat menghapus data pengguna terkait.
     */
    public function delete($id = null)
    {
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            throw new PageNotFoundException('Partisipan tidak ditemukan');
        }
        
        // Soft delete partisipan
        $participant->delete();
        // Jika ingin menghapus data user juga, bisa diaktifkan:
        // $user = UserModel::find($participant->user_id);
        // if ($user) { $user->delete(); }
        
        return redirect()->to('/participants')->with('success', 'Partisipan berhasil dihapus.');
    }
}
