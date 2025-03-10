<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;

class UserController extends BaseController
{
    protected $userModel;
    protected $blade;

    public function __construct()
    {
        // Inisialisasi model dan BladeOneLibrary satu kali untuk digunakan di semua method
        $this->userModel = new UserModel();
        $this->blade = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $data['users'] = $this->userModel->orderBy('created_at', 'DESC')->findAll();
        
        return $this->blade->render('users.index', $data);
    }

    /**
     * Menampilkan form untuk menambah user baru.
     */
    public function new()
    {
        return $this->blade->render('users.create');
    }

    /**
     * Menyimpan data user baru.
     */
    public function create()
    {
        $data = [
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        
        log_message('debug', 'Data yang diterima: ' . print_r($data, true));  

        if (!$this->userModel->save($data)) {
            // Mengembalikan dengan error jika validasi gagal
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/users')->with('success', 'User berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        return $this->blade->render('users.edit', $data);
    }

    /**
     * Memperbarui data user.
     */
    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        // Aturan validasi; pengecekan uniqueness email dan username kecuali milik user yang sedang diupdate
        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email,id,'.$id.']',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,'.$id.']',
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        if ($password) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) data user.
     */
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User berhasil dihapus.');
    }
}
