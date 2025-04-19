<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;
use Myth\Auth\Password;


class UserController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $data['users'] = UserModel::where('role', 'ADMIN')->latest()->get();
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
            'avatar' => 'permit_empty|uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = $this->request->getPost(['email', 'username']);
        $data['role'] = 'ADMIN';
        $data['password_hash'] = Password::hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        // Handle file upload avatar
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/avatars/', $newName);
            $data['avatar'] = 'uploads/avatars/' . $newName;
        }

        UserModel::create($data);
        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit($id)
    {
        $data['user'] = UserModel::find($id);
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
            return redirect()->to('/users')->with('error', 'User tidak ditemukan.');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'password' => 'permit_empty|min_length[6]',
            'avatar' => 'permit_empty|uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $data['password_hash'] = Password::hash($password, PASSWORD_DEFAULT);
        }

        // Handle file upload avatar
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/avatars/', $newName);

            // Hapus avatar lama jika ada
            if (!empty($user->avatar) && file_exists($user->avatar)) {
                unlink($user->avatar);
            }

            $data['avatar'] = 'uploads/avatars/' . $newName;
        }

        $user->update($data);
        return redirect()->to('/users')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus (soft delete) data user.
     */
    public function delete($id)
    {
        $user = UserModel::find($id);
        if ($user) {
            try {
                // Hapus avatar jika ada
                if (!empty($user->avatar) && file_exists($user->avatar)) {
                    unlink($user->avatar);
                }

                $user->delete();
                return redirect()->to('/users')->with('success', 'User berhasil dihapus.');
            } catch (\Throwable $th) {
                return redirect()->back()->withInput()->with('errors', [$th->getMessage()]);
            }
        }
    }
}
