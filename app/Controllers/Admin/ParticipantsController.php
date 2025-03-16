<?php

namespace App\Controllers\Admin;

use App\Models\ParticipantsModel;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;
use App\Controllers\BaseController;

class ParticipantsController extends BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeOneLibrary();
    }

    /**
     * Menampilkan daftar partisipan.
     */
    public function index()
    {
        $data['participants'] = ParticipantsModel::orderBy('created_at', 'DESC')->get();
        return $this->blade->render('participants.index', $data);
    }

    /**
     * Menampilkan form untuk menambah partisipan baru.
     */
    public function new()
    {
        $data['mentors'] = UserModel::where('role', 'MENTOR')->get();
        return $this->blade->render('participants.create', $data);
    }

    /**
     * Menyimpan data partisipan baru beserta data pengguna baru.
     */
    public function create()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'email'    => 'required|valid_email|is_unique[users.email]',
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'avatar'   => 'permit_empty|uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]',
            'full_name'   => 'required|min_length[3]|max_length[255]',
            'institution' => 'required|min_length[3]|max_length[255]',
            'level'       => 'required',
            'mentor_id'   => 'required',
            'start_date'  => 'required|valid_date[Y-m-d]',
            'end_date'    => 'required|valid_date[Y-m-d]',
            'status'      => 'required|in_list[Active, Completed, Dropped]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userData = [
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Handle file upload avatar
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/avatars/', $newName);
            $userData['avatar'] = 'uploads/avatars/' . $newName;
        }

        $user = UserModel::create($userData);
        if (!$user) {
            return redirect()->back()->withInput()->with('errors', ['Unable to create user.']);
        }

        $participantData = [
            'user_id'     => $user->id,
            'full_name'   => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'level'       => $this->request->getPost('level'),
            'mentor_id'   => $this->request->getPost('mentor_id'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status'),
        ];
        ParticipantsModel::create($participantData);

        return redirect()->to('/participants')->with('success', 'Partisipan berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit partisipan dan data pengguna terkait.
     */
    public function edit($id)
    {
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            return redirect()->back()->with('errors', 'Partisipan tidak ditemukan');
        }
        $user = UserModel::find($participant->user_id);
        if (!$user) {
            return redirect()->back()->with('errors', 'Pengguna terkait partisipan tidak ditemukan');
        }
        $data = [
            'mentors'     => UserModel::where('role', 'MENTOR')->get(),
            'participant' => $participant,
            'user'        => $user,
        ];
        return $this->blade->render('participants.edit', $data);
    }

    /**
     * Memperbarui data partisipan dan data pengguna terkait.
     */
    public function update($id)
    {
        $participant = ParticipantsModel::find($id);
        if (!$participant) {
            return redirect()->back()->with('errors', 'Partisipan tidak ditemukan');
        }
        $user = UserModel::find($participant->user_id);
        if (!$user) {
            return redirect()->back()->with('errors', 'Pengguna terkait partisipan tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'email'    => "required|valid_email|is_unique[users.email,id,{$user->id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$user->id}]",
            'password' => 'permit_empty|min_length[6]',
            'avatar'   => 'permit_empty|uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]',
            'full_name'   => 'required|min_length[3]|max_length[255]',
            'institution' => 'required|min_length[3]|max_length[255]',
            'level'       => 'required',
            'mentor_id'   => 'required',
            'start_date'  => 'required|valid_date[Y-m-d]',
            'end_date'    => 'required|valid_date[Y-m-d]',
            'status'      => 'required|in_list[Active, Completed, Dropped]',
        ];
        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userData = [
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];
        if ($password = $this->request->getPost('password')) {
            $userData['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/avatars/', $newName);

            if (!empty($user->avatar) && file_exists($user->avatar)) {
                unlink($user->avatar);
            }

            $userData['avatar'] = 'uploads/avatars/' . $newName;
        }

        $user->update($userData);

        $participantData = [
            'full_name'   => $this->request->getPost('full_name'),
            'institution' => $this->request->getPost('institution'),
            'level'       => $this->request->getPost('level'),
            'mentor_id'   => $this->request->getPost('mentor_id'),
            'start_date'  => $this->request->getPost('start_date'),
            'end_date'    => $this->request->getPost('end_date'),
            'status'      => $this->request->getPost('status'),
        ];
        $participant->update($participantData);

        return redirect()->to('/participants')->with('success', 'Partisipan berhasil diperbarui.');
    }
}
