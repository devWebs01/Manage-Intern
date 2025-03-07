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
        $data['users'] = $this->userModel->latest()->get();

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
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
    
        UserModel::create($data);
        
        session()->setFlashdata('success', 'User berhasil ditambahkan.');
        return redirect()->to('/users');
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
        $user = UserModel::find($id);
        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/users');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'password' => 'permit_empty|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        try {
            $user->update($data);
            return redirect()->to('/users')->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', [$e->getMessage()]);
        }
    }

    /**
     * Menghapus (soft delete) data user.
     */
    public function delete($id)
    {
        $user = UserModel::find($id);
        if ($user) {
            try {

                $user->delete();
                return redirect()->to('/users')->with('success', 'User berhasil dihapus.');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->with('errors', [$th->getMessage()]);
            }
        }
    }
}
