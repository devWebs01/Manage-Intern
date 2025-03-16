<?php

namespace App\Controllers;
use App\Models\LogbooksModel;
use App\Models\ParticipantsModel;
use App\Models\UserModel;
use App\Libraries\BladeOneLibrary;

class Home extends BaseController
{
    protected $blade;

    public function __construct()
    {
        // Inisialisasi BladeOneLibrary satu kali di konstruktor
        $this->blade = new BladeOneLibrary();
    }
    public function index(): string
    {
        return view('welcome_message');
    }

    public function dashboard()
    {

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Halaman Utama',
            'message' => 'Selamat datang di CodeIgniter dengan BladeOne'
        ];

        // Render view 'home.blade.php' yang berada di folder Views
        return $this->blade->render('dashboard', $data);

    }

    public function show($id)
    {

        $data = [
            'mentors' => UserModel::where('role', 'MENTOR')->get(),
            'profile' => UserModel::find($id),
        ];

        return $this->blade->render('profiles.show', $data);
    }

    public function update($id)
    {
        $user = UserModel::find($id);
        if (!$user) {
            return redirect()->back()->with('errors', ['user' => 'Pengguna tidak ditemukan']);
        }

        // Ambil data participant jika sudah ada
        $participant = $user->participant;

        $validation = \Config\Services::validation();
        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,{$user->id}]",
            'username' => "required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{$user->id}]",
            'avatar' => 'permit_empty|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/png,image/jpeg,image/jpg]',
        ];

        // Validasi tambahan untuk PARTICIPANT
        if ($user->role === "PARTICIPANT") {
            $rules += [
                'full_name' => 'required|min_length[3]|max_length[255]',
                'institution' => 'required|min_length[3]|max_length[255]',
                'level' => 'required',
            ];
        }

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        $validation->setRules($rules);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        // Data yang akan diupdate
        $userData = [
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
        ];

        if ($this->request->getPost('password')) {
            $userData['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // ✅ **Handle Upload Avatar**
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Buat folder jika belum ada
            if (!is_dir(FCPATH . 'uploads/avatars')) {
                mkdir(FCPATH . 'uploads/avatars', 0777, true);
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/avatars/', $newName);

            // Hapus avatar lama jika ada
            if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)) {
                unlink(FCPATH . $user->avatar);
            }

            $userData['avatar'] = 'uploads/avatars/' . $newName;
        }

        $user->update($userData);

        // ✅ **Update PARTICIPANT jika ada**
        if ($user->role === "PARTICIPANT") {
            $participantData = [
                'full_name' => $this->request->getPost('full_name'),
                'institution' => $this->request->getPost('institution'),
                'level' => $this->request->getPost('level'),
            ];

            if ($participant) {
                $participant->update($participantData);
            } else {
                $participantModel = new ParticipantsModel();
                $participantData['user_id'] = $user->id;
                $participantModel->insert($participantData);
            }
        }

        return redirect()->to('/profiles/' . $user->id . '/show')->with('success', 'Profil akun berhasil diperbarui.');
    }
    function test()
    {
        $mentor = UserModel::where('role', 'MENTOR')->inRandomOrder()->first()->id;

        dd($mentor);
    }
}
