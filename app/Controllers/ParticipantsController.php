<?php
namespace App\Controllers;

use App\Models\ParticipantsModel;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;
use CodeIgniter\RESTful\ResourceController;

class ParticipantsController extends ResourceController
{
    protected $participantModel;
    protected $userModel;
    protected $blade;

    public function __construct()
    {
        $this->participantModel = new ParticipantsModel();
        $this->userModel        = new UserModel();
        $this->blade            = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar partisipan.
     */
    public function index()
    {
        $data['participants'] = $this->participantModel->findAll();
        return $this->blade->render('participants.index', $data);
    }

    /**
     * Menampilkan form untuk menambah partisipan baru.
     */
    public function create()
    {
        return $this->blade->render('participants.create');

    }

    /**
     * Menyimpan data partisipan baru beserta data pengguna baru.
     */
    public function store()
    {
        $rules = [
            // Validasi untuk data user
            'email'    => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            // Validasi untuk data partisipan
            'full_name'   => 'required',
            'institution' => 'required',
            'level'       => 'required',
            'start_date'  => 'required',
            'end_date'    => 'required',
            'status'      => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Buat data user baru
        $userData = [
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];
        $this->userModel->insert($userData);
        $userId = $this->userModel->getInsertID();

        // Buat data partisipan dengan user_id yang baru
        $participantData = [
            'user_id'     => $userId,
            'full_name'   => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'level'       => $this->request->getPost('level'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status')
        ];
        $this->participantModel->insert($participantData);

        return redirect()->to('/participants')->with('success', 'Partisipan berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit partisipan dan data pengguna terkait.
     */
    public function edit($id = null)
    {
        $participant = $this->participantModel->find($id);
        if (!$participant) {
            return $this->failNotFound('Partisipan tidak ditemukan');
        }
        $user = $this->userModel->find($participant->user_id);
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
        $participant = $this->participantModel->find($id);
        if (!$participant) {
            return $this->failNotFound('Partisipan tidak ditemukan');
        }

        $rules = [
            // Validasi data user (abaikan record milik user yang sedang diupdate)
            'email'    => "required|valid_email|is_unique[users.email,id,{$participant->user_id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$participant->user_id}]",
            // Validasi data partisipan
            'full_name'   => 'required',
            'institution' => 'required',
            'level'       => 'required',
            'start_date'  => 'required',
            'end_date'    => 'required',
            'status'      => 'required'
        ];

        // Jika password diisi, validasi minimal
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data user
        $userData = [
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username')
        ];
        if ($this->request->getPost('password')) {
            $userData['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $this->userModel->update($participant->user_id, $userData);

        // Update data partisipan
        $participantData = [
            'full_name'   => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'level'       => $this->request->getPost('level'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status')
        ];
        $this->participantModel->update($id, $participantData);

        return redirect()->to('/participants')->with('success', 'Partisipan berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) data partisipan.
     * Jika diperlukan, juga dapat menghapus data pengguna terkait.
     */
    public function delete($id = null)
    {
        $participant = $this->participantModel->find($id);
        if (!$participant) {
            return $this->failNotFound('Partisipan tidak ditemukan');
        }
        $this->participantModel->delete($id);
        // Jika ingin menghapus data user juga, aktifkan baris berikut:
        // $this->userModel->delete($participant->user_id);
        return redirect()->to('/participants')->with('success', 'Partisipan berhasil dihapus.');
    }
}
