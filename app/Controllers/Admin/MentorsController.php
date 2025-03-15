<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;

class MentorsController extends BaseController
{
   
        protected $blade;
    
        public function __construct()
        {
            // Inisialisasi model dan BladeOneLibrary satu kali untuk digunakan di semua method
            $this->blade = new BladeOneLibrary();
        }
    
        /**
         * Menampilkan daftar user.
         */
        public function index()
        {
            $data['mentors'] = UserModel::where('role', 'MENTOR')->latest()->get();
    
            return $this->blade->render('mentors.index', $data);
        }
    
        /**
         * Menampilkan form untuk menambah user baru.
         */
        public function new()
        {
            return $this->blade->render('mentors.create');
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
        
            $data = $this->request->getPost(['email', 'username']);
            
            if ($password = $this->request->getPost('password')) {
                $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $data['role'] = 'MENTOR';
        
            UserModel::create($data);
            
            session()->setFlashdata('success', 'User berhasil ditambahkan.');
            return redirect()->to('/mentors');
        }
    
        /**
         * Menampilkan form untuk mengedit user.
         */
        public function edit($id)
        {
            $data['user'] = UserModel::find($id);
    
            if (!$data['user']) {
                return redirect()->back()->with('errors','User tidak ditemukan');
            }
    
            return $this->blade->render('mentors.edit', $data);
        }
    
        /**
         * Memperbarui data user.
         */
        public function update($id)
        {
            $user = UserModel::find($id);
            if (!$user) {
                session()->setFlashdata('error', 'User tidak ditemukan.');
                return redirect()->to('/mentors');
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

            $data['role'] = 'MENTOR';
    
            $password = $this->request->getPost('password');
            if ($password) {
                $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
            }
            
            try {
                $user->update($data);
                return redirect()->to('/mentors')->with('success', 'User berhasil diperbarui.');
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
                    return redirect()->to('/mentors')->with('success', 'User berhasil dihapus.');
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('errors', [$th->getMessage()]);
                }
            }
        }
    
    
}
